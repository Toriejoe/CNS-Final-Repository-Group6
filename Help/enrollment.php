<?php
include 'dbconnection.php';

session_start();
if($_SESSION["accessLevel"] !== 2){

header('Location: accountsettings.php');
exit;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Login </title>
    <link rel="stylesheet" href="../homepagestylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <div id="formpage" class="d-flex row gy-5 center testsize testborder">

        <div class="testborder botto">
            <p id="backbutton" class="signup">
                <p id="backbutton" class="signup" > <a href="accountsettings.php">
                < Back </a> </p>


                    <form action="enrollment2.php" method="post">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Enter the new user's email.">
                        </div>

                        <div class="buttonbox">
                            <div class="row top-buffer justify-content-center">
                                <button type="submit" name="ResetPassword" class="rounded-pill btn-primary btn-block p-5 login">Send Access Link</button>
                            </div>

                        </div>
                    </form>
                    <?php
                    if(isset($_GET["reset"])) {
                        if ($_GET["reset"] == "success") {
                            echo '<p class ="signupsuccess">Please Check your Email.</p>';
                        }
                    }
                    ?>
        </div>



    </div>

</body>

</html>

