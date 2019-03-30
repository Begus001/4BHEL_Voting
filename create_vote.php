<?php
  include "functions.php";
  check_login();


  $votename = set_post("votename", "voting.php?error=info_defi");
  $elem = array();

  $k = 0;
  for ($i = 0; $i <= 19; $i++) {
      if (isset($_POST['elem'.$i])) {
          if ($_POST['elem'.$i] != "") {
              $elem[$k] = set_post('elem'.$i, "voting.php?error=info_defi");
              $k++;
          }
      }
  }

  $votes = array();
  $voted = array();

  for ($i = 0; $i < sizeof($elem); $i++) {
      $votes[$i] = 0;
  }

  for($i = 0; $i < constant("USERS"); $i++){
      $voted[$i] = false;
  }

  if ($elem[0] == null || $elem[0] == "") {
      header("Location:voting.php?error=info_defi");
      die();
  }

  $sqlconn = new mysqli("localhost", "root", "123456789");
  $sqlconn->select_db("main");
  if ($sqlconn->connect_error) {
      header("Location:voting.php?error=db_con");
  }

  $result = $sqlconn->query("select * from votes where name='".$votename."'");

  if ($result->num_rows == 0) {
      $id = 0;
      while (true) {
          $result = $sqlconn->query("select * from votes where id='".$id."'");
          if ($result->num_rows == 0) {
              if ($id < constant("MAXVOTES")) {
                  $sqlconn->query("insert into votes values (".$id.", '".$votename."', '".serialize($elem)."', '".serialize($votes)."', '".serialize($voted)."')") or die("lel");
                  break;
              } else {
                  header("Location:voting.php?error=vote_limit");
                  break;
              }
          }
          $id++;
      }
  } else {
      header("Location:voting.php?error=name_exists");
      die();
  }
