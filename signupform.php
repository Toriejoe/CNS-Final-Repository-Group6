<! -- For standard Sign up form. -->

<?php
session_start();

if(isset($_SESSION["msg"])) {	// This block checks to see if a message variable has been set by the session, typically used for errors or userfeedback.
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]);
} else {
    $msg = "";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Login </title>
    <link rel="stylesheet" href="homepagestylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>

<body>

    <div class="d-flex row gy-5 center testsize testborder">

        <div class="testborder botto">
            <p id="backbutton" class="signup" > <a href="index.php">
                < Back </a> </p>
			<div class="PR">
				<h1> Password Requirements: </h1>
				<ul>
				   <li>A numeric character</li>
				   <li>A minimum of 8 characters</li>
				</ul>

				<?php echo $msg   // Echo the msg variable for feedback if there is one. ?>
			
                    <form action="signup.php" method="post">  <! -- Use this to construct the signup form. -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                        </div>
                    

                    <div class="buttonbox">
                        <div class="row top-buffer justify-content-center">
                            <button type="submit" class="rounded-pill btn-primary btn-block p-5 login improved">Sign Up</button>
                        </div>

                    </div>
    </form>
        </div>



    </div>

</body>

</html>