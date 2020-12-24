$(document).ready(function(){
$('button[type="submit"]').click(function(){
	var username = $(".username input").val();
	var password = $(".password input").val();
	// Checking for blank fields.
		$.post("login.php",{ username1: username, password1:password},
		function(data) {

			if(data=='Invalid username..') {

				$('input[type="text"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
				$('input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
				alert(data);

			}else if(data=='Wrong username or password!'){

				$('input[type="text"],input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
				alert(data);

			} else if(data=='Successfully Logged in'){

				$("form")[0].reset();
				$('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
				alert(data);

			} else{

				alert(data);
				
			}
		});
	});
});
