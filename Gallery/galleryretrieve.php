<?php
include '../dbconnection.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql = "SELECT idGallery, Subject, Post, Filepath FROM Gallery";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo "SUBJECT" . $row["Subject"]. "POSTS" . $row["Post"]. " <img src=".$row["Filepath"]." />";
      echo   "<td><a href='delete.php?idGallery=".$row['idGallery']."'> delete </a></td>";
    }
  } else {
    echo "0 results";
  }
  
  mysqli_close($conn);
?>

