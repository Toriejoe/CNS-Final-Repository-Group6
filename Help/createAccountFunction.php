<?php
ini_set('display_errors', 1);


session_start();
if($_SESSION["accessLevel"] == 2){  // Before doing anything else, check is the user is an administrator
   
if($_SERVER["REQUEST_METHOD"] == "POST") { // Check if a post request was sent
      
    include '../dbconnection.php';   
    
    $firstname = $_POST["firstname"];  // Gather needed variables from the sign-up form.
    $lastname = $_POST["lastname"]; 
    $email = $_POST["email"];


if (isset($_POST['phone']) && !empty($_POST['phone'])) {  // Check if phone is set and not empty.
$phone = $_POST["phone"];

$removeletters = preg_replace("/[^0-9]/", '', $phone);  // Strip letters from phone if found.
$fullnumber = preg_replace("/^1/","", $number);		// Strip leading 1

if (strlen($fullnumber) != 10) {  // If phone is not 10 digits, return to the previous form
session_start();
$_SESSION["msg"].='<br> Invalid Phone Number';
	 header('Location:createAccountForm.php');

}

    $password = $_POST["password"]; // Gather needed variables from the create page form
    $cpassword = $_POST["cpassword"];
    $number = preg_match('@[0-9]@', $password);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $checkusersql = "Select * from Usernames where email='$email'"; // Query that selects the user email if it already exists within the database.
    $result = mysqli_query($conn,$checkusersql); // Result of the previous query.
    $num = mysqli_num_rows($result); // The number of rows found within the result. 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 	// This if statement checks if the email is valid, returning the user to signup if not.
        session_start();				// Starts a session needed for msg variable

$_SESSION["msg"].='This email is in an invalid format.'; //Sets the message variable to relevant feedback	
	 header('Location:createAccountForm.php');

    }

    else{						// else statement that proceeds if the email is valid

    if(($num == 0) && ($password == $cpassword) && (strlen($password) >= 8 && $number)) { // If statement that checks both passwords for a match, minimum string length, and a numerical. If true, attempts to create the new user.
            
$sql = "INSERT INTO Usernames (firstname, lastname, email, phone, pass) VALUES (?, ?, ?, ?, ?)"; // Prepared statement for inserting the account
$stmt= $conn->prepare($sql);				
$stmt->bind_param("sssss", $firstname, $lastname, $email, $fullnumber, $hash);

    if ($stmt->execute() === TRUE) {						// If the statement executes
        $_SESSION['msg']="You have successfully registered!";
        header('Location:createAccountForm.php');
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;				// If the query fails
      }
    }
										// In the event that the error is not a failed query, but something else, the if statements below return correct feedback to the user.
    if($num>0) 									// If the number of rows is greater than 0, this means an account with the specified email is already registered, and the user is returned to the signup with an error message.
    {
session_start();
$_SESSION["msg"].=' <br> This email is already registered.';
	 header('Location:createAccountForm.php');

    } 
    
    if(strlen($password) < 8 || !$number) 					// If there is a password policy error, return the user to signup with an error message.
    {
session_start();
$_SESSION["msg"].='<br> Password Policy error, requires length of 8 and a number.';
	 header('Location:createAccountForm.php');

    }
}

    
}
  }
}
else {
echo "insufficient privileges";
}  
?>