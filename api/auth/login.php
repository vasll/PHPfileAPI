<?php
    // Logins a user
    // TODO SANITIZE INPUTS
    require "../db_connection.php";
    require "../utils/unsetted_post_fields.php";
    session_start();
    $response = [];

    // Check for unsetted fields
    $unsetted_fields = getUnsettedPostFields('nickname', 'password');
    if(count($unsetted_fields) > 0){
        $response['message'] = $MESSAGE_FIELDS_UNSET;
        $response['unsetted_fields'] = $unsetted_fields;
        http_response_code(406);
        echo json_encode($response);
        exit();
    }
    
    // If fields are set, continue
    $nickname = $_POST['nickname'];
    $password = hash('sha512', $_POST['password']);

    // Login query
    $query = "SELECT id, nickname, password FROM users WHERE nickname = '$nickname'";
    $queryResult = $connection->query($query);

    if($queryResult){
        $rows = $queryResult->fetch_assoc();    // Get rows from query
        
        if($rows == null){  // User not found
            http_response_code(401);
            $response['message'] = "Login failed, user not found";
            echo json_encode($response);
            exit();
        }

        if($rows['password'] == $password){   // Login successful
            session_reset();
            $_SESSION['id_user'] = $rows['id'];
            $_SESSION['nickname'] = $rows['nickname'];
            $response['message'] = "Login successful";
        }else{  // Wrong password
            $response['message'] = "Login failed, user not found";
            http_response_code(401);
        }
    }else{  // DB/Query error
        http_response_code(401);
        $response['message'] = "DB error, query not successful";
    }

    echo json_encode($response);
?>