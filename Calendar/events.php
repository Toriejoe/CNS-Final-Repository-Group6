<?php


// This page is used to retrieve calendar events.

error_reporting(E_ALL);

include '../dbconnection.php';


 $sql= "SELECT * FROM events ORDER BY id";


 $result =  mysqli_query($conn,$sql); // Select all calendar events

 $rows = array();
 while($r = mysqli_fetch_array($result)) {  // While there is a result, create an array of event rows.
    $rows[] = $r;
  }
  
echo json_encode($rows); // Encode events in a format that fullcalendar can use.






?>