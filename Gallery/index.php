<?php
include '../dbconnection.php';
session_start();
if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}


if(isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]);
} else {
    $msg = "";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Countryside Nursery Gallery</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="gallerystylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

<body id="body">
     <p class="header"> Photo Gallery</p>
<?php

if($_SESSION["accessLevel"] == 2){
  echo"
   <button class=\"uploadbutton\" onclick=\"document.getElementById('id01').style.display='block'\">Upload Photo</button>
  ";
  }
?>

<?php echo $msg ?>
     <div>
<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql = "SELECT idGallery, Subject, Post, Filepath FROM Gallery ORDER BY idGallery DESC"; // Query to retrieve needed columns to display saved photos.
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

echo "<div class='responsive'>";
echo "<div class='gallery'>";
echo "<a target='_blank'>";
echo "<img src=".htmlspecialchars($row["Filepath"])." alt='CountrySide Nusery' width='600' height='400'   />";
echo "</a>";

if($_SESSION["accessLevel"] == 2){		// Check session variable if user is admin, then assigns a delete button.
echo "<div class='deletepic'>";
echo "<a class='deletepic' href='delete.php?idGallery=".htmlspecialchars($row['idGallery'])."'><img src='../Assets/trash-can-solid.svg' id='deletetrash' alt='Newsfeed Icon'></a>";
echo "</div>";
}
						// Echo out remaining html attributes and display title information and description.
echo "<div class='desc'>";
echo htmlspecialchars($row["Subject"]);
echo "</div>";
echo "<div class='desc'>";
echo htmlspecialchars($row["Post"]);
echo "</div>";
echo "</div>";
echo "</div>";




    }
  } else {
    echo "No photos found!";
  }


?>

<div class="row navbar">
        <div class="column">
            <div>
                <p>
                    <a href="../welcome.php"><img src="../Assets/house-chimney-solid.svg" alt="Home Icon" id="Home" class="hovercolor"> </a>
                </p>
            </div>
        </div>
        <br>

        <div class="column">
            <p>
                <a href="../Calendar/"><img src="../Assets/calendar-days-solid.svg" id="Calendar" alt="Calendar Icon" class="hovercolor"></a>
            </p>
        </div>
        <div class="column">
            <p>
                <a href="index.php"><img src="../Assets/images-solid.svg" id="Gallery" alt="Gallery Icon" class="svgcolor"></a>
            </p>
        </div>
        <br>
        <div>
            <div class="column">
                <p>
                    <a href="../News/"><img src="../Assets/bell-solid.svg" id="News" alt="Newsfeed Icon" class="hovercolor"></a>
                </p>
            </div>
        </div>
        <div class="column">
            <p>
                <a href="../Help/"><img src="../Assets/question-solid.svg" id="Help" alt="Help Icon" class="hovercolor"></a>
            </p>
        </div>
    </div>
    </div>
    

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content" enctype="multipart/form-data"  action="upload.php" method="post">
    <div class="container">
       <p> Add New Photo</p>
          <label for="Title">Title:</label><br>
          <input type="text" id="Subject" name="Subject" placeholder="Title" required><br>
          <label for="Description">Description:</label><br>
          <input type="text" id="Posts" name="Posts" placeholder="Post" required>
            <br>  
          <label for="myfile">Select a file:</label><br>
          <input type="file" id="myfile"size="32" name="my_field" value="" required><br><br>
<input type="hidden" name="action" value="image">    
          <input  type="submit" name="Submit" value="upload">
    
       </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<!--
    <div class="imgadder" >
       <form action="/action_page.php">
           <p> Add New Photo</p>
          <label for="Title">Title:</label><br>
          <input type="text" id="Title" name="Title" required><br>
          <label for="Description">Description:</label><br>
          <input type="text" id="Description" name="Description" required>
            <br>
          <label for="myfile">Select a file:</label><br>
          <input type="file" id="myfile" name="myfile"><br><br>
          <input type="submit" value="Submit">
           <button type="button" class="deletebtn">Delete</button>
          </form>
      </div>
-->
</body>

</html>