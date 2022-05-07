<?php
session_start();

if(isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]);
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
    <link rel="stylesheet" href="homepagestylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#backbutton").click(function() {
                $("#formpage").load("index.php");
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
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
                        </div>



                        <div class="buttonbox">
                            <div class="row top-buffer justify-content-center">
                                <button type="submit" name="login" value="login" class="rounded-pill btn-primary btn-block p-5 login improved">Login</button>
                            </div>
</form>
<form action="ForgotPassword/forgotpass.php" method="post">
                            <div class="row top-buffer justify-content-center">
                                <button type="submit" id="forgotpass" class="rounded-pill btn-primary btn-block p-5 login improved">Forgot Password</button>
                            </div>
                        </div>
              </form>      
        </div>



    </div>

</body>

</html>