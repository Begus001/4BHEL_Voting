<?php
  $userfilepath = "users.xml";
  $students = 17;
  if(isset($_POST['name'])){
    $name = $_POST['name'];
  }

  if(isset($_POST['pw'])){
    $pw = $_POST['pw'];
  }

  $userfile = fopen($userfilepath, "r") or die("dieded.");
  $userxml = fread($userfile, filesize($userfilepath));
  fclose($userfile);
  $userxmlfile = new SimpleXMLElement($userxml);

  for($i = 0; $i < $students; $i++){
    if($name == $userxmlfile->user[$i]->name){
      if(sha1($pw) == $userxmlfile->user[$i]->password){
        setcookie("session", sha1($pw));
        $GLOBALS['kek'] = sha1($pw);
        header("Location:loggedin.php");
        return;
      }
    }
  }
  header("Location:index.php");
?>
