<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3>Użytkownicy z tabeli</h3>
    <?php
      require_once("./scripts/1_connect.php");
      // $sql = "SELECT * FROM `users`;";
      $sql = "SELECT * FROM `users` INNER JOIN `cities` ON `users`.`city_id`=`cities`.`id`;";
      $result = $conn->query($sql);
      $count = 0;
      while ($user = $result->fetch_assoc()) {
        // echo $user['name'];
        $count++;
        echo <<< E
        Użytkownik $count:<br>
        Imię i nazwisko: $user[name] $user[surname]<br>
        Miasto: $user[city]<br>
        Data utworzenia: $user[created_at]
        <hr>
        E;
      }
    ?>

  </body>
</html>
