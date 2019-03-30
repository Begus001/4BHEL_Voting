<?php
/*
  $userfilepath = "users.xml";
  $passwordfilepath = "passwords.txt";

  $charset = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

  $userfile = fopen($userfilepath, "a+") or die("Could not open XML file.");
  $userxml = fread($userfile, filesize($userfilepath));


  $userxmlfile = new SimpleXMLElement($userxml);
  $passwordfile = fopen($passwordfilepath, "a");

  for($i = 0; $i < 17; $i++){
    $currentpw = "";
    for($k = 0; $k < 8; $k++){
      $char = rand(0, 35);
      $currentpw = $currentpw.$charset[$char];
    }
    $userxmlfile->user[$i]->password = sha1($currentpw);
    fwrite($passwordfile, $userxmlfile->user[$i]->name." ".$currentpw."\r\n");
  }
  fclose($passwordfile);
  fwrite($userfile, $userxmlfile->asXML());
  fclose($userfile);
*/
?>
