<?php

session_start();
include('../dbconnection.php');
$id = $_SESSION['user_id'];

if (isset($_POST['phone']) && !empty($_POST['phone'])) { // Check if user changed their phone number, strip letters and leading 1s, and ensures length is equal to 10
$phone = $_POST["phone"];

$number = preg_replace("/[^0-9]/", '', $phone);
$number2 = preg_replace("/^1/","", $number);

if (strlen($number2) != 10) {
echo "invalid number";
}

else {
$sql = "UPDATE Usernames SET phone=? WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $number2, $id);


if ($stmt->execute() === TRUE) {

  echo "Phone updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
}
}

if (isset($_POST['enableSMS']) && !empty($_POST['enableSMS'])) {	// If statements checks the user's opt in preference for SMS, and updates table accordingly.
$enableSMS = $_POST["enableSMS"];

if ($enableSMS == "enableSMSyes") {
//$sql = "UPDATE Usernames SET smsAllowed='1' WHERE id=$id";
$sql = "UPDATE Usernames SET smsAllowed='1' WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("s", $id);


if ($stmt->execute() === TRUE) {
  echo "sms preference updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
}

if ($enableSMS == "enableSMSno") {		// If statements checks the user's opt in preference for SMS, and updates table accordingly.

$sql = "UPDATE Usernames SET smsAllowed='0' WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute() === TRUE) {
  echo "sms preference updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
}


}


if (isset($_POST['firstname']) && !empty($_POST['firstname'])) { // If statements checks if a first name is set and not empty, then update with the new value.

$firstname = ucfirst($_POST["firstname"]); // capitalize first letter

$sql = "UPDATE Usernames SET firstname=? WHERE id=?"; 	
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $firstname, $id);


if ($stmt->execute() === TRUE) {
  echo "firstname updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}


}


if (isset($_POST['lastname'])  && !empty($_POST['lastname'])) {			// If statements checks if a last name is set and not empty, then update with the new value.
$lastname = ucfirst($_POST["lastname"]); // capitalize first letter

$sql = "UPDATE Usernames SET lastname=? WHERE id=?";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $lastname, $id);


if ($stmt->execute() === TRUE) {
  echo "lastname updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}



}
header('Location: accountsettings.php');

?>
