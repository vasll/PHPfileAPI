<?php
  session_start();
  
  // Check if user is logged
  if(!isset($_SESSION['id_user'])){
    // TODO
    exit();
  }

  $target_dir = "uploads/".$_SESSION['id_user']."/";  // 'uploads/<id_user>/'
  $full_file_name = $_FILES["fileToUpload"]["name"];  // 'image.png'
  $target_file_path = $target_dir.basename($full_file_name); // 'uploads/<id_user>/image.png'
  $file_extension = strtolower(pathinfo($target_file_path,PATHINFO_EXTENSION)); // '.png'

  // Check if dir exists, if not create it
  if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
  }

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    if(empty($_FILES["fileToUpload"]["tmp_name"])){
      // TODO (No file attached)
      exit();
    }

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); // Se getimagesize() ritorna false significa che il file non è un immagine
    if($check != false) {  // Il file è un immagine

    } else {
      // TODO (File is not an image)
      exit();
    }
  }
  
  // Check if file exists aleady, if it does rename it to 'filename_N.png' where N is count of duplicate names
  if (file_exists($target_file_path)) {
    $file_count = 1;  // Counter of files with same name
    $file_info = pathinfo($full_file_name);
    $file_name = $file_info['filename'];  // 

    while(true){
      $next_file = $file_name.'_'.$file_count.'.'.$file_info['extension'];  // 'filename_1.png'
      $next_file_path = $target_dir.$next_file;

      if(file_exists($next_file_path)){ // 'filename_1.png' exists already, make 'filename_2.png'
        $file_count += 1;
        continue;
      }else{
        $full_file_name = $next_file;
        $target_file_path = $target_dir.$next_file;
        break;
      }
    }
  }
  
  // Filesize check
  if ($_FILES["fileToUpload"]["size"] > 10000000) {  // 12 MB
    // TODO (File is too large)
    exit();
  }
  
  // Allow certain file formats
  if($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "gif"){
    // TODO (Only JPG, JPEG, PNG & GIF files are allowed)
    exit();
  }
  
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_path)) {
    // TODO upload successful
    echo $full_file_name;
  } else {
    // TODO error with upload
  }

?>