<?php
include("lib/functions.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*BUSINESS LOGIC CODE*/

$query = "SELECT * FROM topic";

echo '<center><table id="table_topics">';

if ($result = mysqli_query($dblink, $query)) {

    while ($row = $result->fetch_assoc()) {
        $field1name = $row["title"];
        $field2name = $row["userId"];
        $field3name = $row["created_at"];


        echo '<tr>
                <td>Title: '.$field1name.'</br>Created by: '.$field2name.' Created at: '.$field3name.'</td>
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