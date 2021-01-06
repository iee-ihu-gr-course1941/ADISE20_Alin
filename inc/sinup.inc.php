<?php


if (isset($_POST["submit"])) {
   $username = $_POST["username"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $passwordrepeat = $_POST["passwordrepeat"];

   require_once 'config.php';
   require_once 'functions.inc.php';

  if (emptyInputSingup($username, $email, $password, $passwordrepeat) !== false){
      header("Location: ../register.php?error=emptyinput");
	  exit();
   }
  if (invalidusername($username) !== false){
      header("Location: ../register.php?error=invalidusername");
	  exit();
   }

   if (invalidemail($email) !== false){
      header("Location: ../register.php?error=invalidemail");
	  exit();
   }
    if (passwordMatch($password, $passwordrepeat) !== false){
      header("Location: ../register.php?error=passwordsnotsame");
	  exit();
   }
    if (userExists($conn, $username) !== false){
      header("Location: ../register.php?error=usernametaken");
	  exit();
   }

  createUser($conn, $username, $email, $password);
  }
 else{
    header("Location: ../register.php");
    exit();
  }
?>
