<?php
    require "../db_connection.php";
    session_start();

    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    $query = "SELECT id, nickname, password FROM users WHERE nickname = '$nickname'";
    $queryResult = $connection->query($query);

    if($queryResult){
        while($row = $queryResult->fetch_assoc()){
            if($row['nickname'] == $nickname && $row['password'] == $password){
                session_reset();
                $_SESSION['id_user'] = $row['id'];
                $_SESSION['nickname'] = $row['nickname'];
            }
            echo "Login successful!";
            break;
        }
    }else{
        echo "Login not successful!";
    }
?>