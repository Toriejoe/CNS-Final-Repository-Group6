<?php
include '../dbconnection.php';

$id = $_POST['Userid'];

//echo $id;

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql = "SELECT firstname, lastname, email, phone FROM Usernames WHERE id =?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("s", $id);
$result = mysqli_query($conn, $sql);
$stmt->execute();
$result = $stmt->get_result();

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "name" . $row["firstname"]. "POSTS" . $row["phone"]. " />";
$phone = $row["phone"];
$email = $row["email"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];

    }
  } else {
    echo "0 results";
  }
  
  mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Login </title>
<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../homepagestylesheet.css">
<link rel="stylesheet" href="helpadditionalstyles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>

<body>

    <div class="d-flex row gy-5 center testsize testborder">

        <div class="testborder botto">
            <p id="backbutton" class="signup" > <a href="registrysearch.php">
                < Back </a> </p>

                    <label class="contactinfo" for="phoneSpan">Phone</label>
                    <div class="contactborder" id="emailSpan">
                        <p class="contacttext"> <?php echo $phone; ?> </p>
                    </div>

                    <label class="contactinfo" for="emailSpan">Email</label>
                    <div class="contactborder" id="emailSpan">
                        <p class="contacttext"> <?php echo $email; ?></p>
                    </div>

                    <label class="contactinfo" for="addresSpan">Name</label>
                    <div class="contactborder" id="addresSpan">
                        <p class="contacttext2"> <?php echo $firstname .' '. $lastname; ?></p>                    </div>
                    
                    </div>
<div>
</div>
<div>


    </div>
<?php
session_start();

if($_SESSION["accessLevel"] == 2){

echo
"
<form action=\"deleteacc.php\" method=\"post\" style=\"position: absolute;bottom: 0;\">
<input type=\"hidden\" name=\"Userid\" value=".htmlspecialchars($id).">
                                <button type=\"submit\" id=\"ParentSearch\" class=\"rounded-pill btn-primary btn-block p-1 login\">Delete Account</button>
                            </div>
</form>
";
}

?>
</body>

</html>

