<?php

if (isset($_POST["reset-password-submit"])) {

$selector = $_POST["selector"];
$validator = $_POST["validator"];
$pass = $_POST["pwd"];
$cpass = $_POST["cpwd"];
$number = preg_match('@[0-9]@', $pass);

include '../dbconnection.php';

    $url .= "/resetpage.php?selector=". $selector . "&validator=" .$validator;


if (empty($pass) || empty($cpass)) {		// If statement to check if either password fields are empty.
session_start();
    $_SESSION["msg"] = '<p style="color:red;"> Password fields are empty, please resubmit.</p>';
            header( "Location: .$url");
                exit();
}
 else if ($pass != $cpass) {		// else If statement to check if password fields match.
session_start();
   $_SESSION["msg"] = '<p style="color:red;"> Password do not match.</p>';

            header( "Location: .$url");
                exit();
} else if (strlen($pass) < 8 || !$number) {	// else If statement to check password policy.
session_start();
$_SESSION["msg"] = '<p style="color:red;"> Password policy error, passwords must have atleast 8 characters and a number.</p>';
	 header( "Location: .$url");

echo "password policy error";
exit();
    }


$currentDate = date("U");	// Create a variable of the current date for checking against expiration.

$sql = "SELECT * FROM PassReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?"; // Query to find rows from password reset table where selector is valid and has not yet expired.
						$stmt 	  = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt, $sql)) { // If the statement is unable to prepare return user to previous page.
			session_start();
            $_SESSION["msg"] ='<p style="color:red;"> Password request is invalid or expired, please request another.</p>';
	 header( "Location: .$url");
                exit();
}

else {
							mysqli_stmt_bind_param($stmt, 'ss', $selector,$currentDate);
							mysqli_stmt_execute($stmt);

							$result  = mysqli_stmt_get_result($stmt);
							if (!$row = mysqli_fetch_assoc($result)) {
session_start();
            $_SESSION["msg"] ='<p style="color:red;"> Password request is invalid or expired, please request another.</p>';
	 header( "Location: .$url");

                exit();
    } else {
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

        if($tokenCheck == false) {
session_start();
            $_SESSION["msg"] = '<p style="color:red;">Password request is invalid or expired, please request another.</p>' ;
            header( "Location: .$url");
                exit();
        } elseif($tokenCheck === true) {

            $tokenEmail = $row['pwdResetEMAIL'];

            $sql = "SELECT * FROM Usernames WHERE email=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $_SESSION["msg"] = '<p class="error">Invalid, please resubmit request.</p>' ;
            header( "Location: .$url");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(!$row = mysqli_fetch_assoc($result)) {
                    $_SESSION["msg"] = '<p class="error">Invalid, please resubmit request.</p>' ;
            header( "Location: .$url");
                exit();
            
                } else { 

                    $sql = "UPDATE Usernames SET pass=? WHERE email=?";
                    $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                session_start(); 
        $_SESSION["msg"] = '<p class="error">Invalid, please resubmit request.</p>' ;
            header( "Location: .$url");
                exit();
            }
            else {
                $PasswordHashNew = password_hash($pass, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $PasswordHashNew, $tokenEmail);
                mysqli_stmt_execute($stmt);

                $sql = "DELETE FROM PassReset Where pwdResetEMAIL=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo __LINE__;
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $userEmail);
                    mysqli_stmt_execute($stmt);
                    session_start(); 
        $_SESSION["msg"] = '<p style="color:green;"> Password reset!</p>';
            header( 'Location: ../loginform.php');
                }

                }
            }

        }
    }
}
}
}
