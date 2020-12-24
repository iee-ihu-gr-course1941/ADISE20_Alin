<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--SCRIPT FOR ONLINE INDICATOR <script>
        $(document).ready(function(){
            $("button").click(function(){
                $("#demo").removeClass("color");
            });
        });
    </script> -->
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

        });
    </script>

</head>
<body onload="OverflowStirng()">
    <div class="container-friends">      
        <div class="user">
            <i class="fas fa-user-circle fa-2x user-icon"></i>
            <i class="fas fa-circle avatar-user online"></i>
            <div class="username-main">
                <span class="username-main-span">Username</span>
            </div>
            <i class="fas fa-plus fa-lg add-friend"></i>
            <i id="sidebar-left-btn" class="fas fa-chevron-right fa-lg sidebar-right-btn"></i>
        </div>
        
            
        <div class="friends-list">
            <div class="friend">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>

                <div class="username-main">
                    <span class="username-main-span">Κουγιουμτζιδης Ιωαννης</span>
                    <i class="fas fa-circle avatar online"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            
            <div class="friend">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Κωνσταντινιδης Βασιλειος</span>
                    <i class="fas fa-circle avatar online"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>

            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Μαλουδης Αποστολος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Μαλουδης Αποστολος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Κωνσταντινιδης Βασιλειος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            
            <div class="friend">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Κουγιουμτζιδης Ιωαννης</span>
                    <i class="fas fa-circle avatar online"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            
            <div class="friend online">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Λαφιωτης Νικολαος</span>
                    <i class="fas fa-circle avatar online"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div> 
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Μαλουδης Αποστολος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Κουγιουμτζιδης Ιωαννης</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Κωνσταντινιδης Βασιλειος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Μαλουδης Αποστολος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Μαλουδης Αποστολος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
            <div class="friend offline">
                <i class="fas fa-user-circle fa-2x friend-icon"></i>
                <div class="username-main">
                    <span class="username-main-span">Λαφιωτης Νικολαος</span>
                    <i class="fas fa-circle avatar offline-icon"></i>
                </div>
                <i class="fas fa-trash-alt remove"></i>
            </div>
        </div>
    </div>
</body>
</html>