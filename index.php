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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/allert.css">
</head>

<body>
  
  <!-- ADD HERE YOUR HTML CODE -->    
  <?php 

// Following lines are to force autentication for testing
// $_SESSION[authenticated] = true; 
// $_SESSION[username] = 'Stefano';

  if($_SESSION[authenticated] == true){
  ?>
       <div id="welcome">
          <h3 id="h3Welcome">Welcome <?php echo ($_SESSION[username]);?> </h3>
      </div> 
  <?php

$pageNumber = $_POST['pageNumberBtn'];

$allertText = null;
$allertType = null;

/*Creation of New Topics*/
  $title = $_POST['topicTitle'];
  $userId = $_SESSION[userId];

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
      <br><button type="submit" id="formNewTopicButton" class="formNewTopicBtnDisabled" name="new_topic">Add Discussion</button>
      </div>
    </form>
  </div>


<!-- Table with paginated topics -->
<table>
<?php

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
        $topicDate = $item['created_at'];
        $topicDateFormatted = date('d-m-Y', $topicDate);
       
       echo '<tr>
       <td><a href=./topic.php?topicID='.$item['topicId'].'>'.$item['title'].'</a></br>Created by: '.$arrayUserFromId['username'].'<span style="margin-right: 100px"></span>Created at: '.$topicDate.'</td>
       </tr>';    
  }
?>
</table>

<!-- Create clickable links to pages -->
<form method="post" id="pager" class="numeriDiPagina">
<?php
    if ($pageNumber == 1) {
      echo '<button class="pageNavBtnDisabled" disabled><</button>';
    }
    else{
      $prevPage = $pageNumber - 1;
      echo '<button class="pageNavBtnEnabled" name="pageNumberBtn" value="'.$prevPage.'"><</button>';
    }
    
    for ($i = 1; $i <= $numberOfPages; $i++) {
      
      if ($i == $pageNumber) {
        echo '<button class="pageBtn" disabled>'.$i.'</button>';
      }
      else{
        echo '<button type="submit" class="pageBtnNo" name="pageNumberBtn" value="'.$i.'">'.$i.'</button>';
      }  
    }

    if ($pageNumber == $numberOfPages) {
      echo '<button class="pageNavBtnDisabled" disabled>></button>';
    }
    else{
      $nextPage = $pageNumber + 1;
      echo '<button class="pageNavBtnEnabled" name="pageNumberBtn" value="'.$nextPage.'">></button>';
    }

?>
</form>

<?php
  }
  else{
  ?>
  <center>
    <div class="loginContainer"><p>Welcome to Coding Certification Academy</p>
      <a href="signin.php" class="btnLogin"> SIGN-IN </a> 
      <a href="register.php" class="btnRegister">register</a>
    </div>
    </center>
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

<script type="text/javascript">
// jquery to change button class in the form to create new topics  
  $(document).ready(function(){
    $('#formNewTopicButton').prop("disabled", "true");
    $('#formNewTopicButton').attr("class", "formNewTopicBtnDisabled"); 
    
    $('#topicTitle').keyup(function(){
        if($(this).val().length !=0){
          $('#formNewTopicButton').removeAttr("disabled");
          $('#formNewTopicButton').attr("class", "formNewTopicBtnEnabled"); 
        }
        else
        {
          $('#formNewTopicButton').prop("disabled", "true");
          $('#formNewTopicButton').attr("class", "formNewTopicBtnDisabled");
        }
    })
  });
</script>

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