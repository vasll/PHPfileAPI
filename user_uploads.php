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
    
    <p>Files that you have uploaded:</p>
    <?php include('api/get/uploads.php')?>

    <!-- Libraries -->
    <script src="js/jquery-3.6.3.js"></script>
</body>

</html>