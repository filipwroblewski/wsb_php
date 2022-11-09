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
        $sql = "SELECT `users`.`id`, `users`.`name`, `users`.`surname`, `users`.`created_at`, `cities`.`city` FROM `users` INNER JOIN `cities` ON `users`.`city_id`=`cities`.`id` ORDER BY id DESC;";
        $result = $conn->query($sql);
        while ($user = $result->fetch_assoc()) {
          // echo $user['name'];
          echo <<< E
          <tr>
            <td>$user[name] $user[surname]</td>
            <td>$user[city]</td>
            <td>$user[created_at]</td>
            <td><a href="./scripts/delete_user.php?userid=$user[id]">Usuń</a></td>
            <td><a href="./5_tabela_update_insert.php?updateuserid=$user[id]">Aktualizuj</a></td>
          </tr>
          E;
        }

        echo "</table>";
          if (isset($_GET['adduser'])){
            echo "<h4>Dodawanie nowego użytkownika</h4>";
            echo <<< ADDUSER
            <form action="./scripts/add_user.php" method="post">
            <select name="city_id">
            ADDUSER;
            
            $sql="SELECT * FROM `cities`";
            $result=$conn->query($sql);
            while ($city=$result->fetch_assoc()){
              echo "<option value=\"$city[id]\">$city[city]</option>";
            }
            
            echo <<< ADDUSER
              </select><br><br>
              <input type="text" name="name" placeholder="Podaj imie" value="Test"><br><br>
              <input type="text" name="surname" placeholder="Podaj nazwisko" value="Testing"><br><br>
              <input type="submit" value="Dodaj użytkownika">
            </form>
            ADDUSER;
            
          }else{
            echo '<a href="./4_tabela_insert.php?adduser=1">Dodawanie nowego użytkownika</a>';
          }

          if (!empty($_GET['updateuserid'])){
            echo "<h4>Aktualizacja użytkownika o id=$_GET[updateuserid]</h4>";
            $sql="SELECT * FROM `users` WHERE `id`=$_GET[updateuserid]";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
            echo "$user[name]";
          }
      ?>

  </body>
</html>
