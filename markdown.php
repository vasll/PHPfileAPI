<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/markdown.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>

<body>
    <?php include ('modules/navbar.php')?>

    <?php // Controllo sul login dell'user
      if(!isset($_SESSION['id_user'])){
        echo "User is not logged in. Login first.";
        exit();
      }
    ?>

    <input type="file" name="fileToUpload" id="fileToUpload">

    <textarea id="markdown-textarea"></textarea>

    <!-- Libraries -->
    <script src="js/jquery-3.6.3.js"></script>
    <script src="js/markdown-listener.js"></script>
</body>

</html>