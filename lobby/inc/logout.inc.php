<?php
require_once 'config.php';
  require_once 'functions.inc.php';

  session_start();
  set_logout($conn,$_SESSION["userid"]);

session_start();
session_unset();
session_destroy();

header("Location: ../login.php");
exit();


 ?>
