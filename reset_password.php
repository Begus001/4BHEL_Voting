<?php
  include "functions.php";
  check_login();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Passwort Ändern - 4BHEL Infosystem</title>
  </head>
  <body>
    <form action="reset.php" method="post" enctype="multipart/form-data">
      <input type="password" name="oldpw" placeholder="Altes Passwort">
      <input type="password" name="pw" placeholder="Neues Passwort">
      <input type="password" name="cpw" placeholder="Neues Passwort bestätigen">
      <input type="submit" value="Passwort Ändern">
    </form>
  </body>
</html>
<?php
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

      case "old_pw_inco":
        echo "Altes Passwort inkorrekt.";
        break;

      case "cpw_inco":
        echo "Passwortbestätigung falsch.";
        break;
    }
  }
?>
