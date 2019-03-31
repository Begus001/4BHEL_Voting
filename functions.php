<?php
  define("MAXVOTES", 20);
  define("USERS", 17);

  function sql_read_user($var, $name)
  {
      $sqlconn = new mysqli("127.0.0.1", "root", "123456789");

      if (!($sqlconn->connect_error)) {
          $sqlconn->select_db("main");

          $userquery = $sqlconn->query("select ".$var." from users where username='".$name."'");
          $result = $userquery->fetch_assoc();
          $sqlconn->close();

          return $result[$var];
      } else {
          die("db error");
      }
  }

  function sql_write_user($var, $val, $name)
  {
      $sqlconn = new mysqli("127.0.0.1", "root", "123456789");

      if (!($sqlconn->connect_error)) {
          $sqlconn->select_db("main");

          $userquery = $sqlconn->query("update users set ".$var."=".$val." where username='".$name."'");
          $sqlconn->close();
      } else {
          die("db error");
      }
  }

  function sql_write_user_id($var, $val, $id)
  {
      $sqlconn = new mysqli("127.0.0.1", "root", "123456789");

      if (!($sqlconn->connect_error)) {
          $sqlconn->select_db("main");

          $userquery = $sqlconn->query("update users set ".$var."=".$val." where id='".$id."'");
          $sqlconn->close();
      } else {
          die("db error");
      }
  }

  function sql_read_vote($var, $id)
  {
      $sqlconn = new mysqli("127.0.0.1", "root", "123456789");

      if (!($sqlconn->connect_error)) {
          $sqlconn->select_db("main");

          $userquery = $sqlconn->query("select ".$var." from main.votes where id='".$id."'");
          $result = $userquery->fetch_assoc();
          $sqlconn->close();

          return $result[$var];
      } else {
          die("db error");
      }
  }

  function sql_write_vote($var, $val, $id)
  {
      $sqlconn = new mysqli("127.0.0.1", "root", "123456789");

      if (!($sqlconn->connect_error)) {
          $sqlconn->select_db("main");

          $userquery = $sqlconn->query("update main.votes set ".$var."='".$val."' where id=".$id);
          $sqlconn->close();
      } else {
          die("db error");
      }
  }

  function sql_delete_vote($id) {
    $sqlconn = new mysqli("127.0.0.1", "root", "123456789");

    if(!($sqlconn->connect_error)){
        $sqlconn->select_db("main");
        $sqlconn->query("delete from main.votes where id=".$id);
        $sqlconn->close();
    } else {
        die("db error");
    }
  }

  function cookie_loginquery($val)
  {
      if (isset($_COOKIE['4bhel_login']) && !empty($_COOKIE['4bhel_login']) && $_COOKIE['4bhel_login'] != null && $_COOKIE['4bhel_login'] != "") {
          $cookie = unserialize($_COOKIE['4bhel_login']);
          return $cookie[$val];
      } else {
          die("cookie error");
      }
  }

  function set_post($name, $ret_page = "index.php")
  {
      if (isset($_POST[$name]) && !empty($_POST[$name]) && $_POST[$name] != null && $_POST[$name] != "") {
          if ($_POST[$name] != null) {
              return stripcslashes($_POST[$name]);
          } else {
              header("Location:".$ret_page);
          }
      } else {
          header("Location:".$ret_page);
      }
  }

  function check_login()
  {
      if (isset($_COOKIE['4bhel_login']) && !empty($_COOKIE['4bhel_login']) && $_COOKIE['4bhel_login'] != null && $_COOKIE['4bhel_login'] != "") {
          if (cookie_loginquery("password") != sql_read_user("password", cookie_loginquery("username"))) {
              header("Location:index.php?error=no_login");
              die();
          }
      } else {
          header("Location:index.php?error=no_login");
          die();
      }
  }

  function check_error()
  {
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

          case "vote_limit":
            echo "Höchstanzahl an Abstimmungen erreicht.";
            break;

          case "name_exists":
            echo "Abstimmung existiert bereits.";
            break;

          case "voted":
            echo "Sie haben bereits abgestimmt.";
            break;
        }
      }
  }
