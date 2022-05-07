<?php
session_start();


if($_SESSION["accessLevel"] == 2){   // Before continuing, check if the user attempting to delete is an administrator

$id = $_GET['idNews'];
include '../dbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

$sql = "DELETE FROM News WHERE idNews = ?"; // Query to delete rows that match with the corresponding id.
	$stmt= $conn->prepare($sql);
	$stmt->bind_param("s", $id);
        $stmt->execute();

if ($stmt->execute() === TRUE) {	// If the query is succesful return to index (news page)
    mysqli_close($conn);
    header('Location: index.php');
    exit;
} else {
    echo "Error deleting record";
}
  mysqli_close($conn);

}
else
{
echo "Insufficient privileges";
}
?>