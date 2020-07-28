<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/
//Get Topic Information from Header

$topic= $_GET['topicID'];
$page= $_GET['page'];
$pageSize = 10;

// Use topicID to get messages

$topicArray=getTopicById($topic);

$title = $topicArray[title];
$owner = $topicArray[userId];
$user = getUserById($owner);
$ownerName = $user[username];
$createdDate = $topicArray[created_at];

// determine number of pages
$pageNumberDefault = 1;
$paginatedTopic = getMessagesByTopicIdPaginated($topic, $pageSize ,$pageNumberDefault);
$numberOfPages = $paginatedTopic[totalpages];

//determine current page
if ($page == 'last'){
  $currentPage = $numberOfPages;
} elseif ($page == 'first'){
  $currentPage = 1;
}else{
  $currentPage = $page;
}

//Get messages  for topic  QUESTION Pulling data from this array  Double check if this should  remain static
   
  $paginatedTopicMessageArray = getMessagesByTopicIdPaginated($topic, $pageSize ,$currentPage); 
  $paginatedTopicMessages = $paginatedTopicMessageArray[data];
  $totalPages = $paginatedTopicMessageArray[totalpages];
  
//Establish next and previous page
$previousPage = $currentPage-1;
$nextPage = $currentPage+1;

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
  <?php
    foreach($paginatedTopicMessages as $message){
        $messageAuthorId = $message[userId];
        $messageAuthor=getUserById($messageAuthorId);
        $messageAuthorName = $messageAuthor[username];
        ?> 
          <div id='message'>
            <p><?php echo $message[body]?></p>
            <h4> by <?php echo $messageAuthorName?></h4>
            <h4> Created: <?php echo $message[created_at]?></h4>
          </div>
        <?php        
    }
        ?>
        <div id='messagePage'>
            
        <?php if($page != first && $page != 1){ 
          ?>   
          <a href= 'topic.php?topicID=<?php echo $topic?>&page=<?php echo $previousPage ?>'> &lt;</a>
          <?php
        }
          ?>
        <?php
        for($i = 1; $i <= $numberOfPages; $i++){
          ?>
          <a href= 'topic.php?topicID=<?php echo $topic?>&page='<?php echo $i ?>><?php echo $i ?></a>
          <?php
        }
        if($page != last && $currentPage != $totalPages){ 
        ?>   
        <a href= 'topic.php?topicID=<?php echo $topic?>&page=<?php echo $nextPage ?>'> &gt;</a>
        <?php
          }
    ?>
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