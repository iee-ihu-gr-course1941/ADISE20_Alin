<?php
session_start();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/backgammon.js"></script>
    <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<link href="jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet">
    <style>
    body{
    background-color: wheat;
}
table, td {
  border: 1px solid black;
  color:white;

}
table{
    width: 840px;
    height: 590px;
    position: absolute;
    top: 29px;
    left: 30px;
}
td > img{
    position: absolute;
    width: 70%;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.piece_count_white{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    color: black;
    user-select: none;
    font-size: 24px;
    pointer-events:none;
}
.piece_count_black{
    user-select: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    color: white;
    font-size: 24px;
    pointer-events:none;
}
.test{
    position: relative;
}
.empty{
    width: 45px;
    height: 10px;
}
.dice{
    display: flex;
    position: relative;
    left: 23.4%;
    cursor: pointer;
}
.row_y{
    display: flex;
    flex-direction: column;
    color: white;
    position: absolute;
    top: 4%;
    left: 0.9%;
    z-index: 100;
}
.row_y span{
    font-size: 13px;
    padding-bottom: 4.7px;
}
.row_x1{
    position: absolute;
    top: 1%;
    left: 2%;
    color: white;
    display: flex;
    z-index: 100;
}
.row_x1 span{
    padding: 0px 30px 0px 30px;
}
.row_x2{
    position: absolute;
    display: flex;
    top: 1%;
    left: 31%;
    color: white;
    z-index: 100;
}
.row_x2 span{
    padding: 0px 32px 0px 25px;
}
    </style>
</head>
<body>
  <div class="row_x1">
       <span>1</span>
       <span>2</span>
       <span>3</span>
       <span>4</span>
       <span>5</span>
       <span>6</span>
   </div>
   <div class="row_x2">
       <span>7</span>
       <span>8</span>
       <span>9</span>
       <span>10</span>
       <span>11</span>
       <span>12</span>
   </div>
    <img src="images/backgammon_table.svg" style="width: 880px;"  alt="">
    <div class="row_y">
        <span>1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
        <span>6</span>
        <span>7</span>
        <span>8</span>
        <span>9</span>
        <span>10</span>
        <span>11</span>
        <span>12</span>
        <span>13</span>
        <span>14</span>
        <span>15</span>
        <span>16</span>
        <span>17</span>
        <span>18</span>
        <span>19</span>
        <span>20</span>
        <span>21</span>
        <span>22</span>
        <span>23</span>
        <span>24</span>
        <span>25</span>
        <span>26</span>
        <span>27</span>
        <span>28</span>
        <span>29</span>
        <span>30</span>
    </div>
    <!-- <table id="table"></table> -->
    <div id="backgammon_board"></div>
    <br>
    <div class="dice">
        <img id="dice1" src="images/d1.svg">
        <img id="dice2" src="images/d1.svg">
    </div>

    <div id="game_initializer">
        <input type="text" value="<?php echo $_SESSION["user"];?>"id="player_username">
        <select name="" id="pcolor">
            <option value="W">W</option>
            <option value="B">B</option>
        </select>
        <button id="backgammon_login">Login to game</button>
    </div>
    <div id="game_info">
    </div>
    <br>
    <!-- <div id="backgammon_reset">Reset Board</div> -->
    <div id='move_div'>
        Δώσε κίνηση (x1 y1 x2 y2): <input id='the_move'>  <button id='do_move' class='btn btn-primary'>ΚΑΝΕ ΤΗΝ ΚΙΝΗΣΗ</button><br>
        </div>
    Δώσε κίνηση (x1 y1): <input id='the_move_src'> (x2 y2):
    <select id='the_move_dest'></select>
    <button id='do_move2' class='btn btn-primary'>ΚΑΝΕ ΤΗΝ ΚΙΝΗΣΗ 2</button><br>
    </div>
</body>
</html>
