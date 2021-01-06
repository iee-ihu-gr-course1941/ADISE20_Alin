<?php

if (isset($_POST["join"])) {
  session_start();
  $id = $_POST["id"];
  require_once 'config.php';
  require_once 'lobbysfunc.inc.php';

     join_press($conn,$id,$_SESSION["userid"]);

}

 ?>
