<?php
    // Downloads a file
    require "../db_connection.php";
    require "../utils/unsetted_post_fields.php";
    session_start();
    $response = [];

    // Check if user is logged in
    if(!isset($_SESSION['id_user'])){
        $response['message'] = $MESSAGE_USER_NOT_LOGGED_IN;
        http_response_code(401);  // 401 = Unauthorized
        echo json_encode($response);
        exit();
    }
    
    $folder_path = "../uploads/".$_SESSION['id_user']."/";  // Root path is '../uploads/<id_user>/'

    if(isset($_GET['filename'])){   // Check if filename field is set
        $filename = $folder_path.$_GET['filename']; //Read the filename
        
        if(file_exists($filename)) {    // Check if the given file exists or not in the user directory '../uploads/<id_user>/<filename>'
            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: 0");
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Content-Length: '.filesize($filename));
            header('Pragma: public');

            flush();    //Clear system output buffer
            readfile($filename);    //Read file
            die();  //Terminate from the script
        }else{  // File was not found for this user
            $response['message'] = "File does not exist for this user.";
            http_response_code(400);
            echo json_encode($response);
            exit();
        }
    }else{  // filename was not specified
        $response['message'] = "'filename' field was not specified and is required.";
        http_response_code(422);    // 422 = Unprocessable entity
        echo json_encode($response);
        exit();
    }
?>
