<?php
  function get_all_friends($conn,$userid){
    $sql = "SELECT username,online
    FROM users u
    INNER JOIN fr f ON u.id=f.ids

  where NOT u.id=? and f.type=1
  UNION
    SELECT username,online
    FROM users u

    INNER JOIN fr f ON u.id=f.rid
      where NOT u.id=? and f.type=1
   ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../main.php?error=notconn");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $userid,$userid);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  while  ($row = mysqli_fetch_assoc($resultData)) {

    if($row['online'] == 1){
         printf ("
          <div class='friend'>
                     <i class='fas fa-comment fa-flip-horizontal notif'></i>
                     <i class='fas fa-user-circle fa-2x friend-icon'></i>
                 <div class='username-main'>
                   <span class='username-main-span'>%s</span>
                    <i class='fas fa-circle avatar online'></i>
                 </div>
                 <i class='fas fa-trash-alt remove'></i>
             </div>
             ",$row["username"]
           );

         }
         else {
              printf ("
            <div class='friend offline'>
                 <i class='fas fa-user-circle fa-2x friend-icon'></i>
                 <div class='username-main'>
                   <span class='username-main-span'>%s</span>
                    <i class='fas fa-circle avatar offline-icon'></i>
                 </div>
                 <i class='fas fa-trash-alt remove'></i>
             </div>
             ",$row["username"]
           );
         }
}
mysqli_stmt_close($stmt);
}
function do_you_have_friends($conn,$id){
    $sql = "SELECT *
    FROM fr
  where  (ids=? or rid=?) and type=1
   ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../register.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $id,$id);
  mysqli_stmt_execute($stmt);

  $resultDate = mysqli_stmt_get_result($stmt);
  if (mysqli_fetch_assoc($resultDate)) {
$result=true;
   return $result;
  }
  else {
    $result=false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}
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
if ($row = mysqli_fetch_assoc($resultData)) {
  while  ($row = mysqli_fetch_assoc($resultData)) {

     printf ("
         <tr>
           <th>%u</th>
           <th>%s</th>
           <th><button name='join' id='btn_create' class='btn-success' type='join' >JOIN</button></th>
         </tr>
         <tr>
         ",$row["1id"],$row["username"]
       );

   }
 }
     else {
       echo "<tr>
         <th>NO</th>
         <th>game</th>
         <th>available</th>
       </tr>
       <tr>";
     }




mysqli_stmt_close($stmt);


}
function set_logout($conn,$id){
  $online=0;
  $sqlUserUpdate = "
    UPDATE users
    SET online = '".$online."'
    WHERE id = '".$id."'";
  mysqli_query($conn, $sqlUserUpdate);
}
?>
