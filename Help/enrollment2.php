<?php
ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
error_reporting(-1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';

session_start();

if($_SESSION["accessLevel"] == 2){		// Before doing anything else, check if the user is an administrator

if (isset($_POST["ResetPassword"]))		
{

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    
    $expires = date("U") + 1800;

    require '../dbconnection.php';

    $SignUpEMAIL = $_POST["email"];

$selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // Program to display URL of current page.
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https";
    else $url = "http";
      
    // Here append the common URL characters.
    $url .= "://";
      
    // Append the host(domain name, ip) to the URL.
    $url .= $_SERVER['HTTP_HOST'];


    $url .= "/Group6/enrollmentsignup.php?selector=". $selector . "&validator=" . bin2hex($token) . "&authemail=" . $SignUpEMAIL;

    $sql = "DELETE FROM SignupAuth Where SignUpEMAIL=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo __LINE__;
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $SignUpEMAIL);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO SignupAuth (SignUpEMAIL, SignUpSelector, SignUpToken, SignUpExpires) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo __LINE__;
        exit();
    }
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $SignUpEMAIL, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $SignUpEMAIL;
    $subject = "CNS signup link";
    $message = "<p> CNS signup link </p>";
    $message .= '<a href="' . $url . '">' . $url . '</a> </p>';
    $mail = new PHPMailer(true);
    // Sender and recipient settings
    $mail->setFrom('cnssupport@countrysidekids.com', 'Countryside Kids');
    try { ($mail->addAddress($SignUpEMAIL, 'Receiver Name'));
}
catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

    $mail->addReplyTo('cnssupport@countrysidekids.com', 'Countryside Kids'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "CNS New user Signup.";
    $mail->Body = 'Welcome to the Countryside Nursery application, here is your sign-up link. <a href="' . $url . '">' . $url . '</a> </p>';

    $mail->AltBody = 'Your Sign-up link has arrived.';

 try {
    $mail->send();
    echo "Message has been sent successfully";
header('Location: accountsettings.php');
} catch (Exception $e) {
    echo "Mailer Error: ";
header('Location: accountsettings.php');
}

}

}
else {
echo "Insufficient privileges";
}
?>