<?php

if (isset($_POST["add"])) {
  $username = $_POST["user"];

session_start();
  require_once 'config.php';
  require_once 'friendsfunc.php';

   addf($conn, $username,$_SESSION["userid"]);

}

 ?>
