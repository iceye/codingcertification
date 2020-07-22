<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/

  $username = $_POST['username'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

if ($password_1 != $password_2) {
    echo "The passwords typed don't match";
  }


else {
    $password = md5($password_1);
    if ($username != "") {
        $checkuser = saveNewUser($username, $password);
        if ($checkuser == "0") {
            echo "The username typed already exists";
        }
        else {echo "User created";}
    }  
}


/*BUSINESS LOGIC CODE END*/

?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>D-Board</title>
  <meta name="description" content="The D-Board project">
  <!-- CSS INCLUSION -->    
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/register.css">
</head>

<body>




  <!-- ADD HERE YOUR HTML CODE --> 

  <form method="post" action="register.php" id="register_form">
    <h1>Sign Up</h1>
    <?php include('errors.php'); ?>

      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1" id="psw_1" required>
      </div>
      <div class="input-group">
        <label>Repeat password</label>
        <input type="password" name="password_2" id="psw_2" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Sign up</button>
      </div>
      <p>
        Already registered? <a href="signin.php">Sign in</a>
      </p>
    </form>



  <!-- JS SCRIPT INCLUSION -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/scripts.js"></script>
  <script src="js/register.js"></script>
</body>
</html>


