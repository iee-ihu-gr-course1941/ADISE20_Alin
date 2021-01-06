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



function addf($conn,$user,$ids){

  $sql = "SELECT id FROM users WHERE username = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../register.php?error=stmtfailed");
  exit();
}
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);

$resultDate = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultDate);
mysqli_stmt_close($stmt);


  $sql = "INSERT INTO fr(ids, rid, type) VALUES (? , ? , 0)   ;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../register.php?error=stmtfailed");
  exit();
}

mysqli_stmt_bind_param($stmt, "ss", $ids, $row["id"]);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location: ../main.php");
  exit();
}
function get_all_fr($conn,$userid){
  $sql = "SELECT username
  FROM users u
  INNER JOIN fr f ON u.id=f.ids
where  f.rid= ? and f.type=0
 ;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../main.php?error=notconn");
  exit();
}
mysqli_stmt_bind_param($stmt, "s",$userid);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
while  ($row = mysqli_fetch_assoc($resultData)) {
            printf ("
          <div class='friend offline'>
               <i class='fas fa-user-circle fa-2x friend-icon'></i>
               <div class='username-main'>
                 <span class='username-main-span'>%s</span>
                  <i class='fas fa-circle avatar offline-icon'></i>
               </div>
                <button name='add' id='btn_create' class='remove' type='join' >ADD</button>

           </div>
           ",$row["username"]
         );
       }
mysqli_stmt_close($stmt);

}
 ?>
