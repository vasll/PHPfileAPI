<?php
    session_start();

    // Controllo se l'user è loggato
    if(!isset($_SESSION['id_user'])){
        echo "User is not logged in. Login first.";
        exit();
    }
    
    // Come path di root mettiamo 'uploads/<id_user>/' per evitare di prendere i file dagli altri user
    $folder_path = "uploads/".$_SESSION['id_user']."/";

    if(isset($_GET['path'])){
        //Read the filename
        $filename = $folder_path.$_GET['path'];
        //Check the file exists or not
        if(file_exists($filename)) {

            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: 0");
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Content-Length: ' . filesize($filename));
            header('Pragma: public');

            //Clear system output buffer
            flush();

            //Read the size of the file
            readfile($filename);

            //Terminate from the script
            die();
        }else{
            echo "File does not exist.";
        }
    }else echo "Filename is not defined."
?>
