<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    
</head>
<body class="login-bg">
    <div class="container">
        <div class="login">
            <div class="header">
                <h3>Σύνδεση</h3>
            </div>
            <form action="#">
                <div class="username-login">
                    <label class="input-filled">
                        <input required>
                        <span class="placeholder-span">Όνομα Χρήστη</span>
                    </label>
                    <p class="usererror"></p>
                </div>
                <div class="password">
                    <label class="input-filled">
                        <input type="password" required>
                        <span class="placeholder-span">Κωδικός Πρόσβασης</span>
                    </label>
                </div>
                <div class="btn">
                    <button type="submit" class="play-btn"><i class="fas fa-play"></i>επισκεπτης</button>
                    <button type="submit">εισοδος</button>
                </div>
                <div class="create-acc">
                    <a href="register.php">Δημιουργία λογαριασμού</a>
                </div>   
            </form>
        </div>
    </div>
<script src="js/login.js"></script>
</body>
</html>