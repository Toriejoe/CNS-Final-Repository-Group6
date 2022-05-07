<?php
include '../dbconnection.php';

session_start();
if($_SESSION["accessLevel"] == 2){

$id = $_POST["Userid"];

if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
 // $sql = "DELETE FROM Usernames WHERE id ='$id'";
 // $result = mysqli_query($conn, $sql);

$sql = "DELETE FROM Usernames WHERE id =? AND accessLevel !='2'";
$stmt= $conn->prepare($sql);
$stmt->bind_param("s", $id);
//$stmt->execute();

if (!$stmt->execute()) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    //$message .= 'Whole query: ' . $query;
    die($message);
}

else {
    header("Location: registrysearch.php");

}

}
else {
echo "insufficient privileges";
}
