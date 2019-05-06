<?php
  include "functions.php";
  check_login();

  $user = cookie_loginquery("username");
  $id = cookie_loginquery("id");
  $action = $_POST['action'];

  $voteid = $_POST['voteid'];
  if(isset($_POST['select'.$voteid])){
    $select = $_POST['select'.$voteid];
  }
  else{
    if($action == "Abstimmen")
    header("Location:voting.php?error=info_defi");
  }

  $votes = unserialize(sql_read_vote("votes", $voteid));
  $voted = unserialize(sql_read_vote("voted", $voteid));

  if($action == "Abstimmen"){
    if(!$voted[$id - 1]){
      $votes[$select]++;
      $voted[$id - 1] = true;
      sql_write_vote("votes.votes", serialize($votes), $voteid);
      sql_write_vote("voted", serialize($voted), $voteid);
    }
    else{
      header("Location:voting.php?error=voted");
    }
  }
  else if($action == "Löschen"){
    echo "voteid: ".$voteid;
    echo "action: ".$action;
    sql_delete_vote($voteid);
  }

  print_r($votes);
  print_r($voted);

  check_error();
