<?php
ini_set('display_errors', 1);
    
if($_SERVER["REQUEST_METHOD"] == "POST") {    // This if statement is used to check if a POST request was submitted from the previous form.
      
    include 'dbconnection.php';   // Database credentials file.
    
    $firstname = $_POST["firstname"]; // Gather needed variables from the sign-up form.
    $lastname = $_POST["lastname"]; 
    $email = $_POST["email"];
    $phone = $_POST["phone"]; 
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; // Confirmation Password
    $number = preg_match('@[0-9]@', $password); // This variable is used to check if the password has a numerical value.
    $hash = password_hash($password, PASSWORD_DEFAULT); // This variable is a hashed version of the password the user signed up with.

    $checkusersql = "Select * from Usernames where email='$email'"; // Query that selects the user email if it already exists within the database.
    $result = mysqli_query($conn,$checkusersql); // Result of the previous query.
    $num = mysqli_num_rows($result); // The number of rows found within the result. 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {         // This if statement checks if the email is valid, returning the user to signup if not.
        session_start();				 	// Starts a session needed for msg variable
$_SESSION["msg"].='<p style="color:red;"> This email is in an invalid format.</p>'; //Sets the message variable to relevant feedback
	 header('Location:signupform.php');
    }


    else{							// else statement that proceeds if the email is valid

    if(($num == 0) && ($password == $cpassword) && (strlen($password) >= 8 && $number)) {	// If statement that checks both passwords for a match, minimum string length, and a numerical. If true, attempts to create the new user.
            
    $sql = "INSERT INTO Usernames (firstname, lastname, email, phone, pass) VALUES (?, ?, ?, ?, ?)";	// Prepared statement for inserting the account
$stmt= $conn->prepare($sql);				
$stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $hash);				// Bind variable to the ? placeholders


    if ($stmt->execute() === TRUE) {								// If the account is succesfully inserted into database, return the user to the login form with success message.
session_start();
        $_SESSION["msg"]='<p style="color:green;"> Your account has been created!</p>';
        header('Location:loginform.php');
        exit;
      }

else {												// Else, when there is a unspecified error while inserting, return to login with error message. 
session_start();
        $_SESSION["msg"]='<p style="color:red;"> Issue querying database.</p>';

        header('Location:loginform.php');
        exit;
      }
    }
												// In the event that the error is not a failed query, but something else, the if statements below return correct feedback to the user.

    if($num>0) 											// If the number of rows is greater than 0, this means an account with the specified email is already registered, and the user is returned to the signup with an error message.
    {
        echo "This email has already been registered before.";
session_start();
$_SESSION["msg"].='<p style="color:red;"> This email is already registered.</p>';
	 header('Location:signupform.php');

    } 
    
    if(strlen($password) < 8 || !$number) 							// If there is a password policy error, return the user to signup with an error message.
    {
session_start();

$_SESSION["msg"].='<p style="color:red;"> Password Policy error, requires length of 8 and a number.</p>';
	 header('Location:signupform.php');

    }

    if($password != $cpassword)									// If the passwords do not match, return the user to signup with an error message.
    {
session_start();

$_SESSION["msg"].='<p style="color:red;"> Confirmation password does match.</p>';
	 header('Location:signupform.php');

    } 
}
  
}
    
?>