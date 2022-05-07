
<?php
ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
error_reporting(-1);

    session_start();
    include('dbconnection.php');


    if (isset($_POST['login'])) {	// If statements that checks if the login action was set on the login form.

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "Select * from Usernames where email=?";	// Query to check user rows within the database for matching emails.
	$stmt= $conn->prepare($query);
	$stmt->bind_param("s", $email);
        $stmt->execute();
	$result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {			// This if statement returns the user to the login page if no row containing their email was found, with an error message..
session_start();
$_SESSION["msg"].='<p style="color:red;"> Invalid Email or Password.</p>';
            header( 'Location: loginform.php');
        } else {
            if (password_verify($password, $row['pass'])) {	// This if statement logs the user in if their password matches the database.
                $_SESSION['user_id'] = $row['id'];
		$_SESSION['accessLevel'] = $row['accessLevel'];

                session_start();
                $_SESSION["loggedIn"] = true;
                header( 'Location: welcome.php' );
            } else {			// Else statement used in the event of an invalid password, returning the user with an error message.
session_start();
$_SESSION["msg"].='<p style="color:red;"> Invalid Email or Password.</p>';
                header( 'Location: loginform.php');
            }
        }
    }
?>