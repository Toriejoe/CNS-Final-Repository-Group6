<?php
include '../dbconnection.php';
session_start();

if($_SESSION["loggedIn"] != true){ // Send user to main index of site if not logged in.
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../homepagestylesheet.css">
<link rel="stylesheet" href="newsadditionalstyles.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<p class="header"> News Page</p>
<?php
if($_SESSION["accessLevel"] == 2){
  echo"
   <button class=\"uploadbutton\" onclick=\"document.getElementById('id01').style.display='block'\">New Notification</button>
  ";
  }
  
?>;
        <div id='frame'>

<?php

if (!$conn) {     // Check for a valid connection
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT idNews, Post, PostDate FROM News ORDER BY idNews DESC";  // Query to select id, post content, and date of news entry in descending order.
  $result = mysqli_query($conn, $sql); // result of previous query.
  
  if (mysqli_num_rows($result) > 0) { // If the number of rows found in the result is greater than 0
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { // While loop to iterate over rows. 

$first  = "note sticky1";		// These strings are css classes for our sticky note effect. (first, second, third)
    $second = "note sticky2";
    $third  = "note sticky3";
    $array  = array($first, $second, $third); // Places the above strings in an array.
    $finalarray = $array[mt_rand(0, count($array) - 1)]; // Randomly chooses a string from above

$description = htmlspecialchars($row["Post"]);
$time = htmlspecialchars($row["PostDate"]);

 echo "<div class='$finalarray'>"; // Main sticky note div.
 echo "<div class='pin'></div>";
 echo "<div class='text'>$description</div>"; // Post content
echo "<div class='date'>$time</div>"; // Post date

if($_SESSION["accessLevel"] == 2){ // If the user is an admin, a delete button is made available on the sticky note.

echo "<div class='deletepic'>";

                echo "<a class='deletepic' href='delete.php?idNews=".$row['idNews']."'><img src='../Assets/trash-can-solid.svg' id='deletetrash' alt='Newsfeed Icon'></a>";
echo "</div>";
}

//echo   "<td><a href='delete.php?idNews=".$row['idNews']."'> delete </a></td>";
 echo "</div>";



    }
  } else {
    echo "0 results";
  }


?>
 <div class="dummynote">
</div>
            <div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content" method="post" action="SubmitNotification.php">
    <div class="container">
       <p> Create a New Notification</p>
          <label for="Description">Description:</label><br>
<textarea class="comment" name="notificationDesc" id="Description" cols="35" wrap="soft" required></textarea>

<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="yesSMS" name="yesSMS" value="yes" >
  <label class="form-check-label" for="flexSwitchCheckDefault">Send Text Notification?</label>
</div>           <br>
            <input type="submit" value="Submit">
    
    </div>
  </form>
</div>

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

    </body>

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
                <a href="../Gallery/"><img src="../Assets/images-solid.svg" id="Gallery" alt="Gallery Icon" class="hovercolor"></a>
            </p>
        </div>
        <br>
        <div>
            <div class="column">
                <p>
                    <a href="index.php"><img src="../Assets/bell-solid.svg" id="News" alt="Newsfeed Icon" class="Insta svgcolor"></a>
                </p>
            </div>
        </div>
        <div class="column">
            <p>
                <a href="../Help/"><img src="../Assets/question-solid.svg" id="Help" alt="Help Icon" class="hovercolor"></a>
            </p>
        </div>
    </div>
