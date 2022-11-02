<?php 
  session_start() 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./styles/style.css">
  </head>
  <body>
    <h3>Użytkownicy z tabeli</h3>
    <!-- komunikaty -->
    <?php
      if (isset($_SESSION['info'])){
        echo $_SESSION['info'];
        unset($_SESSION['info']);
      }
    ?>
    <table>
      <tr>
        <th>Imię i nazwisko</th>
        <th>Miasto</th>
        <th>Data utworzenia konta</th>
      </tr>
      
      <?php
        require_once("./scripts/1_connect.php");
        $sql = "SELECT users.id, users.name, users.surname, users.created_at, cities.city FROM `users` INNER JOIN `cities` ON `users`.`city_id`=`cities`.`id`;";
        $result = $conn->query($sql);
        while ($user = $result->fetch_assoc()) {
          // echo $user['name'];
          echo <<< E
          <tr>
            <td>$user[name] $user[surname]</td>
            <td>$user[city]</td>
            <td>$user[created_at]</td>
            <td><a href="./scripts/delete_user.php?userid=$user[id]">Usuń</a></td>
          </tr>

          E;
        }
      ?>
    </table>

  </body>
</html>
