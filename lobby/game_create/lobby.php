<?php
include_once "../freind.php";
include_once "../../inc/lobbysfunc.inc.php";
 ?>
 <form action="../../inc/logout.inc.php" method="POST">
    <button id="logout_btn" type="submit" name="logout"><i style="font-size: 23px;" class="fa fa-power-off"></i> Log Out</button>
</form>
  <button name="reload" id="btn_create" class="btn-success" type="reload" >reload</button>

  <table id="container">
    <tr>
      <th>GAME NAME</th>
      <th>OWNER</th>
      <th>STATUS</th>
    </tr>
<?php
  show_lobbys($conn);
?>
  </table>

  <?php
  include_once '../footer.php';

     ?>
