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
    <meta charset="utf-8">
    <title> Help </title>
    <link rel="stylesheet" href="../homepagestylesheet.css">
<link rel="stylesheet" href="helpadditionalstyles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <div id="formpage" class="d-flex row gy-5 center testsize testborder">

        <div class="testborder botto">
            

                    <label class="contactinfo" for="phoneSpan">Phone</label>
                    <div class="contactborder" id="emailSpan">
                        <p class="contacttext"> 573-445-4111 </p>
                    </div>

                    <label class="contactinfo" for="emailSpan">Email</label>
                    <div class="contactborder" id="emailSpan">
                        <p class="contacttext"> cnskids@gmail.com</p>
                    </div>

                    <label class="contactinfo" for="addresSpan">Address</label>
                    <div class="contactborder" id="addresSpan">
                        <p class="contacttext2">1320 South Fairview Road Columbia, Missouri 65203 </p>
                    </div>



                    <div class="buttonbox">
                        <form action="registrysearch.php">
                            <div class="row top-buffer justify-content-center improved">
                                <button type="submit" id="ParentSearch" class="rounded-pill btn-primary btn-block p-1 login improved">Search for Parents/Staff</button>
                            </div>
                        </form>
<div class="buttonbox">
                            <div class="row top-buffer justify-content-center improved">
<a href="accountsettings.php"><button type="button" class="rounded-pill btn-primary btn-block p-1 login improved">Account Settings</button></a>
                                                           </div>

                        </div>

<div class="row top-buffer justify-content-center improved">
<a href="logout.php"><button type="button" class="rounded-pill btn-primary btn-block p-1 login improved">Logout</button></a>
                                                           </div>

<div class="row top-buffer justify-content-center improved invis">
<button type="button" class="rounded-pill btn-primary btn-block p-1 login improved">Placeholder</button>
                                                           </div>


                        </div>





                                    </div>





        </div>
    <br>
    <br>
    <br> 
    

   <div class="row navbar">
        <div class="column">
            <div>
                <p>
                    <a href="../welcome.php"><img src="../Assets/house-chimney-solid.svg" alt="Home Icon" id="Home" class="hovercolor"> </a>
                </p>
            </div>
        </div>
        <br>

        <div class="column">
            <p>
                <a href="../Calendar/"><img src="../Assets/calendar-days-solid.svg" id="Calendar" alt="Calendar Icon" class="hovercolor"></a>
            </p>
        </div>
        <div class="column">
            <p>
                <a href="../Gallery/"><img src="../Assets/images-solid.svg" id="Gallery" alt="Gallery Icon" class="hovercolor"></a>
            </p>
        </div>
        <br>
        <div>
            <div class="column">
                <p>
                    <a href="../News/"><img src="../Assets/bell-solid.svg" id="News" alt="Newsfeed Icon" class="hovercolor"></a>
                </p>
            </div>
        </div>
        <div class="column">
            <p>
                <a href="index.php"><img src="../Assets/question-solid.svg" id="Help" alt="Help Icon" class="svgcolor"></a>
            </p>
        </div>
    </div>


</body>

</html>