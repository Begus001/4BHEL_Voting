<?php
  include "functions.php";

  //Check if credentials entered
  $name = set_post("name", "index.php?error=info_defi");
  $pw = set_post("pw", "index.php?error=info_defi");

  //Query id and password
  $actid = sql_read_user("id", $name);
  $actpw = sql_read_user("password", $name);

  if (sha1($pw) == $actpw) {
      $usercred = array('id' => $actid, 'username' => $name,'password' => $actpw);
      setcookie("4bhel_login", serialize($usercred), time()+315360000);
      header("Location:voting.php");
      die();
  }

  if ($name == "" || $pw == "") {
      header("Location:index.php?error=info_defi");
      die();
  } elseif (sha1($pw) != $actpw) {
      header("Location:index.php?error=inco_cred");
      die();
  }
