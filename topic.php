<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/
/* BUSINESS LOGIC CODE */
//Get Topic Information from Header

$topic= $_GET['topicID'];
$page= $_GET['page'];

//echo "$topic and $page";
//echo "\n";

// Use topicID to get messages

$topicarray=getTopicById($topic);

$title = $topicarray[title];
$owner = $topicarray[userId];
//TODO: get username 
$user = getUserById($owner);
$username = $user[username];
$created = $topicarray[created_at];

 // echo "$title";
  //echo "$owner";
  //echo "$created";
  echo "$username";



// BUSINESS LOGIC CODE END
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>D-Board</title>
  <meta name="description" content="The D-Board project">
  <!-- CSS INCLUSION -->    
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/topic.css">
</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->    
  <h1>TOPIC - HELLO WORLD</h1>
  
  <a href="index.php">Back To Discussions</a>
  <!-- JS SCRIPT INCLUSION -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/scripts.js"></script>
  <script src="js/topic.js"></script>    
</body>
</html>