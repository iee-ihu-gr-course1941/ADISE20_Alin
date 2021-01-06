<?php
include "config.php";
session_start()
$userid=$_SESSION["userid"];
  $sql = "SELECT username
  FROM users u
  INNER JOIN fr f ON u.id=f.ids

where u.id=? and f.type=0
UNION
  SELECT username
  FROM users u

  INNER JOIN fr f ON u.id=f.rid
    where u.id=? and f.type=0
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

?>
