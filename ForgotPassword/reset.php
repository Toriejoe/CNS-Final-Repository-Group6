<?php

// For the forgot password feature, we utilized a tutorial by Dani Krossing https://youtu.be/wUkKCMEYj9M

ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
error_reporting(-1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require '../dbconnection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';

if (isset($_POST["ResetPassword"]))
{

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


    $url .= "/Group6/ForgotPassword/resetpage.php?selector=". $selector . "&validator=" . bin2hex($token);

echo $url;

    $expires = date("U") + 1800;

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM PassReset Where pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo __LINE__;
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO PassReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;
    $subject = "Password Reset";
    $message = "<p> Your password reset link. </p>";
    $message .= '<a href="' . $url . '">' . $url . '</a> </p>';
    $mail = new PHPMailer(true);

    // Sender and recipient settings
    $mail->setFrom('cnssupport@countrysidekids.com', 'Countryside Kids');
    try { ($mail->addAddress($userEmail, 'Receiver Name'));
}
catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
    $mail->addReplyTo('cnssupport@countrysidekids.com', 'Countryside Kids'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Password Reset Link";
    $mail->Body = " Here is the password reset link that you requested. If you did not request a password reset, please ignore this message. <a href='$url'>$url</a>";
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';


try {
    $mail->send();
    echo "Message has been sent successfully";
header('Location: ../loginform.php');
} catch (Exception $e) {
    echo "Mailer Error: ";
header('Location: forgotpass.php');
}
    
    }
    
 



}

?>