<?php

session_start();

if (isset($_POST["create"])) {
  require_once 'config.php';
  require_once 'functions.inc.php';

  $name = $_POST["name"];
    create_lobby($conn,$_SESSION["userid"]);


}

 ?>
