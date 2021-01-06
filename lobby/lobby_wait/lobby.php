

<?php
include_once '../freind.php';

   ?>


    <div class="lobby">
        <div class="lobby_notifications">

            <div class="lobby_messages">
            </div>

            <div class="lobby_chat">
                <input class="lobby_chat_input" type="text" placeholder="Write a message">
                <i class="far fa-arrow-alt-circle-up send_icon"></i>
            </div>
        </div>

        <div class="control_panel">
            <div class="lobby_players">
                <div class="player">
                    <i class="fas fa-user-circle fa-2x player_icon"></i>
                    <?php

                      echo '<span class="username-main-span">'.$_SESSION["user"].'</span>';
                    ?>
                
                </div>
                <div class="player">
                    <i class="fas fa-user-circle fa-2x player_icon"></i>
                    <span>Player 2</span>
                </div>
            </div>

            <div class="control_panel_btns">
                <div class="control_btns_row1">
                    <button id="invite_player_btn">Invite Player</button>
                </div>
                <div class="control_btns_row2">
                    <button id="leave_lobby_btn">Leave Lobby</button>
                    <button id="start_game_btn">Start Game</button>
                </div>
            </div>
        </div>
    </div>

    <div class="invite_modal">
        <div class="modal_content">
            <i class="fas fa-times" id="close_modal"></i>


            <span id="inv_fr_header">Invite Friend</span>
            <form action="">
                <div class="invite_friends">
                    <input type="radio" id="friend1" name="friend" value="frind1">
                    <label for="friend1">Friend 1</label><br>
                    <input type="radio" id="friend2" name="friend" value="friend2">
                    <label for="friend2">Friend 2</label><br>
                    <input type="radio" id="friend3" name="friend" value="friend3">
                    <label for="friend3">Friend 3</label>
                </div>

                <button id="invite">Invite</button>
            </form>
        </div>
    </div>

    <?php
    include_once '../footer.php';

       ?>
