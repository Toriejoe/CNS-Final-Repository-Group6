<?php

session_start();
if($_SESSION["accessLevel"] == 2){		// Before doing anything else, check if the user is an admin.


include '../dbconnection.php';

$id = $_POST['id'];


$sql = "DELETE from events WHERE id='$id' ";	// Delete from the events table where the id is a match.

if ($conn->query($sql) === TRUE) {
header('Location:index.php');
}


}
else {
echo "insufficient privileges";
}


?>