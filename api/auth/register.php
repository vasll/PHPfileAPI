<?php
    include "../db_connection.php";

    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (nickname, email, password) 
    VALUES ('$nickname', '$email', '$password')";

    if($connection->query($sql)){
        echo "User registered with success!";
    }else{
        echo "Can't insert user!";
    }
?>