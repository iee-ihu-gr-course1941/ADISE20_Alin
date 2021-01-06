<?php

function create_lobby($conn,$userid){
  $sql = "INSERT INTO lobbys(1id) VALUES (?)   ;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../register.php?error=stmtfailed");
  exit();
}


mysqli_stmt_bind_param($stmt, "s",$userid);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location: ../lobby/lobby_wait/lobby.php");
exit();
}

function show_lobbys($conn){
$sql = "SELECT * from lobbys l INNER JOIN users u on u.id=l.1id  ;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
  header("Location: ../register.php?error=stmtfailed");
exit();
}
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
if ($row=mysqli_fetch_assoc($resultData)) {
  printf ("
   <form action='../../inc/join.inc.php' method='POST'>
      <tr>

        <th>
          <input readonly type='text' name='id' value =%u disa>

        </th>
        <th>%s</th>
        <th>

        <button name='join' id='btn_create' class='btn-success' type='join' >JOIN</button>

        </th>
      </tr>
   </form>
      ",$row["ids"],$row["username"]
    );
  while  ($row = mysqli_fetch_assoc($resultData)) {

     printf ("
      <form action='../../inc/join.inc.php' method='POST'>
         <tr>

           <th>
             <input readonly type='text' name='id' value =%u disa>

           </th>
           <th>%s</th>
           <th>

           <button name='join' id='btn_create' class='btn-success' type='join' >JOIN</button>

           </th>
         </tr>
      </form>
         ",$row["ids"],$row["username"]
       );

   }
 }
     else {
       echo "<tr>
         <th>NO</th>
         <th>game</th>
         <th>available</th>
       </tr>
      ";
     }




mysqli_stmt_close($stmt);


}



function join_press($conn,$rid,$id){
  $sqlUserUpdate = "
    UPDATE lobbys
    SET 2id = '".$id."'
    WHERE ids = '".$rid."'";
  mysqli_query($conn, $sqlUserUpdate);

  header("Location: ../lobby/lobby_wait/lobby.php?room=$rid");
exit();
}

function player2($conn){
  if(isset($_GET["room"])){
    if ($_GET["room"]) {
$sql = "SELECT username
from lobbys l
INNER JOIN users u on u.id=l.1id
WHERE l.ids=?
UNION
SELECT username
from lobbys l
INNER JOIN users u on u.id=l.2id
WHERE l.ids=? ;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
  header("Location: ../register.php?error=stmtfailed");
exit();
}
mysqli_stmt_bind_param($stmt, "ss",$_GET["room"],$_GET["room"]);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
if ($row = mysqli_fetch_assoc($resultData)) {
  printf ("<div class='player'>
   <i class='fas fa-user-circle fa-2x player_icon'></i>
     <span class='username-main-span'>%s</span>


</div>",$row['username']);
if ($row = mysqli_fetch_assoc($resultData)) {
  printf ("<div class='player'>
   <i class='fas fa-user-circle fa-2x player_icon'></i>
     <span class='username-main-span'>%s</span>


</div>",$row['username']);

}
else {
  echo "<div class='player'>
  <i class='fas fa-user-circle fa-2x player_icon'></i>
    <span class='username-main-span'>player</span>


</div>";
}
}
mysqli_stmt_close($stmt);


}
}
}






?>
