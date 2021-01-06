
<?php
include_once 'header.php';
include_once 'inc/friendsfunc.php';
include_once 'inc/config.php';
session_start();
// session_regenerate_id(true);
// include '../inc/config.php';
// require '../inc/friend.php';
// $db_connection = $conn;
// // FRIEND OBJECT
// $frnd_obj = new Friend($db_connection);
// // TOTLA FRIENDS
// $get_frnd_num = $frnd_obj->get_all_friends($_SESSION['userid'], false);
// // GET MY($_SESSION['user_id']) ALL FRIENDS
// $get_all_friends = $frnd_obj->get_all_friends($_SESSION['userid'], true);

   ?>
<div class="cont">
  <div class="notification">
       <div class="container-friends">
           <div class="user">
               <i class="fas fa-user-circle fa-2x user-icon"></i>
               <i class="fas fa-circle avatar-user online"></i>
               <div class="username-main">
                 <?php
                 require_once '../inc/config.php';
                /* include ('Chat.php');
                 $chat = new Chat();
                 $loggedUser = $chat->getUserDetails($_SESSION['userid']);
                 $currentSession = '';
                 foreach ($loggedUser as $user) {
                   $currentSession = $user['current_session'];*/
                   echo '<span class="username-main-span">'.$_SESSION["user"].'</span>';
             ?>

               </div>
               <i class="fas fa-plus fa-lg add-friend"></i>
               <i id="sidebar-left-btn" class="fas fa-chevron-right fa-lg sidebar-right-btn"></i>
           </div>
           <div class="search-user">
             <form action="inc/add.inc.php" method="post">
                      <button name='add' type="add" id="request" ><i class="fa fa-search"></i></button>
                           <input type="text" id='searchuser' placeholder="Search.." name="user">
                         </form>
                      </div>

           <div id= "f" class="friends-list">

                   <?php
                  if(!do_you_have_friends($conn,$_SESSION['userid'])){
                       echo "<div class='friend'>
                       <ps style='color:white;'>you have no friends</p>
                       </div>";
                      }
                    else{
                      get_all_friends($conn,$_SESSION['userid']);
                    }
        get_all_fr($conn,$_SESSION['userid']);




               ?>
        </div>
    </div>
       <div class="chat">
               <div class="chatting_with">
                   <i class="fas fa-user-circle fa-2x friend-icon chatting_icon"></i>
                   <i class="fas fa-circle avatar online chatting_online"></i>
                   <span class="skip skip_chat">Username Chatting</span>
                   <i class="fas fa-window-minimize" id="min"></i>
               </div>
               <div class="chat_messages">
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
                       <span>asdasd</span><br>
               </div>
               <input id="chat_input" type="text" placeholder="Type here...">
           </div>
