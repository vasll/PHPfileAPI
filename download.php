<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php include ('modules/navbar.php')?>

    <?php // Controllo sul login dell'user
      if(!isset($_SESSION['id_user'])){
        echo "User is not logged in. Login first.";
        exit();
      }
    ?>
    
    <p>Download</p>
    <form action="api/download.php" method="get" id="download-form">
        File name:
        <input type="text" name="path" placeholder="File name">
        <input type="submit" value="download" name="submit">
    </form><br>

    <!-- Libraries -->
    <script src="js/jquery-3.6.3.js"></script>
</body>

</html>