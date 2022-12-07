<?php
    session_start();

    $error = 0;
    foreach ($_POST as $key => $value){
        if (empty($value)){
            $error = 1;
        }
    }

    

    if ($error == 1){
        $_SESSION['error'] = "Wypełnij wszystkie pola";
        echo "<script>history.back()</script>";
        exit();
    }

    require_once 'connect.php';

    try{
        $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bind_param("s", $_POST['email']); //s -> string
        $stmt->execute();

        // mozna dodac $stmt->affected_rows
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($stmt->affected_rows == 1 && password_verify($_POST['pass'], $user['pass'])) {
            $_SESSION['success'] = "Prawidłowo zaloował się użytkownik $_POST[email]";
            echo $user['name'];
        }else{
            $_SESSION['error'] = "Nie zalogowano użytkownika użytkownika $_POST[email]";
            echo "error";
        }
    } catch (Exception $e){
        echo $e->getMessage();
        if ($stmt->affected_rows != 1){
            // echo "<br>error";
            $_SESSION['error'] = "Nie zalogowano użytkownika użytkownika $_POST[email]";
            echo "error";
        }
    }
    
    
    // header('location: ../');
?>