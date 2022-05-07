<?php

session_start();
if($_SESSION["accessLevel"] == 2){ // Make sure the user is an administrator before anything else.

$id = $_GET['idGallery'];
include '../dbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


$sqlfile = "SELECT Filepath FROM Gallery WHERE idGallery =?";
$stmt= $conn->prepare($sqlfile);
$stmt->bind_param("s", $id);
$stmt->execute();
$resultFile = $stmt->get_result();

$row = $resultFile->fetch_assoc();
$FP = trim($row["Filepath"]);
$FPchecked = "tmp/";
$FPchecked .= basename($FP);

$sqldelete = "DELETE FROM Gallery WHERE idGallery =?";
 
$stmt2= $conn->prepare($sqldelete);
$stmt2->bind_param("s", $id);


if ($stmt2->execute()) {
    mysqli_close($conn);
unlink($FPchecked);
    header('Location: index.php'); 
    exit;
} else {
    echo "Error deleting record";
}
  mysqli_close($conn);
}

else {
echo "insufficient privileges.";
}
?>