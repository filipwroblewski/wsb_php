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
      $sql = "SELECT * FROM `users`;";
      $result = $conn->query($sql);
      while ($user = $result->fetch_assoc()) {
        // echo $user['name'];
        echo <<< E
        Imię i nazwisko: $user[name] $user[surname]
        <hr>
        E;
      }
    ?>

  </body>
</html>
