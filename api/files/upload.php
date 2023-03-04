<?php
  // Uploads a file
  require "../db_connection.php";
  require "../utils/unsetted_post_fields.php";
  session_start();
  $response = [];

  // Check if user is logged in
  if(!isset($_SESSION['id_user'])){
    $response['message'] = $MESSAGE_USER_NOT_LOGGED_IN;
    http_response_code(401);  // 401 = Unauthorized
    echo json_encode($response);
    exit();
  }
  
  $target_dir = "../uploads/".$_SESSION['id_user']."/";  // 'uploads/<id_user>/'
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
      $response['message'] = "No file attached";
      http_response_code(422);  // 422 = Unprocessable entity
      echo json_encode($response);
      exit();
    }

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); // Se getimagesize() ritorna false significa che il file non è un immagine
    if($check != false) {  // Il file è un immagine

    }else{
      $response['message'] = "File must be .jpg, .png, .gif or .jpeg";
      http_response_code(422);  // 422 = Unprocessable entity
      echo json_encode($response);
      exit();
    }
  }else{
    $response['message'] = "Missing POST field 'submit'";
    http_response_code(422);  // 422 = Unprocessable entity
    echo json_encode($response);
    exit();
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
  $MAX_FILESIZE_BYTES = 12000000;
  if($_FILES["fileToUpload"]["size"] > 12000000) {  // 12 MB
    $response['message'] = "File is too large. Maximum filesize = ".($MAX_FILESIZE_BYTES*0.000001)."mb";
    http_response_code(422);  // 422 = Unprocessable entity
    echo json_encode($response);
    exit();
  }
  
  // Allow certain file formats
  if($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "gif"){
    $response['message'] = "Only .jpg, .png, .gif or .jpeg files are allowed";
    http_response_code(422);  // 422 = Unprocessable entity
    echo json_encode($response);
    exit();
  }
  
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_path)) {
    $response['message'] = "Upload successful!";
    $response['filename'] = $full_file_name;
  } else {
    http_response_code(401);
    $response['message'] = "DB error, query not successful";
  }

  echo json_encode($response);

?>