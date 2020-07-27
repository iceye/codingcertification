<?php
include("lib/functions.php");
session_start();

/*BUSINESS LOGIC CODE*/



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
 
  <?php 

//$_SESSION[authenticated] = false; The authentication works onyl if the password is not encrypted
//$_SESSION[username] = 'Stefano';

  if($_SESSION[authenticated] == true){
  ?>
       <div id="welcome">
          <h1>WELCOME <?php echo (strtoupper($_SESSION[username]));?> </h1>
      </div> 
  <?php

$title = $_POST['topicTitle'];
$pageNumber = $_POST['pageNumberBtn'];

$userId = '1';
$allertText = null;
$allertType = null;

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
  ?>

  <div class="header">
  <h1>Discussions</h1>
</div>

<form method="post" action="index.php" id="topic_creation" class="content">

    <?php /* include('errors.php'); */ ?>

    <div class="input-group">
    <formTitle>Create a discussion</formTitle>
    <label>Title</label>
      <input type="text" name="topicTitle" id="topicTitle" required>
      <br><button type="submit" class="btn" name="new_topic">Add Discussion</button>
      </div>
    </form>
  </div>


<!-- Table with paginated topics -->
<?php

    echo '<table>';

    /* Getting the amount of pages to display */

    if ($pageNumber == 0 or Null){
      $pageNumber = 1;
    }

    $arrayTopicsPaginated = getTopicsPaginated(10,$pageNumber);      
    $numberOfPages = $arrayTopicsPaginated['totalpages'];

    /* echo to check total number of pages is retrieved correctly */
    /* echo('<h2>num pages prima: '.$numberOfPages.'</h2>'); */
    
      foreach ($arrayTopicsPaginated['data'] as $item) {
        $idFromArray = $item['userId'];
        $arrayUserFromId = getUserById($idFromArray);

       echo '<tr>
       <td><a href=/topic.php?topicID='.$item['topicId'].'>'.$item['title'].'</a></br>Created by: '.$arrayUserFromId['username'].'Created at: '.$item['created_at'].'</td>
       </tr>';

       
  }
  echo '</table>';
?>

<!-- Create clickable links to pages -->
<form method="post" id="pager" class="numeriDiPagina">

<?php
    for ($i = 1; $i <= $numberOfPages; $i++) {

      if ($i == $pageNumber) {
        echo '<button class="pageBtn" disabled>'.$i.'</button>';
      }
      else{
        echo '<button type="submit" class="pageBtnNo" name="pageNumberBtn" value="'.$i.'">'.$i.'</button>';
      }
  }

?>
</form>

<?php
  }
  else{
  ?>
    <div id="signIn">
          <a href="signin.php"> SIGN-IN </a> 
    </div>
    <p align="center">
    <a href="register.php">register</a>
    </p>
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