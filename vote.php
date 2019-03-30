<?php
  include "functions.php";
  check_login();

  $user = cookie_loginquery("username");
  $id = cookie_loginquery("id");
  echo $id."<br>";

  $voteid = $_POST['voteid'];
  $select = $_POST['select'.$voteid];

  echo $select."<br>";

  $votes = unserialize(sql_read_vote("votes", $voteid));
  $voted = unserialize(sql_read_vote("voted", $voteid));

  if(!$voted[$id - 1]){
    $votes[$select]++;
    $voted[$id - 1] = true;
    sql_write_vote("votes.votes", serialize($votes), $voteid);
    sql_write_vote("voted", serialize($voted), $voteid);
  }
  else{
    header("Location:voting.php?error=voted");
  }

  print_r($votes);
  print_r($voted);

  check_error();
