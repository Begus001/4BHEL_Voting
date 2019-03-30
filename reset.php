<?php
  include "functions.php";
  check_login();

  $oldpw = set_post("oldpw", "reset_password.php?error=info_defi");
  $pw = set_post("pw", "reset_password.php?error=info_defi");
  $cpw = set_post("cpw", "reset_password.php?error=info_defi");

  $name = cookie_loginquery("username");

  $actpw = sql_read_user("password", $name);
  $actid = sql_read_user("id", $name);

  if (sha1($oldpw) == $actpw && sha1($pw) == sha1($cpw)) {
      sql_write_user("password", "sha1('".$pw."')", $name);

      $newpw = sql_read_user("password", $name);

      $usercred = array('id' => $actid, 'username' => $name,'password' => $newpw);
      setcookie("4bhel_login", serialize($usercred), time()+315360000);

      header("Location:voting.php");
  }


  if ($oldpw == "" || $pw == "" || $cpw == "") {
      header("Location:reset_password.php?error=info_defi");
  } elseif (sha1($oldpw) != $actpw) {
      header("Location:reset_password.php?error=old_pw_inco");
  } elseif (sha1($pw) != sha1($cpw)) {
      header("Location:reset_password.php?error=cpw_inco");
  }
