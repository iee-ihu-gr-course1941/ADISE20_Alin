<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="lobby.css">

    <script>
        function OverflowStirng(){
            var strings = document.getElementsByTagName("span");
            var dots = "...";

            for (i=0; i<strings.length;i++){
                if (strings[i].innerHTML.length>15){
                    strings[i].innerHTML = strings[i].innerHTML.substring(0,12) + dots;
                }
            }
        }


        var btn_state = 1;


        $(document).ready(function(){
            $(".sidebar-right-btn").click(function(){
                    $(".container-friends").toggleClass("active");
                    $(".user").toggleClass("user-sidebar");
                    $(".username-main-span").toggleClass("username-main-active");
                    $(".sidebar-right-btn").toggleClass("sidebar-right-btn-active");

                    $(".main_menu").toggleClass("mm_active");


                    if (btn_state==1){
                        $("#sidebar-left-btn").removeClass("fa-chevron-right");
                        $("#sidebar-left-btn").addClass("fa-chevron-left");

                        btn_state=0;
                    }else{
                        $("#sidebar-left-btn").removeClass("fa-chevron-left");
                        $("#sidebar-left-btn").addClass("fa-chevron-right");

                        btn_state=1;
                    }


            });

            $(".friend").click(function(){
                $(".chat").toggle();
            });

            $("#min").click(function(){
                $(".chat").toggle();
            });

            $(".remove").click(function(ev){
                window.alert("Remove");
                ev.stopPropagation();
            });

            $(".add-friend").click(function(){
  				if(document.getElementById('searchuser').style.display!='none'){
    				$("#searchuser").hide();
    				$("#request").hide();}
  				else{
    				$("#searchuser").show();
					$("#request").show();}
				});

        });
    </script>

</head>
<body onload="OverflowStirng()">
