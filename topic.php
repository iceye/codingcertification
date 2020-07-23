<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/
//Get Topic Information from Header

$topic= $_GET['topicID'];
$page= $_GET['page'];

//echo "$topic and $page";
//echo "\n";

// Use topicID to get messages

$topicarray=getTopicById($topic);

$title = $topicarray[title];
$owner = $topicarray[userId];
$user = getUserById($owner);
$ownerName = $user[username];
$createdDate = $topicarray[created_at];

//Get messages  for topic  QUESTION Pulling data from this array
  $pageSize = 10;
  // TODO convert 'last' into a page number (10)
  $pageNumber = 2; 
  //$topicMessages = getMessagesByTopicIdPaginated($topic, $pageSize ,$pageNumber); 
  $allMessagesForTopic = getMessagesByTopicId($topic);
  //print_r ($allMessagesForTopic);
  print_r ($allMessagesForTopic);
  //print_r($topicMessages); 
  echo count($allMessagesForTopic[0]);
  

  //TODO Order messages by created date




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
  <style>
   div {
    width: 300px;
    border: 15px solid green;
    padding: 50px;
    margin: 20px;
    }
  </style>
</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->    
  <h1>TOPIC - HELLO WORLD</h1>
  
  <a href="index.php">Back To Discussions</a>

  <div id="topic">
    <h3> <?php echo "$title" ?></h3>
    <p> Author <?php echo "$ownerName $createdDate" ?></p>
  </div>
  <div id="addMessage">
    <h3>Add Topic to Discussion</h3>
      <form action="/action_page.php">
        <label for="message">Post a message:</label><br>
        <textarea rows="5" cols="20" name="review">message field</textarea> <br>
        <input type="submit" value="Submit">
 <!---TODO: Make Submit button functional --->
      </form>
  </div>
  <div id="message">
    <p>Some Message Body</p>
    <h4>Message Author</h4>
    <h4>Message Created Date</h4>
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
  <script src="js/topic.js"></script>    
</body>
</html>