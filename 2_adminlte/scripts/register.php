<?php
    $error = 0;
    foreach ($_POST as $key => $value){
        if (empty($value)){
            $error = 1;
        }
    }

    if (!isset($_POST['agreeTerms'])){
        $error = 1;
    }

    if ($error == 1){
        echo "<script>history.back()</script>";
        exit();
    }

    require_once 'connect.php';
    // $sql = "INSERT INTO `users` (`id`, `city_id`, `name`, `surname`, `birthday`, `created_at`, `email`, `pass`) VALUES (NULL, \'1\', \'asd\', \'asd\', \'2022-11-03\', current_timestamp(), \'asd@wp.pl\', \'pswd\');";
    // $mysqli->query($sql);

    
    //https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php
    $stmt = $mysqli->prepare("INSERT INTO users(city_id, name, surname, email, pass, birthday) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $_POST['city_id'], $_POST['name'], $_POST['surname'], $_POST['email1'], $_POST['pass1'], $_POST['birthday']); // isssss -> inteager, string, string, string, string, string, string
    $stmt->execute();
?>