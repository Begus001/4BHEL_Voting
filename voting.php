<?php
  include "functions.php";
  check_login();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Voting - 4BHEL Infosystem</title>
  <script>
    function add_item(){
        var number = (document.getElementById("elem0").id).substring(4, 5);
        var container = document.getElementById("items");

        while(document.getElementById("elem" + number) != null){
          number++;
        }

        var item = document.createElement("input");
        item.type = "text";
        item.name = "elem" + number;
        item.id = "elem" + number;
        item.placeholder = "Auswahlmöglichkeit " + (number + 1);

        container.appendChild(document.createElement("br"));
        container.appendChild(item);

        if(number >= 19){
          document.getElementById("add_item_button").remove();
        }
      }
    </script>
</head>

<body>
  <a href="reset_password.php">Passwort Zurücksetzen</a>
  <?php
      if (cookie_loginquery("username") == "goisser" || cookie_loginquery("username") == "gulda") {
          if (cookie_loginquery("password") == sql_read_user("password", cookie_loginquery("username"))) {
              ?>

  <form action="create_vote.php" method="post" enctype="multipart/form-data">
    <div id="items">
      <input type="text" name="votename" placeholder="Name der Abstimmung"><br>
      <input id="elem0" name="elem0" type="text" placeholder="Auswahlmöglichkeit 1">
    </div>
    <a id="add_item_button" onclick="add_item()">+</a><br>
    <input type="submit" value="Abstimmung Erstellen">
  </form>
  <br><br><br>
  <?php
          }
      }

      $names = array();
      $items = array();
      $votes = array();
      for($i = 0; $i < constant("MAXVOTES"); $i++){
          $names[$i] = sql_read_vote("name", $i);
          $items[$i] = sql_read_vote("items", $i);
      }

      for($i = 0; $i < sizeof($names); $i++){
        if($names[$i] != ""){
          $item = array();
          $item = unserialize($items[$i]);
          echo "<form action='vote.php' method='post' enctype='multipart/form-data'>\r\n
          <h1>".$names[$i]."</h1>\r\n
          <input type='submit' value='Löschen' name='action'>";
          for($k = 0; $k < sizeof($item); $k++){
              echo $item[$k]."<input type='radio' name='select".$i."' value='".$k."'>\r\n";
            }

            echo "<input type='submit' value='Abstimmen' name='action'>\r\n";
            echo "<input type='hidden' name='voteid' value='".$i."'>";
            echo "</form>\r\n";
          }
      }

      check_error();
    ?>
</body>

</html>
