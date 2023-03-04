<?php
    // Registers a user
    // TODO sanitize inputs
    require "../db_connection.php";
    require "../utils/unsetted_post_fields.php";
    session_start();
    $response = [];

    // Check for unsetted fields
    $unsettedFields = getUnsettedPostFields('nickname', 'email', 'password');
    if(count($unsettedFields) > 0){
        $response['message'] = $MESSAGE_FIELDS_UNSET;
        $response['unsetted_fields'] = $unsetted_fields;
        http_response_code(406);
        echo json_encode($response);
        exit();
    }

    // If all required fields are set, continue
    $nickname = $_POST['nickname'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = hash('sha512', $_POST['password']);

    $query = "INSERT INTO users (nickname, email, password) VALUES ('$nickname', '$email', '$password')";
    $queryResult = null;
    
    try{
        $queryResult = $connection->query($query);
    } catch(mysqli_sql_exception $e){
        if(str_contains($e->getMessage(), 'Duplicate entry')){
            $response['message'] = "User already exists";
            http_response_code(406);    // 406 = Conflict
            echo json_encode($response);
            exit();
        }
    }

    if($queryResult != null && $queryResult){   // Signin is successful
        $response['message'] = "User signed in successfully. You can now login.";
    }else{  // Signin is not successful
        http_response_code(401);
        $response['message'] = "Signin failed.";
    }

    echo json_encode($response);
?>