<?php


function show_piece($x,$y) {
	global $mysqli;
	
	$sql = 'select * from board where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}
   
function move_piece($x,$y,$x2,$y2,$token) {
	
	if($token==null || $token=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"token is not set."]);
		exit;
	}
	
	$color = current_color($token);
	if($color==null ) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You are not a player of this game."]);
		exit;
	}
	$status = read_status();
	if($status['status']!='started') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Game is not in action."]);
		exit;
	}
	if($status['p_turn']!=$color) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"It is not your turn."]);
		exit;
	}
	$orig_board=read_board();
	$board=convert_board($orig_board);
	$n = add_valid_moves_to_piece($board,$color,$x,$y);
	if($n==0) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"This piece cannot move."]);
		exit;
	}
	foreach($board[$x][$y]['moves'] as $i=>$move) {
		if($x2==$move['x'] && $y2==$move['y']) {
			do_move($x,$y,$x2,$y2);
			exit;
		}
	}
	header("HTTP/1.1 400 Bad Request");
	print json_encode(['errormesg'=>"This move is illegal."]);
	exit;
}
		
function show_board($input) {
	global $mysqli;
	
	$b=current_color($input['token']);
	if($b) {
		show_board_by_player($b);
	} else {
		header('Content-type: application/json');
		print json_encode(read_board(), JSON_PRETTY_PRINT);
	}
}



function reset_board() {
	global $mysqli;
	$sql = 'call clean_board()';
	$mysqli->query($sql);
	
}

function read_board() {
	global $mysqli;
	$sql = 'select * from board';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_all(MYSQLI_ASSOC));
}

function convert_board(&$orig_board) {
	$board=[];
	foreach($orig_board as $i=>&$row) {
		$board[$row['x']][$row['y']] = &$row;
	} 
	return($board);
}

function show_board_by_player($b) {

	global $mysqli;

	$orig_board=read_board();
	$board=convert_board($orig_board);
	$status = read_status();
	if($status['status']=='started' && $status['p_turn']==$b && $b!=null) {
		// It my turn !!!!
		
		$n = add_valid_moves_to_board($board,$b);
		
		// Εάν n==0, τότε έχασα !!!!!
		// Θα πρέπει να ενημερωθεί το game_status.
	}
	header('Content-type: application/json');
	print json_encode($orig_board, JSON_PRETTY_PRINT);
}

function add_valid_moves_to_board(&$board,$b) {
	$number_of_moves=0;
	
	for($x=1;$x<30;$x++) {
		for($y=1;$y<14;$y++) {
			$number_of_moves+=add_valid_moves_to_piece($board,$b,$x,$y);
		}
	}
	return($number_of_moves);
}

function add_valid_moves_to_piece(&$board,$b,$x,$y) {
	$number_of_moves=0;
	if($board[$x][$y]['piece_color']==$b) {
		switch($board[$x][$y]['piece']){
			case 'p1': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p2': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p3': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p4': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p5': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p6': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p7': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p8': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p9': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p10': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p11': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p12': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p13': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p14': $number_of_moves+=p_moves($board,$b,$x,$y);break;
			case 'p15': $number_of_moves+=p_moves($board,$b,$x,$y);break;
		}
	} 
	return($number_of_moves);
}

function p_moves($board,$b,$x,$y) {
	$m = [
		[-1,0],
		[1,0],
	];
	$moves=[];
	foreach($m as $k=>$t) {
		$x2=$x+$t[0];
		$y2=$y+$t[1];
		if( $x2>=1 && $x2<=12 && $y2>=1 && $y2<=30 &&
			$board[$x2][$y2]['piece_color'] !=$b ) {
			// Αν ο προορισμός είναι εντός σκακιέρας και δεν υπάρχει δικό μου πιόνι
			$move=['x'=>$x2, 'y'=>$y2];
			$moves[]=$move;
		}
	}
	$board[$x][$y]['moves'] = $moves;
	return(sizeof($moves));
}

function pieces_moves(&$board,$b,$x,$y) {
	
	$direction=($b=='W')?1:-1;
	$moves=[];
	
	if($board[$x][$y+$direction]['piece_color']==null) {
		$move=['x'=>$x, 'y'=>$y+$direction];
		$moves[]=$move;
		if($board[$x][$y+2*$direction]['piece_color']==null) {
			$move=['x'=>$x, 'y'=>$y+2*$direction];
			$moves[]=$move;
		}
	}
	$board[$x][$y]['moves'] = $moves;
	return(sizeof($moves));
	
}

function do_move($x,$y,$x2,$y2) {
	global $mysqli;
	$sql = 'call `move_piece`(?,?,?,?);';
	$st = $mysqli->prepare($sql);
	$st->bind_param('iiii',$x,$y,$x2,$y2 );
	$st->execute();

	header('Content-type: application/json');
	print json_encode(read_board(), JSON_PRETTY_PRINT);
}

?>