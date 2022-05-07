<?php
$selector = $_GET["selector"];
$validator = $_GET["validator"];
$SignUpEMAIL = $_GET["authemail"];

if (empty($selector) || empty($validator)) {

header ("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Login </title>
    <link rel="stylesheet" href="homepagestylesheet.css">
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
                    <?php
session_start();
if(isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]);
} else {
    $msg = "";
}

?>
<body>
<?php echo $msg ?>
    <div id="formpage" class="d-flex row gy-5 center testsize testborder">

        <div class="testborder botto">
            <p id="backbutton" class="signup">
                < Back </p>

                   <form action="enrollmentfinal.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo htmlspecialchars($SignUpEMAIL);?>" value="<?php echo htmlspecialchars($SignUpEMAIL);?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="selector" value="<?php echo htmlspecialchars($selector); ?>">
        <input type="hidden" name="validator" value="<?php echo htmlspecialchars($validator); ?>">


                        <div class="buttonbox">
                        <div class="row top-buffer justify-content-center">
                            <button type="submit" class="rounded-pill btn-primary btn-block p-5 login">Sign Up</button>
                        </div>

                    </div>
    </form>


        </div>



    </div>

</body>

</html>