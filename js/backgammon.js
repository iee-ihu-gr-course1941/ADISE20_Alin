var me={token:null,piece_color:null};
var game_status ={};
var board={};
var last_update=new Date().getTime();
var timer=null;




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
	$(document).on("click", "img.dice" , function() {
		roll_dice();
	});
});

function draw_empty_board(p) {

	if(p!='B') {p='W';}
	var draw_init = {
		'W': {i1:1,i2:14,istep:1,j1:1,j2:14,jstep:1},
		'B': {i1:13,i2:0,istep:-1, j1:13,j2:0,jstep:-1}
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
					t += '<td class="chess_square test" id="square_'+(j-1)+'_'+i+'"></td>'; 
				}else{
					t += '<td class="chess_square test" id="square_'+(j-1)+'_'+i+'"></td>'; 
				}
			}else{
				if(i==6 || i==7 || i==8){
					t += '<td class="chess_square test" id="square_'+(j-1)+'_'+i+'"></td>';
				}else{
					t += '<td class="chess_square test" id="square_'+j+'_'+i+'"></td>';
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
		success: fill_board_by_data });
}

function reset_board() {
	$.ajax({url: "backgammon.php/board/", method: 'POST',  success: fill_board_by_data });
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


		if(o.y>5 && o.y<16){
			id_table='#square_'+ o.x +'_' +'5';
		}else if(o.y>15 && o.y<27){
			index = 9;
			id_table='#square_'+ o.x +'_' +index;
		}else if(o.y>=27){
			index++;
			id_table='#square_'+ o.x +'_' +index;
		}
		

	    var im = (o.piece!=null)?'<img class="piece" id="'+img_id+'" src="images/'+c+'.svg">':'';
		$(id_table).append(im);
		
	}
	fill_board_stack_count();
	fill_board_dice();

}

function fill_board_stack_count(){

	for (i=0;i<14;i++){
		var td_id_white = '#square_'+i+'_5';
		var td_id_black = '#square_'+i+'_9';

		var td_white = $(td_id_white);
		var td_black = $(td_id_black);

		// var td_id_white_position = '#square_'+i+'_6';
		var td_id_white_position = '#square_'+i+'_5';

		// var td_id_black_position = '#square_'+i+'_8';
		var td_id_black_position = '#square_'+i+'_9';

		var td_white_position= $(td_id_white_position);
		var td_black_position= $(td_id_black_position);

		var count_white = $(td_white).children().length;
		var count_black = $(td_black).children().length;

		if (count_white==0){
			var span1 = '<span class="piece_count_white"></span>';
		}else{
			// var span1 = '<span class="piece_count_white">'+'+'+(count_white-1)+'</span>';
			var span1 = '<span class="piece_count_white">'+(count_white+4)+'</span>';
		}

		if (count_black==0){
			var span2 = '<span class="piece_count_black"></span>';
		}else{
			// var span2 = '<span class="piece_count_black">'+'+'+(count_black-1)+'</span>';
			var span2 = '<span class="piece_count_black">'+(count_black+4)+'</span>';
		}

		td_white_position.append(span1);
		td_black_position.append(span2);	
	}
}


function fill_board_dice(){

	let roll1 = Math.floor((Math.random() * 6) + 1);
	let roll2 = Math.floor((Math.random() * 6) + 1);

	var dice1 ='<img class="dice" src="images/d'+roll1+'.svg">';
	var dice2 ='<img class="dice" src="images/d'+roll2+'.svg">';
	$('#square_9_7').append(dice1);
	$('#square_10_7').append(dice2);

}


function roll_dice(){
	let roll1 = Math.floor((Math.random() * 6) + 1);
	let roll2 = Math.floor((Math.random() * 6) + 1);

	var dice1 ='<img class="dice" src="images/d'+roll1+'.svg">';
	var dice2 ='<img class="dice" src="images/d'+roll2+'.svg">';
	$('#square_9_7').html(dice1);
	$('#square_10_7').html(dice2);
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
	$.ajax({url: "backgammon.php/status/", success: update_status });
}

function update_status(data) {
	game_status=data[0];
	update_info();
	if(game_status.p_turn==me.piece_color &&  me.piece_color!=null) {
		x=0;
		// do play
		$('#move_div').show(1000);
		setTimeout(function() { game_status_update();}, 15000);
	} else {
		// must wait for something
		$('#move_div').hide(1000);
		setTimeout(function() { game_status_update();}, 4000);
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
			data: JSON.stringify( {x: a[2], y: a[3]}),
			success: move_result,
			error: login_error});
	
}
function move_result(data){
	fill_board_by_data(data);
	$('#move_div').hide(1000);
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