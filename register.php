<?php
  $error_msg = "";
if(isset($_GET["error"])){
  if ($_GET["error"] == "emptyinput"){
    $error_msg = "συμπληρώστε ολα τα στοιχεία";
    //echo $error_msg;
    //echo "<p>συμπληρώστε ολα τα στοιχεία<p>";
  }
  else if ($_GET["error"] == "invalidusername"){
    $error_msg = "το ονομα δεν επιτρέπεται";
    //echo $error_msg;
   // echo "<p>το ονομα δεν επιτρέπεται<p>";
  }
  else if ($_GET["error"] == "invalidemail"){
    $error_msg = "το email δεν ειναι σωστο";
    //echo $error_msg;
    //echo "<p>το email δεν ειναι σωστο<p>";
  }
  else if ($_GET["error"] == "passwordsnotsame"){
    $error_msg = "οι κωδικοί δεν ταιριάζουν";
    //echo $error_msg;
   // echo "<p>οι κωδικοί δεν ταιριάζουν<p>";
  }
  else if ($_GET["error"] == "usernametaken"){
    $error_msg = "το ονομα υπάρχει ηδη";
    //echo $error_msg;
    //echo "<p>το ονομα υπάρχει ηδη<p>";
  }
  else if ($_GET["error"] == "stmtfailed"){
    $error_msg = "κατι πηγε λαθος";
    //echo $error_msg;
    //echo "<p>κατι πηγε λαθος<p>";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="register-bg">
    <div class="container container-register">
    <div>
    <span class="error-block"><?php  echo $error_msg; ?></span>
  </div>
        <div class="login">
            <div class="header">
                <h3>Εγγραφή</h3>
            </div>
          <form action="inc/sinup.inc.php" method="post">
                <div class="username-login">
                    <label class="input-filled">
                      <input type="text" name="username"  required>
                        <span class="placeholder-span">Όνομα Χρήστη</span>
                    </label>
                </div>
                <div class="email">
                    <label class="input-filled">
                    <input type="text"name="email" required>
                        <span class="placeholder-span">Email</span>
                    </label>
                </div>
                <div class="password">
                    <label class="input-filled">
                      <input type="password" name="password" required>
                        <span class="placeholder-span">Κωδικός Πρόσβασης</span>
                    </label>
                </div>
                <div class="password">
                    <label class="input-filled">
                      <input type="password" name="passwordrepeat" required>
                        <span class="placeholder-span">Επαλήθευση Κωδικού</span>
                    </label>
                </div>
                <div class="btn btn-rg">
                  <button type="submit" name="submit">εγγραφη</button>
                </div>
                <div class="create-acc create-acc-rg">
                    <a href="login.php">Είσοδος</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
