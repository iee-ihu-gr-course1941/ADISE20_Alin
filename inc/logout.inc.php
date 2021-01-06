<?php
require_once 'config.php';
require_once 'login_logoutfunc.php';

  session_start();
  set_logout($conn,$_SESSION["userid"]);

session_start();
session_unset();
session_destroy();

header("Location: ../login.php");
exit();


 ?>
