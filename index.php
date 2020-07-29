<?php
include("lib/functions.php");
session_start();

/*BUSINESS LOGIC CODE*/


/*if($_SESSION[authenticated]= true){
  ?>
    <script>var x = document.getElementById("signIn");
      x.style.display = "none";
    </script>  
  <?php
}else{
  ?>
    <script>var x = document.getElementById("welcome");
      x.style.display = "none";
    </script>  
  <?php
  
}*/


/*BUSINESS LOGIC CODE END*/
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>D-Board</title>
  <meta name="description" content="The D-Board project">
  <!-- CSS INCLUSION -->    
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->    
  <?php 
  if($_SESSION[authenticated] == true){
  ?>
       <div id="welcome">
          <h3 id="h3Welcome">Welcome <?php echo ($_SESSION[username]);?> </h3>
      </div> 
  <?php
  }
  else{
  ?>
      <div id="signIn">
          <a href="signin.php"> SIGN-IN </a> 
        </div>
  <?php    
  }
  ?>
  <!-- JS SCRIPT INCLUSION -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/scripts.js"></script>
  <script src="js/index.js"></script>
</body>
</html>