<?php
  session_start();
  
  // Controllo se l'user è loggato
  if(!isset($_SESSION['id_user'])){
    // echo "User is not logged in. Login first.";
    exit();
  }

  $target_dir = "uploads/".$_SESSION['id_user']."/";  // 'uploads/<id_user>/'
  $full_file_name = $_FILES["fileToUpload"]["name"];  // 'image.png'
  $target_file = $target_dir.basename($full_file_name); // Appendo il nome del file alla dir
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
  
  // Controllo se il file esiste di già, se esiste creo un file rinominato 'filename_N.png'
  if (file_exists($target_file)) {
    $file_count = 1;

    $file_info = pathinfo($full_file_name);
    $file_name = $file_info['filename'];

    while(true){
      $next_file = $file_name.'_'.$file_count.'.'.$file_info['extension'];  // 'image_3.png'
      $next_file_path = $target_dir.$next_file;
      if(file_exists($next_file_path)){
        $file_count += 1;
        continue;
      }else{
        $full_file_name = $next_file;
        $target_file = $target_dir.$next_file;
        break;
      }
    }

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
    echo $full_file_name;
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }

?>