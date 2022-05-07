<?php

session_start();
$id = $_SESSION['user_id'];

if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}



if (isset($_POST["reset-password-submit"])) { // Checks to see if a post request was sent for the user to change their password.

$pass = $_POST["pwd"];
$cpass = $_POST["cpwd"];
$number = preg_match('@[0-9]@', $pass);

if (empty($pass) || empty($cpass)) {	// If statement to check if password fields are empty

    $_SESSION["error"] = '<p class="error">Password fields are empty, please resubmit request.</p>' ;
            header( 'Location: changepassform.php');
                exit();
} else if ($pass != $cpass) {		// If statement to check if password fields match
    $_SESSION["error"] = '<p class="error">Passwords do not match, please resubmit request.</p>' ;
            header( 'Location: changepassform.php');
                exit();

}

else if(strlen($pass) < 8 || !$number) {	// If statement to check if password fits policy. if not, returns them to password change field.
session_start();
$_SESSION["error"].='<br> Password Policy error, requires length of 8 and a number.';
	 header( 'Location: changepassform.php');
                exit();

    }

$hashpass = password_hash($pass, PASSWORD_DEFAULT);


include '../dbconnection.php';

if( ($pass == $cpass) && (strlen($pass) >= 8 && $number)) {       // If statement for when the password is valid, which inserts the new password into the table

$sql = "UPDATE Usernames SET pass=? WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $hashpass, $id);
 
   if ($stmt->execute() === TRUE) {
  echo "Record updated successfully";
//header( 'Location: accountsettings.php');
} else {
  echo "Error updating record: " . $conn->error;
}

}

$conn->close();}