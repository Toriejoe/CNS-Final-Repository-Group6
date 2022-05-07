<?php
error_reporting(E_ALL);

session_start();
if($_SESSION["accessLevel"] == 2){ // Before anything else, check if the logged in user is an administrator

include '../dbconnection.php';
$eventTitle = $_POST['eventTitle'];
$eventDescription = $_POST['eventDescription'];

$startDate = $_POST['startDate'];
$startTime = $_POST['startTime'];

$endDate = $_POST['endDate'];
$endTime = $_POST['endTime'];

if (!empty($_POST["startTime"])) {
    $start = $_POST['startDate'] ."T". $_POST['startTime']; 
//echo $start;
} else {  
    $start = $_POST['startDate'];
//echo $start; 

}

if (!empty($_POST['endDate'])) {         // If the end date is not empty

    if (!empty($_POST['endTime'])) {     // If the end time is not empty

    $end = $_POST['endDate'] ."T". $_POST['endTime'];   // Combine enddate with endtime and set end variable.
//echo $end; 

} else {                                 // If the end date is not empty, but end time is empty
    $end = $_POST['endDate'];            // set end variable to endDate alone.
//echo $end; 

}

} else {  
    $end = NULL;            // If the end date is empty, set end variable to null.
//echo $end; 
}


if ($end == NULL) {

$stringnull = NULL;

$sql = "INSERT INTO events (title, Description, start, end) VALUES (?, ?, ?, ?)";
	    $stmt= $conn->prepare($sql);
	    $stmt->bind_param("ssss", $eventTitle, $eventDescription, $start, $stringnull);


}
else {  

$sql = "INSERT INTO events (title, Description, start, end) VALUES (?, ?, ?, ?)";
	    $stmt= $conn->prepare($sql);
	    $stmt->bind_param("ssss", $eventTitle, $eventDescription, $start, $end);

}


 

if ($stmt->execute()) {
    session_start();
        $_SESSION["msg"]='<p style="color:green;"> Event Created!</p>';
        header('Location:index.php');
        exit;

}
else {
    session_start();
        $_SESSION["msg"]='<p style="color:red;"> Failed to upload new event. </p>';
       header('Location:index.php');
        exit;
}
}
else {
echo "insufficient privileges";
}

?>