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

session_start();  //Starting the Session
$_SESSION[username] =""; //Setting the Session UserName variable to Null
$_SESSION[userId] ="";  //Setting the Session UserId variable to Null
$_SESSION[authenticated]= false;
$showerrormessage=false;
//Checking to see if the username is not not empty or null
if ( (isset($_POST[password]) && (isset($_POST[username])) && ($_POST[password] != '') && ($_POST[username] != '')) ){
  $username = $_POST[username];
  $password = $_POST[password];

  //Checking the UserName and password against the User table in dboard database to see if they exist

  $loadedUserByUsernameAndPassword = getUserByUsernameAndPassword($username, $password); //saving the username and user ID to varable array loadedUserByUsernameAndPassword

  if ($loadedUserByUsernameAndPassword[userId]== ""){   //if username and password don't matach a result in database, specify to user they need to enter a valid user name and password
      $showerrormessage=true;
     // echo "<p id='loginfailed'> Login failed, please use a valid username and password:</p>";  //print message that login has failed and for user to login again
    }else{

    $_SESSION[username] = $loadedUserByUsernameAndPassword[username]; //saves username to Session variable username
    $_SESSION[userId]= $loadedUserByUsernameAndPassword[userId]; //saves userId to Session variable userId
    $_SESSION[authenticated] = true;
    header("location: index.php"); //navigate back to index page

  }

}



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



    <?php   //using the function above loadUserByUserNameand Password- If the result from query/function are null then show error is set to true Error statement is printed
    if($showerrormessage == true){


    ?>
      <p id='loginfailed'> Login failed, please use a valid username and password:</p> <!--error for login username/password being incorrect-->

    <?php
       }

    ?>

  <div class="login-page">
        <div class="form">
        <form class="login-form" method="post" action="signin.php">
        <h1 id="singinlabel">Sign In</h1>
        <br/>
          <label for="username" class= "label">User Name</label>
          <input class="username" type="text" name="username"/>
          <label for="password" class= "label">Password</label>
          <input class="password" type="password" name="password"/>
          <button type="submit">Sign In</button>
            <div class="message"><p><br/>
          <br/>
          <br/>
             Aren't you registered? <a href="register.php">Sign up</a>
          </p></div>
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
