<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../dbconnection.php';

$notificationDesc = $_POST['notificationDesc'];
$yesSMS = $_POST['yesSMS'];


if (!isset($yesSMS)) {	// If the SMS option was not enabled by the poster, set it to no. 
  $yesSMS = "no";
}
else {
$yesSMS = $_POST['yesSMS']; // Else, keep default value
}


require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';		// Required for twilio API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = '';
$auth_token = '';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "";

session_start();

if($_SESSION["accessLevel"] == 2){             // Before anything else, this if statement checks if the user is an administrator before proceeding


$date = new DateTime();				// Create a current date in central time & format.
$date->setTimezone(new DateTimeZone('America/Chicago'));
$datestring = $date->format('g:i a m/d/Y');



$sql = "INSERT INTO News (Post, PostDate) VALUES (?, ?)";	// Inserts the content and date of the post into the News table.
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $notificationDesc, $datestring);



if ($stmt->execute()) {						// Returns the user to the news bulletin page if the statement was succesful.
header('Location: index.php');
} 

if ($yesSMS == "yes") {									    // This if loop checks to see if the administrator specified the SMS option.
$result = mysqli_query($conn,"SELECT distinct phone FROM Usernames WHERE smsAllowed = 1");  // Grab all unique (distinct) phone numbers for users that are opted into SMS.

while($row = mysqli_fetch_assoc($result)) {						    // This while loop attempts to send a message to every number found in the database. 
try {										            // Try-catch for catching invalid numbers.
$client = new Client($account_sid, $auth_token);
$client->messages->create(
    $row['phone'],									    
    array(
        'from' => $twilio_number,
        'body' => $notificationDesc    )
);
}
catch(Exception $e)									    // If for whatever reason, a phone number is invalid, the exception is caught and the number skipped.
{
continue;
}
}
}
}
else {
echo "Insufficient privileges";
}
?>