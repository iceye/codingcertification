<?php
include("lib/functions.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*BUSINESS LOGIC CODE*/

$query = "SELECT * FROM topic";
echo "<b> <center>Database Output</center> </b> <br> <br>";

echo '<center><table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">TopicId</font> </td> 
          <td> <font face="Arial">title</font> </td> 
          <td> <font face="Arial">created_at</font> </td> 
          <td> <font face="Arial">UserId</font> </td> 
      </tr>';

if ($result = mysqli_query($dblink, $query)) {

    while ($row = $result->fetch_assoc()) {
        $field1name = $row["topicId"];
        $field2name = $row["title"];
        $field3name = $row["created_at"];
        $field4name = $row["userId"];
 
        echo '<tr>
                <td>'.$field1name.'</td>
                <td>'.$field2name.'</td>
                <td>'.$field3name.'</td>
                <td>'.$field4name.'</td>
             </tr>';
    }
/*freeresultset*/
$result->free();
}
echo "</table></center>";

/*BUSINESS LOGIC CODE END*/
?><!doctype html>
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
  <h1>TOPIC - HELLO WORLD</h1>
  
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