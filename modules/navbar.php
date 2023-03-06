<?php
    session_start();

    echo '<a href="upload.php">Upload</a>
    <a href="download.php">Download</a>&nbsp;
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>&nbsp;
    <a href="user_uploads.php">My uploads</a>
    <a href="markdown.php">Markdown</a>&nbsp;&nbsp;';

    if(isset($_SESSION['id_user']) && isset($_SESSION['nickname'])){
        echo 'Nickname: '.$_SESSION['nickname'];
    }else{
        echo 'User is not logged in.';
    }

    echo '<br><hr>';
?>