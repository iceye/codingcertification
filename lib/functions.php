<?php
define("MYSQL_HOST","127.0.0.1");
define("MYSQL_USER","docebo");
define("MYSQL_PASS","docebo");
define("MYSQL_DBNAME","dboard");

global $dblink;

$dblink = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DBNAME);

if (!$dblink) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

/***************************** USER FUNCTIONS **********************************************/

/**
  * Save a new user in the DB
  *
  * Store a new user if the username is not used by someone else
  *
  * @param string $username The username of the new user (DB max length 255 char)
  * @param string $password The password of the new user (DB max length 255 char)
  *
  * @return number The userId of the new user created on success. This function returns 0 when username is in use or -1 for DB error
  */
function saveNewUser($username, $password){
    global $dblink;
    $searchForUserQuery = "SELECT userId FROM user WHERE username = '".addslashes($username)."';";
    $result = mysqli_query($dblink, $searchForUserQuery);
    if (mysqli_num_rows($result) > 0) {

      // Free unused result set
      mysqli_free_result($result);

      // A user with the given username was found, return 0 and stop the user creation procedure
      return 0;
    }

    $createUserQuery = "INSERT INTO user VALUES(NULL,'".addslashes($username)."','".addslashes($password)."');";
    if (mysqli_query($dblink, $createUserQuery)) {
      return mysqli_insert_id($dblink);
    } else {
      echo "Error User: " . $sql . "<br>" . mysqli_error($dblink);
        die();
      return -1;
    }

}

/**
  * Get an existing user by username and password 
  *
  * Retrieve a user by username and password (both must match the same user), useful function for signin procedure
  *
  * @param string $username The username to load
  * @param string $password The password to load
  *
  * @return array A single User with array fields (fields: userId:number, username:string) on success, NULL if user is not found
  */
function getUserByUsernameAndPassword($username, $password){
    global $dblink;
    $password = md5($password);
    $searchForUserQuery = "SELECT * FROM user WHERE username = '".addslashes($username)."' AND password = '".addslashes($password)."';";
    $result = mysqli_query($dblink, $searchForUserQuery);
    if ($result!==FALSE && mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      $user['password'] = null;

      // Free unused result set
      mysqli_free_result($result);

      return $user;
    }
    else{
        return null;
    }
}

/**
  * Get an existing user by userId
  *
  * Retrieve a user by userId, useful function to retrieve the logged in user 
  *
  * @param number $userId The ID of the user to search for
  *
  * @return array A single User with array fields (fields: userId:number, username:string) on success, NULL if user is not found
  */
function getUserById($userId){
    global $dblink;
    $searchForUserQuery = "SELECT * FROM user WHERE userId = ".addslashes($userId).";";
    $result = mysqli_query($dblink, $searchForUserQuery);
    if ($result!==FALSE && mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      $user['password'] = null;

      // Free unused result set
      mysqli_free_result($result);

      return $user;
    }
    else{
        return null;
    }
}


/***************************** TOPICS FUNCTIONS **********************************************/

/**
  * Get ALL topics in the DB
  *
  * Get the topic list in the databases, max returned items is 1000
  *
  * @return array The list of topics as array of topics,
  *               each topic is an array with its own topic fields 
  *               (topicId: number, title:string, created_at:timestamp, userId:number) on success,
  *               NULL if data are not available (DB empty or unavailable page requested)
  */
function getTopics(){
    // Call the paginated function with fixed values
    $topicsList = getTopicsPaginated(1000,1);
    return $topicsList;
}

/**
  * Get topics in the DB
  *
  * Get the topic list, optional pagination paramenters can be used
  *
  * @param number $pageSize The items returned in the current page
  * @param number $pageNumber The page to be loaded based on total items into the DB and $pageSize param
  *
  * @return array The list of topics with pagination data (fields: data:topics numeric array,currentpage:number,totalpages:number),
  *               each topic in the data field is an array with its own topic fields 
  *               (topicId: number, title:string, created_at:timestamp, userId:number) on success,
  *               NULL if data are not available (DB empty or unavailable page requested)
  */
function getTopicsPaginated($pageSize,$pageNumber){
    global $dblink;
    $startItemCount = ($pageNumber-1)*$pageSize;
    
    $countTopicsQuery = "SELECT count(*) as totalTopics FROM topic ORDER BY created_at DESC;";
    $totalTopics = 0;
    if($result = mysqli_query($dblink, $countTopicsQuery)){
        $totalTopicsArray = mysqli_fetch_assoc($result);
        $totalTopics =  $totalTopicsArray['totalTopics'];  
        mysqli_free_result($result);
        
        // If DB is empty return NULL
        if($totalTopics<=0){
            return NULL;
        }
    }
    else{
        // This can happen only if there's an error in the query or DB connection has gone 
        return NULL;
    }

    $paginatedTopicQuery = "SELECT * FROM topic LIMIT ".$startItemCount.",".$pageSize.";";
    $result = mysqli_query($dblink, $paginatedTopicQuery);
    if ($result!==FALSE && mysqli_num_rows($result) > 0) {
      $returnedTopicsData = [];
      $returnedTopicsData['data'] =  mysqli_fetch_all($result,MYSQLI_ASSOC);
      $returnedTopicsData['currentpage'] = $pageNumber;
      $returnedTopicsData['totalpages'] = $totalTopics<$pageSize?1:ceil($totalTopics/$pageSize);
// Original line: $returnedTopicsData['totalpages'] = $totalTopics<$pageSize?1:floor($totalTopics/$pageSize)+1;     
 
// Free unused result set
      mysqli_free_result($result);
            
      return $returnedTopicsData;
    }
    else{
        return null;
    }
}
            
/**
  * Save a new topic in the DB
  *
  * Store a new topic 
  *
  * @param string $title The title of the new topic (DB max length 255 char)
  * @param string $userId The userId of the user owner of the new topic
  *
  * @return number The topicId of the new topic created on success. This function returns -1 for DB error (suggestion: check for title max length)
  */
function saveNewTopic($title, $userId){
    global $dblink;
    $createTopicQuery = "INSERT INTO topic VALUES(NULL,'".addslashes($title)."',FROM_UNIXTIME ('".time()."'),'".addslashes($userId)."');";
    if (mysqli_query($dblink, $createTopicQuery)) {
      return mysqli_insert_id($dblink);
    } else {
      echo "Error Topic: " . $sql . "<br>" . mysqli_error($dblink);
        die();
      return -1;
    }

}
            
/**
  * Get an existing topic by topicId
  *
  * Retrieve a topic by topicId, useful function for single topic page
  *
  * @param number $topicId The ID of the topic to load
  *
  * @return array A single Topic with array fields (topicId: number, title:string, created_at:timestamp, userId:number) on success, NULL if topic is not found
  */
function getTopicById($topicId){
    global $dblink;
    $searchForTopicQuery = "SELECT * FROM topic WHERE topicId = ".addslashes($topicId).";";
    $result = mysqli_query($dblink, $searchForTopicQuery);
    if ($result!==FALSE && mysqli_num_rows($result) > 0) {
      $topic = mysqli_fetch_assoc($result);
      
      // Free unused result set
      mysqli_free_result($result);
            
      return $topic;
    }
    else{
        return null;
    }
}
            
            
/***************************** MESSAGES FUNCTIONS **********************************************/
            
/**
  * Get ALL messages in the DB for a topic
  *
  * Get the messages list in the databases for a given topicId, max returned items is 1000
  *
  * @param number $topicId Load messages linked in this topicId
  *            
  * @return array The list of message as array of messages,
  *               each messages is an array with its own message fields 
  *               (messageId: number, body:string, created_at:timestamp, topicId:number, userId:number) on success,
  *               NULL if data are not available (DB empty or unavailable page requested)
  */
function getMessagesByTopicId($topicId){
    // Call the paginated function with fixed values
    $messagesList = getMessagesByTopicIdPaginated($topicId,1000,1);
    return $messagesList;
}

/**
  * Get topics in the DB
  *
  * Get the topic list, optional pagination paramenters can be used
  *
  * @param number $topicId Load messages linked in this topicId
  * @param number $pageSize The items returned in the current page
  * @param number $pageNumber The page to be loaded based on total items into the DB and $pageSize param
  *
  * @return array The list of messages with pagination data (fields: data:messages numeric array,currentpage:number,totalpages:number),
  *               each message in the data field is an array with its own message fields 
  *               (messageId: number, body:string, created_at:timestamp, topicId:number, userId:number) on success,
  *               NULL if data are not available (DB empty or unavailable page requested)
  */
function getMessagesByTopicIdPaginated($topicId,$pageSize,$pageNumber){
    global $dblink;
    $startItemCount = ($pageNumber-1)*$pageSize;
    
    $countMessagesQuery = "SELECT count(*) as totalMessages FROM message WHERE topicId = '".addslashes($topicId)."';";
    $totalMessages = 0;
    if($result = mysqli_query($dblink, $countMessagesQuery)){
        $totalMessagesArray = mysqli_fetch_assoc($result);
        $totalMessages =  $totalMessagesArray['totalMessages'];  
        mysqli_free_result($result);
        
        // If DB is empty return NULL
        if($totalMessages<=0){
            return NULL;
        }
    }
    else{
        // This can happen only if there's an error in the query or DB connection has gone 
        return NULL;
    }

    $paginatedMessagesQuery = "SELECT * FROM message WHERE topicId = '".addslashes($topicId)."' ORDER BY created_at DESC LIMIT ".$startItemCount.",".$pageSize.";";
    $result = mysqli_query($dblink, $paginatedMessagesQuery);
    if ($result!==FALSE && mysqli_num_rows($result) > 0) {
      $returnedMessagesData = [];
      $returnedMessagesData['data'] =  mysqli_fetch_all($result,MYSQLI_ASSOC);  
      $returnedMessagesData['currentpage'] = $pageNumber;
      $returnedMessagesData['totalpages'] = $totalMessages<$pageSize?1:floor($totalMessages/$pageSize)+1;
      
      // Free unused result set
      mysqli_free_result($result);
            
      return $returnedMessagesData;
    }
    else{
        return null;
    }
}
            
/**
  * Save a new message in the DB
  *
  * Store a new message for a given topic 
  *
  * @param string $body The title of the new topic (DB max length 255 char)
  * @param string $topicId The topicId linked with this message            
  * @param string $userId The userId of the user owner of the new message
  *
  * @return number The messageId of the new message created on success. This function returns -1 for DB error (suggestion: check for title max length)
  */
function saveNewMessage($body, $topicId, $userId){
    global $dblink;
    $createMessageQuery = "INSERT INTO message VALUES(NULL,'".addslashes($body)."',FROM_UNIXTIME ('".time()."'),'".addslashes($topicId)."','".addslashes($userId)."');";
    if (mysqli_query($dblink, $createMessageQuery)) {
      return mysqli_insert_id($dblink);
    } else {
      echo "Error Message: " . $sql . "<br>" . mysqli_error($dblink);
        die();
      return -1;
    }

}

/* ADD HERE YOUR OWN FUNCTIONS */

/**
  * Check the typed Password in the Sign in page with the Password stored in the user DB
  *
  * @param string $password password typed in the sign in form
  * @param string $username username typed in the sign in form
  *            
  * @return boolean True if the typed password is the same of the password stored in the DB, False if it's not the same
  */
  function EncryptPassword($password){
 
    $password = md5($password);
    return $password;
}
?>