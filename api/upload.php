<?php
  session_start();
  
  // Controllo se l'user è loggato
  if(!isset($_SESSION['id_user'])){
    // echo "User is not logged in. Login first.";
    exit();
  }

  $target_dir = "uploads/".$_SESSION['id_user']."/";  // Path = 'uploads/<id_user>/'
  $file_name = $_FILES["fileToUpload"]["name"];
  $target_file = $target_dir.basename($file_name); // Appendo il nome del file alla dir
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Prendo l'estensione del file

  // Controllo se la dir esiste, altrimenti la creo
  if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
  }

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    if(empty($_FILES["fileToUpload"]["tmp_name"])){
      // echo "Dir or file is empty.<br>";
      exit();
    }

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); // Se getimagesize() ritorna false significa che il file non è un immagine
    if($check != false) {  // Il file è un immagine

    } else {  // Il file non è un immagine
      // echo "File is not an image.<br>";
      exit();
    }
  }
  
  // Controllo se il file esiste di già
  if (file_exists($target_file)) {
    // TODO cambiare il nome del file ad n+1
    // echo "Sorry, file already exists.<br>";
    exit();
  }
  
  // Controllo sulla dimensione del file
  if ($_FILES["fileToUpload"]["size"] > 10000000) {  // 10 MB
    // echo "Sorry, your file is too large.<br>";
    exit();
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit();
  }
  
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    echo $file_name;
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }

?>