<?php
include("lib/functions.php");

/*BUSINESS LOGIC CODE*/

  $title = $_POST['topicTitle'];
  $userId = '1';
  $allertText = null;
  $allertType = null;

  /* Query to get all topics from getTopics() function */
  $arrayTopics = getTopics();
  $arrayTopicsPaginated = getTopicsPaginated(10,1);

  /* Getting the amount of pages to display */
  $numberOfPages = $arrayTopicsPaginated['totalpages'];
  ?><center>Number of Pages: <?print_r($numberOfPages);?></center></br><?

  /*Creation of New Topics*/
    $title = $_POST['topicTitle'];
    $userId = '1';
    /* $userID to be changed with the ID of the current logged user */
    
  if ($title != "") {
      $checktopic = saveNewTopic($title, $userId);
        if ($checktopic == "-1") {
          $allertText="ERROR";
          $allertType="error";
                              }
        else {$allertText="Topic created";
              $allertType="success";
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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/allert.css">
</head>

<body>
  <!-- ADD HERE YOUR HTML CODE -->    
  <p align="center">
    <a href="register.php">register</a>
  </p>
  <div class="header">
    <h1>Discussions</h1>
  </div>
  
  <form method="post" action="index.php" id="topic_creation">

    <?php include('errors.php'); ?>
    
      <div class="input-group">
      <formTitle>Create a discussion</formTitle>
      <label>Title</label>
        <input type="text" name="topicTitle" id="topicTitle" required>
      </div>
        <button type="submit" class="btn" name="new_topic">Add Discussion</button>
    </form>
    </div>

<?php
  /* Table with paginated topics */
      echo '<table>';
      $arrayTopicsPaginated = getTopicsPaginated(10,1);

      /* Getting the amount of pages to display */
      $numberOfPages = $arrayTopicsPaginated['totalpages'];
      ?><center>Number of Pages: <?print_r($numberOfPages);?></center></br><?

        foreach ($arrayTopicsPaginated['data'] as $item) {
          $idFromArray = $item['userId'];
          $arrayUserFromId = getUserById($idFromArray);

         echo '<tr>
         <td>Title: '.$item['title'].'</br>Created by: '.$arrayUserFromId['username'].'Created at: '.$item['created_at'].'</td>
         </tr>';
    }
    echo '</table>';
?>

<?php
/* Create links to pages - draft*/
?>
<div class="page-links">Page:
  <?
  for ($i = 1; $i <= $numberOfPages; $i++) {
      echo $i.', ';
    }
?>
</div>

<?php
/* Table with ALL topics */
  echo '<table>';

    foreach ($arrayTopics['data'] as $item) {
      $idFromArray = $item['userId'];
      $arrayUserFromId = getUserById($idFromArray);

      echo '<tr>
      <td>Title: '.$item['title'].'</br>Created by: '.$arrayUserFromId['username'].'Created at: '.$item['created_at'].'</td>
      </tr>';
    }
  
    echo '</table>';
?>

<!-- JS SCRIPT INCLUSION -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"
  crossorigin="anonymous"></script>     
  <script src="js/script.js"></script>
  <script src="js/index.js"></script>

  <?php
    if ($allertText!==null && $allertType !==null){
      ?>
  <script>
    allert("<?= $allertText ?>", {
              type: "<?= $allertType ?>",
            });
  </script>
  <?php
    }
  ?>

</body>
</html>
