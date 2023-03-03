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
    <form action="api/upload.php" method="post" enctype="multipart/form-data">
        Select image to upload (JPG, JPEG, PNG, GIF):
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="submit" value="Upload Image" name="submit">
    </form><br>

</body>

</html>