var me={token:null,piece_color:null};
var game_status ={};
var board={};
var last_update=new Date().getTime();
var timer=null;
var sc = 0;
var dicep= [];


$(function () {
	draw_empty_board();
	fill_board();
	$("#backgammon_login").click(login_to_game);
	$("#backgammon_reset").click(reset_board);
	$('#do_move').click( do_move);
	$('#move_div').hide();
	game_status_update();
	$('#the_move_src').change( update_moves_selector);
	$('#do_move2').click( do_move2);
	// $(document).on("click", "img.dice" , function() {
	// 	roll_dice();
	// });
	// roll_dice();
	$('.dice').click(roll_dice);
});

function draw_empty_board(p) {

	if(p!='B') {p='W';}
	var draw_init = {
		'B': {i1:30,i2:0,istep:-1,j1:13,j2:0,jstep:-1},
		'W': {i1:1,i2:31,istep:1, j1:1,j2:14,jstep:1}
	};
	var s=draw_init[p];

	var t='<table id="backgammon_table">';
	for(var i=s.i1;i!=s.i2;i+=s.istep) {
		t += '<tr>';
		for(var j=s.j1;j!=s.j2;j+=s.jstep) {
			if (j==7){
				t+= '<td class="empty test"></td>';
			}else if(j>7){
				
				if (i==6 || i==7 || i==8){
					t += '<td class="backgammon_square test" id="square_'+(j-1)+'_'+i+'"></td>'; 
				}else{
					t += '<td class="backgammon_square test" id="square_'+(j-1)+'_'+i+'"></td>'; 
				}
			}else{
				if(i==6 || i==7 || i==8){
					t += '<td class="backgammon_square test" id="square_'+(j-1)+'_'+i+'"></td>';
				}else{
					t += '<td class="backgammon_square test" id="square_'+j+'_'+i+'"></td>';
				}
			}
		}

		
		t+='</tr>';
	}
	t+='</table>';
	
	$('#backgammon_board').html(t);
	$('.backgammon_square').click(click_on_piece);
}

function fill_board() {
	$.ajax({url: "backgammon.php/board/", 
		headers: {"X-Token": me.token},
			dataType: "json",
			contentType: 'application/json',
			data: JSON.stringify( {token: me.token, dc1: dicep[0], dc2: dicep[1]}),
			success: fill_board_by_data });
}

function reset_board() {
	$.ajax({url: "backgammon.php/board/", headers: {"X-Token": me.token}, method: 'POST',  success: fill_board_by_data });
	$('#move_div').hide();
	$('#game_initializer').show(2000);
}

function fill_board_by_data(data) {
	board=data;
	for(var i=0;i<data.length;i++) {
		var o = data[i];
		var id_table ='#square_'+ o.x +'_' +o.y;
		var img_id ='piece_'+o.x +'_' + o.y;
		var c = (o.piece!=null)?o.piece_color:'';
		var index;
		var count_id='#span_'+o.x+'_'+o.y;
		var pc= (o.piece!=null)?'piece'+o.piece_color:'';

		// if(o.y>5 && o.y<16){
		// 	id_table='#square_'+ o.x +'_' +'5';
		// }else if(o.y>15 && o.y<27){
		// 	index = 9;
		// 	id_table='#square_'+ o.x +'_' +index;
		// }else if(o.y>=27){
		// 	index++;
		// 	id_table='#square_'+ o.x +'_' +index;
		// }
		

	    var im = (o.piece!=null)?'<img class="piece '+pc+'" id="'+img_id+'" src="images/'+c+'.svg">':'';
		$(id_table).html(im);
		
	}
	// fill_board_stack_count();
	// fill_board_dice();

	// $('.ui-droppable').droppable( "disable" );
		
	if(me && me.piece_color!=null) {
		$('.piece'+me.piece_color).draggable({start: start_dragging, stop: end_dragging, revert:true});
	}
	if(me.piece_color!=null && game_status.p_turn==me.piece_color) {
		$('#move_div').show(1000);
	} else {
		$('#move_div').hide(1000);
	}
}

// function fill_board_stack_count(){

// 	for (i=0;i<14;i++){
// 		var td_id_white = '#square_'+i+'_5';
// 		var td_id_black = '#square_'+i+'_9';

// 		var td_white = $(td_id_white);
// 		var td_black = $(td_id_black);

// 		// var td_id_white_position = '#square_'+i+'_6';
// 		var td_id_white_position = '#square_'+i+'_5';

// 		// var td_id_black_position = '#square_'+i+'_8';
// 		var td_id_black_position = '#square_'+i+'_9';

// 		var td_white_position= $(td_id_white_position);
// 		var td_black_position= $(td_id_black_position);

// 		var count_white = $(td_white).children().length;
// 		var count_black = $(td_black).children().length;

// 		if (count_white<5){
// 			var span1 = '<span class="piece_count_white"></span>';
// 		}else{
// 			if (sc>13){
// 				var span1 = '<span class="piece_count_white">'+(count_white+3)+'</span>';
// 			}else{
// 				var span1 = '<span class="piece_count_white">'+(count_white+4)+'</span>';
// 			}
// 		}

// 		if (count_black<5){
// 			var span2 = '<span class="piece_count_black"></span>';
// 		}else{
// 			if (sc>13){
// 				var span2 = '<span class="piece_count_black">'+(count_black+3)+'</span>';
// 			}else{
// 				var span2 = '<span class="piece_count_black">'+(count_black+4)+'</span>';
// 			}
// 		}

// 		if (sc>13){
// 			td_white_position.find('span').remove();
// 			td_black_position.find('span').remove();
// 			td_white_position.append(span1);
// 			td_black_position.append(span2);
// 			sc++;
// 		}else{
// 			td_white_position.append(span1);
// 			td_black_position.append(span2);
// 			sc++;
// 		}

			
// 	}
// }



function roll_dice(){
	let roll1 = Math.floor((Math.random() * 6) + 1);
	let roll2 = Math.floor((Math.random() * 6) + 1);

	dicep[0]= roll1;
	dicep[1] =roll2;

	let dice1 = "images/d"+roll1+".svg";
	let dice2 = "images/d"+roll2+".svg";

	$("#dice1").attr("src", dice1);
	$("#dice2").attr("src", dice2);


	// $('#dice1').html(dice1);
	// $('#dice2').html(dice2);
}






function login_to_game() {
	if($('#player_username').val()=='') {
		alert('You have to set a username');
		return;
	}
	var p_color = $('#pcolor').val();
	draw_empty_board(p_color);
	fill_board();
	
	$.ajax({url: "backgammon.php/players/"+p_color, 
			method: 'PUT',
			dataType: "json",
			headers: {"X-Token": me.token},
			contentType: 'application/json',
			data: JSON.stringify( {username: $('#player_username').val(), piece_color: p_color}),
			success: login_result,
			error: login_error});
}
function login_result(data) {
	me = data[0];
	$('#game_initializer').hide();
	update_info();
	game_status_update();
}
function login_error(data,y,z,c) {
	var x = data.responseJSON;
	alert(x.er);
}

function game_status_update() {
	
	clearTimeout(timer);
	$.ajax({url: "backgammon.php/status/", success: update_status,headers: {"X-Token": me.token} });
}

function update_status(data) {
	last_update=new Date().getTime();
	var game_stat_old = game_status;
	game_status=data[0];
	update_info();
	clearTimeout(timer);
	if(game_status.p_turn==me.piece_color &&  me.piece_color!=null) {
		x=0;
		// do play
		if(game_stat_old.p_turn!=game_status.p_turn) {
			fill_board();
		}
		$('#move_div').show(1000);
		timer=setTimeout(function() { game_status_update();}, 15000);
	} else {
		// must wait for something
		$('#move_div').hide(1000);
		timer=setTimeout(function() { game_status_update();}, 4000);
	}
 	
}

function update_info(){
	$('#game_info').html("I am Player: "+me.piece_color+", my name is "+me.username +'<br>Token='+me.token+'<br>Game state: '+game_status.status+', '+ game_status.p_turn+' must play now.');
	
}


function do_move() {
	var s = $('#the_move').val();
	
	var a = s.trim().split(/[ ]+/);
	if(a.length!=4) {
		alert('Must give 4 numbers');
		return;
	}
	$.ajax({url: "backgammon.php/board/piece/"+a[0]+'/'+a[1], 
			method: 'PUT',
			dataType: "json",
			contentType: 'application/json',
			data: JSON.stringify( {x: a[2], y: a[3], dc1: dicep[0], dc2: dicep[1]}),
			headers: {"X-Token": me.token},
			success: move_result,
			error: login_error});
	
}

function move_result(data){
	game_status_update();
	fill_board_by_data(data);
}


function update_moves_selector() {
	$('.backgammon_square').removeClass('pmove').removeClass('tomove');
	var s = $('#the_move_src').val();
	var a = s.trim().split(/[ ]+/);
	$('#the_move_dest').html('');
	if(a.length!=2) {
		return;
	}
	var id = '#square_'+ a[0]+'_'+a[1];
	$(id).addClass('tomove');
	for(i=0;i<board.length;i++) {
		if(board[i].x==a[0] && board[i].y==a[1]) {
			for(m=0;m<board[i].moves.length;m++) {
				$('#the_move_dest').append('<option value="'+board[i].moves[m].x+' '+board[i].moves[m].y+'">'+board[i].moves[m].x+' '+board[i].moves[m].y+'</option>');
				var id = '#square_'+ board[i].moves[m].x +'_' + board[i].moves[m].y;
				$(id).addClass('pmove');
			}
			
		}
	}
}

function do_move2() {
	$('#the_move').val($('#the_move_src').val() +' ' + $('#the_move_dest').val());
	do_move();
	$('.chess_square').removeClass('pmove').removeClass('tomove');
}

function click_on_piece(e) {
	var o=e.target;
	if(o.tagName!='TD') {o=o.parentNode;}
	if(o.tagName!='TD') {return;}
	
	var id=o.id;
	var a=id.split(/_/);
	$('#the_move_src').val(a[1]+' ' +a[2]);
	update_moves_selector();
}


function start_dragging ( event, ui ) {
	var x;
	
	var o=event.target.parentNode;
	var id = o.id;
	var a = id.trim().split(/_/);
	
	$(o).addClass('tomove');
	for(i=0;i<board.length;i++) {
		if(board[i].x==a[1] && board[i].y==a[2] && board[i].moves && Array.isArray(board[i].moves)) {
			for(m=0;m<board[i].moves.length;m++) {
				$('#the_move_dest').append('<option value="'+board[i].moves[m].x+' '+board[i].moves[m].y+'">'+board[i].moves[m].x+' '+board[i].moves[m].y+'</option>');
				var id = '#square_'+ board[i].moves[m].x +'_' + board[i].moves[m].y;
				$(id).addClass('pmove').droppable({drop: dropping}).droppable('enable');
			}
		}
	}
}

function dropping( event, ui ) {
	var x;

	ui.draggable[0].validMove=1;
	var id = this.id;
	var a2 = id.split(/_/);
	var a1 = ui.draggable[0].parentNode.id.split(/_/);

	$('#the_move').val(a1[1]+' '+a1[2]+' '+a2[1]+' '+a2[2]);
	$('.chess_square').removeClass('pmove').removeClass('tomove');
do_move();
}


function end_dragging ( event, ui ) {
	var x;

	if(this.validMove) {
		this.validMove=0;
		return;
	}
	$('.chess_square').removeClass('pmove').removeClass('tomove');
	this.top=0;
	this.left=0;
}