<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    // Controllo se l'user è loggato
    if(!isset($_SESSION['id_user'])){
        echo "User is not logged in. Login first.";
        exit();
    }
    
    // Come path di root mettiamo 'uploads/<id_user>/' per evitare di prendere i file dagli altri user
    $folder_path = "./api/uploads/".$_SESSION['id_user']."/";
    $user_files = array_diff(scandir($folder_path), array('.', '..'));
    
    foreach($user_files as $file){
        echo "- ".$file;
    }
?>