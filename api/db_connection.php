<?php    
    $serverIP = "localhost";
    $username = "root";
    $db_name = "phpfileapi";
    $password = "";

    // Create connection
    $connection = new mysqli($serverIP, $username, $password, $db_name);

    // Connection check
    if ($connection->connect_error) {
        echo "DB Connection error";
        echo $connection->connect_error;
        die;
    }else{

    }

    return $connection;

?>