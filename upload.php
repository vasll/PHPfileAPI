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
    
    <p>Upload</p>
    <form id="form-upload">
        Select image to upload (JPG, JPEG, PNG, GIF):
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="submit" value="Upload Image" name="submit">
    </form><br>

    <!-- Libraries -->
    <script src="js/jquery-3.6.3.js"></script>
    <script src="ajax/form-upload.js"></script>
</body>

</html>