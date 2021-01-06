<?php
function emptyInputLogin($username, $password){
  $result;
  if (empty($username) || empty($password)) {
  $result = true;
  }
  else {
    $result = false;
  }
return $result;
}
  function emptyInputSingup($username, $email, $password, $passwordrepeat){
    $result;
    if (empty($username) || empty($email) || empty($password) || empty($passwordrepeat)) {
    $result = true;
    }
    else {
      $result = false;
    }
  return $result;
  }

  function invalidusername($username){
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
    }
    else {
      $result = false;
    }
  return $result;
  }
  function invalidemail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
    }
    else {
      $result = false;
    }
  return $result;
  }

  function passwordMatch($password, $passwordrepeat){
    $result;
    if ($password !== $passwordrepeat) {
    $result = true;
    }
    else {
      $result = false;
    }
  return $result;
  }
  function userExists($conn, $username){
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../register.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);

  $resultDate = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($resultDate)) {
   return $row;
  }
  else {
    $result=false;
    return $result;
  }
  mysqli_stmt_close($stmt);
  }


  function createUser($conn, $username, $email, $password){
    $sql = "INSERT INTO users(username, email, password) VALUES (? , ? , ?)   ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../register.php?error=stmtfailed");
    exit();
  }

  $hashedPass = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPass);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("Location: ../login.php?error=none");
    exit();
  }

  function loginUser($conn, $username,$password){
    $userExists = userExists($conn, $username);
    if ($userExists == false){
    header("Location: ../login.php?error=wronglogin");
    exit();
    }
    $passwordHashed = $userExists["password"];
    $checkpass = password_verify($password,$passwordHashed);
    if ($checkpass == false){
    header("Location: ../login.php?error=wronglogin");
    exit();
    }
    else if($checkpass = true){
      $online=1;
      session_start();

      // $_SESSION = [
      //   'userid' => $row['id'],
      //   'user' => $row['username']
      //   ];
        $_SESSION["userid"] = $userExists["id"];
        $_SESSION["user"] = $userExists["username"];
        $sqlUserUpdate = "
          UPDATE users
          SET online = '".$online."'
          WHERE id = '".$_SESSION["userid"]."'";
        mysqli_query($conn, $sqlUserUpdate);

      /*session_start();
      include ('Chat.php');
      $chat = new Chat();
      $_SESSION['username'] = $user[0]['username'];
      $_SESSION['userid'] = $user[0]['userid'];
      $chat->updateUserOnline($user[0]['userid'], 1);
      $lastInsertId = $chat->insertUserLoginDetails($user[0]['userid']);
      $_SESSION['login_details_id'] = $lastInsertId;*/

        header("Location: ../lobby/main.php");
      exit();

    }
  }
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
