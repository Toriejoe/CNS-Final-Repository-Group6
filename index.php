<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Countryside Nursery</title>

    <link rel="stylesheet" href="homepagestylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login_button").click(function() {
                $("#formpage").load("loginform.php");
            });
            $("#signup_button").click(function() {
                $("#formpage").load("signupform.php");
            });
        });
    </script>
</head>

<body>

    <div id="formpage" class="d-flex row gy-5 center testsize testborder">
        <div class="center">
            <img src="Assets/EntryView.png" class="homephoto" alt="Placeholder">
        </div>


        <div class="testborder bottom">
            <div class="buttonbox">
                <div class="row top-buffer justify-content-center">
                    <button type="button" id="login_button" class="rounded-pill btn-primary btn-block p-5 login improved">Login</button>
                </div>

                <div class="row top-buffer justify-content-center">
                    <button type="button" id="signup_button" class="rounded-pill btn-primary btn-block p-5 login improved">Signup</button>
                </div>
            </div>
        </div>



    </div>

</body>

</html>