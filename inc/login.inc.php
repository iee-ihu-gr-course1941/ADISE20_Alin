<?php

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];


  require_once 'config.php';
  require_once 'login_logoutfunc.php';


  if (emptyInputLogin($username, $password) !== false){
      header("Location: ../login.php?error=emptyinput");
    exit();
  }
   loginUser($conn, $username, $password);

}
else{
  header("Location: ../register.php");
  exit();
}

 ?>
