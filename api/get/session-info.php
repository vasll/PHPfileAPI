<?php
    require "../db_connection.php";
    if(!isset($_SESSION)){
        session_start();
    }
    $response = [];
    
    // Controllo se l'user è loggato
    if(!isset($_SESSION['id_user'])){
        $response['message'] = $MESSAGE_USER_NOT_LOGGED_IN;
        http_response_code(401);  // 401 = Unauthorized
        echo json_encode($response);
        exit();
    }

    $response['message'] = "User is logged in.";
    $response['id_user'] = $_SESSION['id_user'];
    $response['nickname'] = $_SESSION['nickname'];
    echo json_encode($response);
    exit();
?>