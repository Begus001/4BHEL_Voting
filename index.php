<?php
  include "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login - 4BHEL Infosystem</title>
</head>

<body>
  <h1>Login</h1>
  <form action="login.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Benutzername">
    <input type="password" name="pw" placeholder="Passwort">
    <input type="submit" value="Login">
  </form>
</body>

</html>

<?php
  //Output error
  if (isset($_GET['error'])) {
      switch ($_GET['error']) {
        case "info_defi":
          echo "Bitte füllen Sie alle Felder aus.";
          break;

        case "db_con":
          echo "Konnte keine Verbindung zur Datenbank herstellen (Server Fehler).";
          break;

        case "inco_cred":
          echo "Benutzername/Passwort falsch.";
          break;

        case "no_login":
          echo "Sie sind nicht angemeldet.";
          break;
      }
  }

  //Check existing cookie
  if (isset($_COOKIE['4bhel_login']) && !empty($_COOKIE['4bhel_login'])) {
      $id = cookie_loginquery("id");
      $name = cookie_loginquery("username");
      $pw = cookie_loginquery("password");

      $actid = sql_read_user("id", $name);
      $actpw = sql_read_user("password", $name);

      if ($actid == $id && $actpw == $pw) {
          header("Location:voting.php");
          die();
      }
  }
?>
