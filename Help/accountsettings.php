<?php
include '../dbconnection.php';

session_start();
$id = $_SESSION['user_id'];

if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql = "SELECT firstname, lastname, email, phone, smsAllowed FROM Usernames WHERE id ='$id'"; // Queries the user table for the currently logged in user.
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {	// If statement to check if the user exists
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { // While a row is found retrieve their column information

$phone = $row["phone"];
$email = $row["email"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];
$smsenabled = $row["smsAllowed"];

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
    <title> Help </title>
    <link rel="stylesheet" href="../homepagestylesheet.css">
<link rel="stylesheet" href="helpadditionalstyles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


</head>

<body>
<p id="backbutton" class="signup" > <a href="index.php">
                < Back </a> </p>

    <div id="formpage" class="d-flex row gy-5 center testsize testborder">
<! –– The form the user sees, their information is retrieved from the database and echoed into input boxes, which can be changed.  ––>
        <div class="testborder botto">
           <form action = "updateaccount.php" method="post"> 

                    <label class="contactinfo" for="phoneSpan">Phone</label>
                    <div class="contactborder" id="emailSpan">
                        <p class="contacttext2"><input type="text" placeholder="<?php echo htmlspecialchars($phone); ?>" name="phone"></p>
                    </div>

                    <label class="contactinfo" for="emailSpan">Email</label>
                    <div class="contactborder" id="emailSpan">
                       <p class="contacttext2"><input type="text" placeholder="<?php echo htmlspecialchars($email); ?>" name="email" readonly></p>

                    </div>

                    <label class="contactinfo" for="addresSpan">First Name</label>
                    <div class="contactborder" id="addresSpan">
                        <p class="contacttext2"><input type="text" placeholder="<?php echo htmlspecialchars($firstname); ?>" name="firstname"></p>
                    </div>

<label class="contactinfo" for="addresSpan">Last Name</label>
                    <div class="contactborder" id="addresSpan">
                        <p class="contacttext2"><input type="text" placeholder="<?php echo htmlspecialchars($lastname); ?>" name="lastname"></p>
                    </div>

      <input type="hidden" value="<?php echo $id; ?>" name="id">


<?php

// Used to check the user's SMS settings, if on it will be checked by default, and blank if not.

if ($smsenabled == 1) {

echo '<div class="form-check form-switch">';
                    echo '<input type="hidden" value="enableSMSno" name="enableSMS">';
                    echo  '<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="enableSMS" value="enableSMSyes" checked/>';
                    echo  '<label class="form-check-label" for="flexSwitchCheckDefault">Receive SMS notifications?</label>';
                    echo '</div>';
}

if ($smsenabled == 0) {

echo '<div class="form-check form-switch">';
                    echo '<input type="hidden" value="enableSMSno" name="enableSMS">';
                    echo  '<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="enableSMS" value="enableSMSyes"/>';
                    echo  '<label class="form-check-label" for="flexSwitchCheckDefault">Receive SMS notifications?</label>';
                    echo '</div>';
}

  ?>



                    <div class="buttonbox improved">
                        
                            <div class="row top-buffer justify-content-center improved">
                                <button type="submit" id="ParentSearch" class="rounded-pill btn-primary btn-block p-1 login improved">Update Information</button>
                            </div>


                        </form>




<form action="changepassform.php" method="post">
                                    </div>

<div class="row top-buffer justify-content-center improved">
                                <button type="submit" id="ParentSearch" class="rounded-pill btn-primary btn-block p-1 login improved">Change Password</button>
                            </div>

</form>

<?php

// If the user's access level is an admin, they have access to send registration links

if($_SESSION["accessLevel"] == 2){

echo

"

<form action=\"enrollment.php\" method=\"post\">
                                    

<div class=\"row top-buffer justify-content-center improved\">
                                <button type=\"submit\" id=\"ParentSearch\" class=\"rounded-pill btn-primary btn-block p-1 login improved\">Send Registration Link</button>
                            </div>


</form>";
}
?>




<?php


if($_SESSION["accessLevel"] == 2){

// If the user's access level is an admin, they can manually create accounts.

echo

" <form action='createAccountForm.php' method='post'>
                                    

<div class=\"row top-buffer justify-content-center improved\">
                                <button type=\"submit\" id=\"ParentSearch\" class=\"rounded-pill btn-primary btn-block p-1 login improved\">Manually Create Account</button>
                            </div>

</form> ";


}

?>




        </div>
    </div>
    <br>
    <br>
    <br> 


  


</body>

</html>