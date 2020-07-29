<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/
//Get Topic Information from Header

$topic= $_GET['topicID'];
$page= $_GET['page'];
$pageSize = 10;
$successMessage=false;

// Use topicID to get messages

$topicArray=getTopicById($topic);

$title = $topicArray['title'];
$owner = $topicArray['userId'];
$user = getUserById($owner);
$ownerName = $user['username'];
$createdDate = $topicArray['created_at'];
$datecreate= date_create($createdDate);
$formatcreatedDate= date_format($datecreate, "l, F d, Y");

// determine number of pages
$pageNumberDefault = 1;
$paginatedTopic = getMessagesByTopicIdPaginated($topic, $pageSize ,$pageNumberDefault);
$numberOfPages = $paginatedTopic['totalpages'];

//determine current page
if ($page == 'last'){
  $currentPage = $numberOfPages;
} elseif ($page == 'first'){
  $currentPage = 1;
}else{
  $currentPage = $page;
}

 //Get UserId from Session
 session_start(); 
 $addMessageUserId = $_SESSION[userId];
 //TEMP Value for userId
 $addMessageUserId = 1;

//Add posted Message to Topic
$newMessage=$_POST['message'];
 if($newMessage != '' || $newMessage != NUll){
    $page = "first";
    $currentPage = 1;
    $addMessageStatus= saveNewMessage($newMessage, $topic, $addMessageUserId);
    if ($addMessageStatus !=-1 && $addMessageStatus !=''&& $addMessageStatus != NULL){
      $successMessage = true;
    }
  }

//Get messages  for topic  QUESTION Pulling data from this array  Double check if this should  remain static

  $paginatedTopicMessageArray = getMessagesByTopicIdPaginated($topic, $pageSize ,$currentPage);
  $paginatedTopicMessages = $paginatedTopicMessageArray['data'];
  $totalPages = $paginatedTopicMessageArray['totalpages'];

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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/topic.css">

</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->
  <div id="backToDiscussion">
    <a href="index.php">Back To Discussions</a>
  </div>
  <div id="topic">
    <h3> <?php echo "$title" ?></h3>
    <p> <?php echo $ownerName."&nbsp;&nbsp;&nbsp;".$formatcreatedDate ?></p>
  </div>
  <div id="addMessage">
    <h3>Add Topic to Discussion</h3>
      <form method="post" action="topic.php?topicID=<?php echo $topic ?>&page=first">
        <label for="message">Message</label><br>
        <textarea rows="5" cols="20" name="message"></textarea> <br>
        <input type="submit" value="Add Message" id="submit">
      </form>
  </div>
  <?php
    foreach($paginatedTopicMessages as $message){
        $messageAuthorId = $message['userId'];
        $messageAuthor=getUserById($messageAuthorId);
        $messageAuthorName = $messageAuthor['username'];
        $messagecreatedate= $message['created_at'];
        $messagedatecreate= date_create($messagecreatedate);
        $messageformateddate= date_format($messagedatecreate, "l, F d, Y" );
        ?>
          <div id='message'>
            <p><?php echo $message['body']?></p>
            <h4><?php echo $messageAuthorName."&nbsp;&nbsp;&nbsp;".$messageformateddate?></h4>
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
          <a href= 'topic.php?topicID=<?php echo $topic?>&page=<?php echo $i ?>'><?php echo $i ?></a>
          <?php
        }
        if($page != last && $currentPage != $totalPages){
        ?>
        <a href= 'topic.php?topicID=<?php echo $topic?>&page=<?php echo $nextPage ?>'> &gt;</a>
        <?php
      }
      ?>
  </div>

  <script>
    <?php
      if($successMessage == true){
        ?> alert("You message has been added");
        <?php
      }
      
        ?>
  </script>
  <!-- JS SCRIPT INCLUSION -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/script.js"></script>
  <script src="js/topic.js"></script>    
</body>
</html>
