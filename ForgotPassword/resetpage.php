<?php
// For the forgotten password feature, we utilized a tutorial by Dani Krossing https://www.youtube.com/watch?v=wUkKCMEYj9M

$selector = $_GET["selector"];
$validator = $_GET["validator"];

if (empty($selector) || empty($validator)) {
    echo "If you are seeing this, your password request link is Invalid.";
}
else {
    if (ctype_xdigit($selector) !== false and ctype_xdigit($validator) !== false){
        echo "If you are seeing this, your password request link was valid!";

    }
}

session_start();

if(isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    session_unset($_SESSION["msg"]);
session_destroy(); 
} else {
    $msg = "";
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
    <script>
        $(document).ready(function() {
            $("#backbutton").click(function() {
                $("#formpage").load("loginform.php");
            });
        });
    </script>

</head>

<body>

    <div id="formpage" class="d-flex row gy-5 center testsize testborder">

        <div class="testborder botto">
            <p id="backbutton" class="signup">
                < Back </p>
<?php echo $msg ?>
                    <form action="resetpagefunction.php" method="post">
                        <div class="form-group">
                            <input type="password" name="pwd" class="form-control" id="formGroupExampleInput" placeholder="Enter your new password.">
                            <input type="password" name="cpwd" class="form-control" id="formGroupExampleInput" placeholder="Confirm your new password.">
                            <input type="hidden" name="selector" value="<?php echo htmlspecialchars($selector); ?>">
        <input type="hidden" name="validator" value="<?php echo htmlspecialchars($validator); ?>">
                        </div>
                        

                        <div class="buttonbox">
                            <div class="row top-buffer justify-content-center">
                                <button type="submit" name="reset-password-submit" class="rounded-pill btn-primary btn-block p-5 login">Reset Password</button>
                            </div>

                        </div>
                    </form>


                           </div>



    </div>

</body>

</html>