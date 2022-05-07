<?php


// For live search feature, we utilized https://www.tutorialrepublic.com/php-tutorial/php-mysql-ajax-live-search.php

ini_set('display_errors', 1);

error_reporting(E_ALL);

include '../dbconnection.php';  

 

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM Usernames WHERE firstname LIKE ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $firstname = htmlspecialchars($row["firstname"]);
                    $lastname = htmlspecialchars($row["lastname"]);
                    $email = htmlspecialchars($row["email"]);
                    $phone = htmlspecialchars($row["phone"]);
                    $id = htmlspecialchars($row["id"]);

                    $fullname = $firstname . " " . $lastname ." -(" . $email. ")";

         
                    echo '<form action="fullcontact.php" method="post">';
                    echo  '<div class="form-group">';
                    //echo "<p>"  .$fullname. "</p>";
                    echo    '</div>';
                    echo    '<div class="form-group">';
                    echo       '<input type="hidden" class="form-control" name="Userid" value="'.$id.'" id="password" placeholder="Password">';
                    echo    '</div>';
                    echo '<div class="buttonbox">';
                    echo '<div class="row top-buffer justify-content-center">';
                    echo '<button type="submit" name="login" value="login" class="resultborder" id="addresSpan">'.$fullname.'</button>';
                    echo '</div>';
                    echo '</form>';

        
                }
            } else{
                echo "<p>No matches!</p>";
            }
        }     }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($conn);
?>