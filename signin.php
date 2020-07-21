<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/

session_start();  //Starting the Session
$_SESSION[username] =""; //Setting the Session UserName variable to Null
$_SESSION[userId] ="";  //Setting the Session UserId variable to Null
$_SESSION[authenticated]= false;

//Checking to see if the username is not not empty or null
if ( (isset($_POST[password]) && (isset($_POST[username])) && ($_POST[password] != '') && ($_POST[username] != '')) ){  
  $username = $_POST[username];
  $password = $_POST[password];


  //echo $username;
  //echo $password;

  //Checking the UserName and password against the User table in dboard database to see if they exist

  $loadedUserByUsernameAndPassword = getUserByUsernameAndPassword($username, $password); //saving the username and user ID to varable array loadedUserByUsernameAndPassword 
  $_SESSION[username] = $loadedUserByUsernameAndPassword[username]; //saves username to Session variable username
  $_SESSION[userId]= $loadedUserByUsernameAndPassword[userId]; //saves userId to Session variable userId
  $_SESSION[authenticated] = true;
  header("location: index.php"); //navigate back to index page 

//print_r ($loadedUserByUsernameAndPassword); //used to check if username, userID was saved to array correctly



}

/*BUSINESS LOGIC CODE END*/
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign In</title>
  <meta name="description" content="The D-Board project">
  <!-- CSS INCLUSION -->    
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/signin.css">    
</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->    
  <div class="login-page">
        <div class="form">
        <form class="login-form" method="post" action="signin.php">
          <input class="username" type="text" name="username" placeholder="username" />
          <input class="password" type="password" name="password" placeholder="password" />
          <button type="submit">login</button>
        </form> 
      </div>  
</div>
  <!-- JS SCRIPT INCLUSION -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/scripts.js"></script>
  <script src="js/signin.js"></script>    
</body>
</html>