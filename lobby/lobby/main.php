

<?php
include_once 'freind.php';

   ?>


        <div class="main_menu">
            <span class="skip" id="main_header">Play Backgammon</span>
            <span id="astr">*</span>

            <div class="main_btns">
                <form action="../inc/play.inc.php" method="post">
                    <button id="play_btn" type="play" name="play"><i style="font-size: 23px;" class="far fa-play-circle"></i> Play Online</button>
                </form>
                <form action="../bot/bot.html" method="POST">
                    <button id="bot_btn"><i class="fas fa-robot"></i> Computer</button>
                </form>  
                <button id="pl_fr_btn"><i class="fas fa-user-friends"></i> Create a Lobby</button>
                <form action="../inc/logout.inc.php" method="POST">
                    <button id="logout_btn" type="submit" name="logout"><i style="font-size: 23px;" class="fa fa-power-off"></i><b> Log Out</b></button>
	            </form>
            </div>
        </div>

    </div>

    <?php
    include_once 'footer.php';

       ?>
