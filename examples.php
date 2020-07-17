<?php
include dirname(__FILE__)."/lib/functions.php";

/*LIVE EXAMPLES - ONLY HAPPY PATH ;) */

// Prepare a random number useful for this example
$randomCode = time()."-".rand(0, 100000);

// saveNewUser

$randomUsername = "testUsername".$randomCode;
$randomPassword = "testPassword".$randomCode;
$createdUserId = saveNewUser($randomUsername, $randomPassword);


// getUserByUsernameAndPassword, using prevously created data
$loadedUserByUsernameAndPassword = getUserByUsernameAndPassword($randomUsername, $randomPassword);


// getUserByUsernameAndPassword, using prevously saved user
$loadedUserByUserId = getUserById($createdUserId);



//getTopics
$allTopics = getTopics(); // Remember, this is limited to max 1000 items

//getTopicsPaginated
$topicsPageSize = 10;
$topicsPage = 2;
$paginatedTopics = getTopicsPaginated($topicsPageSize,$topicsPage);

//saveNewTopic
$topicTitle = "My new example topic ".$randomCode;
$topicUserId = $createdUserId;
$createdTopicId = saveNewTopic($topicTitle, $topicUserId);

//getTopicById, using prevously saved topic
$loadedTopicById = getTopicById($createdTopicId);


//getMessagesByTopicId
$topicId10 = 10;
$allMessagesForTopic = getMessagesByTopicId($topicId10);

//getMessagesByTopicIdPaginated
$messagePageSize = 10;
$messagePage = 2;
$paginatedMessages = getMessagesByTopicIdPaginated($topicId10,$messagePageSize,$messagePage);
    
//saveNewMessage, using prevously created user and topic
$newMessageBody = "New message for Random Topic ".$randomCode;
$newMessageTopicId = $createdTopicId;
$newMessageUserId = $createdUserId;
$createdMessageId = saveNewMessage($newMessageBody, $newMessageTopicId, $newMessageUserId);
    

?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>D-Board</title>
  <meta name="description" content="The D-Board project">
  <!-- CSS INCLUSION -->    
  <link rel="stylesheet" href="css/styles.css?v=1.0">
</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->    
  <h1>HAPPY PATH EXAMPLE</h1>
  
  <h2>USER</h2>    
  <h3>REGISTER USER EXAMPLE</h3>
  <p>Created a new user 
      username: <i><?php echo $randomUsername; ?></i> 
      password: <i><?php echo $randomPassword; ?></i> 
      Created userId: <b><?php echo $createdUserId; ?></b>
  </p>
    
  <h3>GET USER BY USERNAME AND PASSWORD EXAMPLE</h3>
  <p>Load user from 
      username: <i><?php echo $randomUsername; ?></i> 
      password: <i><?php echo $randomPassword; ?></i> 
      <br />
      FOUND USER: <?php print_r($loadedUserByUsernameAndPassword); ?>
  </p> 
    
  <h3>GET USER BY userId</h3>
  <p>Load user from 
      userId: <i><?php echo $createdUserId; ?></i> 
      <br />
      FOUND USER: <?php print_r($loadedUserByUserId); ?>
  </p>  
  <h2>TOPIC</h2>        
  <h3>GET ALL TOPICS</h3>
  <p>Load all topics
      TOPICS: <?php print_r($allTopics); ?>
  </p>  
    
  <h3>GET PAGINATED TOPICS</h3>
  <p>Load topics:
      Page Size: <i><?php echo $topicsPageSize; ?></i> 
      Page: <i><?php echo $topicsPage; ?></i> 
      <br />
      TOPICS: <?php print_r($paginatedTopics); ?>
  </p>
    
  <h3>CREATING A NEW TOPIC</h3>
  <p>Topic data:
      title: <i><?php echo $topicTitle; ?></i> 
      userId: <i><?php echo $topicUserId; ?></i> 
      <br />
      Created topicId: <b><?php echo $createdTopicId; ?></b>
  </p>
    
  <h3>LOADING TOPIC BY ID</h3>
  <p>Load topic from 
      topicId: <i><?php echo $createdTopicId; ?></i> 
      <br />
      FOUND TOPIC: <?php print_r($loadedTopicById); ?>
  </p> 
    
    
  <h2>MESSAGE</h2>    
  <h3>GET ALL MESSAGES FOR A TOPIC</h3>
  <p>Load all messages for
      topicId: <i><?php echo $topicId10; ?></i> 
      MESSAGES: <?php print_r($allMessagesForTopic); ?>
  </p>  
    
  <h3>GET PAGINATED MESSAGES</h3>
  <p>Load messages:
      Page Size: <i><?php echo $messagePageSize; ?></i> 
      Page: <i><?php echo $messagePage; ?></i> 
      <br />
      MESSAGES: <?php print_r($paginatedMessages); ?>
  </p>
    
  <h3>CREATING A NEW MESSAGE</h3>
  <p>Message data:
      body: <i><?php echo $newMessageBody; ?></i> 
      topocId: <i><?php echo $newMessageTopicId; ?></i> 
      userId: <i><?php echo $newMessageUserId; ?></i> 
      <br />
      Created messageId: <b><?php echo $createdMessageId; ?></b>
  </p>
    
  <h2>TEST HAS FINISHED.</h2>
    
  <!-- JS SCRIPT INCLUSION -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/scripts.js"></script>
</body>
</html>