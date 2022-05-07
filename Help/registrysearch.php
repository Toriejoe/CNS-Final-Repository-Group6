<?php
session_start();
if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Parents/Staff</title>
    <link rel="stylesheet" href="../homepagestylesheet.css">
<link rel="stylesheet" href="helpadditionalstyles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.search-box input[type="text"]').on("keyup input", function() {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("parentsearch.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            });
    </script>
</head>

<body>
<p id="backbutton" class="signup" > <a href="index.php">
                < Back </a> </p>


    <div class="buttonbox">
        <div class="row top-buffer justify-content-center">

            <div class="search-box">
                <input type="text" class="form-control" autocomplete="off" placeholder="Search Parents/Staff" />
                <div class="result"></div>
            </div>
</div>
       
</body>

</html>