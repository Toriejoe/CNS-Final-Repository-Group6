<! -- CNS Home page upon logging in. -->

<?php		
session_start();			// This block checks to see if the user is logged in, if not, they are redirected to the main index of the site.
if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head> <! -- Insert needed Meta tags, Scripts, and Stylesheets here -->
    <meta charset="utf-8">
    <title> Countryside Nursery</title>
    <link rel="stylesheet" href="homepagestylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>


<body id="body">

    <div id="formpage" class=" row gy-5 center testsize welcomeborder scrollbar">
        <img src="Assets/Logo 1.png" class="welcomephoto centerphoto" alt="Welcome">
        <p class="welcometext"> Welcome to Countryside Nursery! Since 1979, our goal at Countryside has been to provide a happy and positive environment for your child; to help gain an appreciation of the world around them; to experience pleasure through creative expression in art, music, and drama, to learn to express themselves; to develop desirable social behavior while learning to deal with his/her feelings and those of their peers. With these experiences, your child will discover that school and learning is rewarding and fun.        </p>
    </div>


    <div class="row navbar">
        <div class="column">
            <div>
                <p>
                    <a href="welcome.php"><img src="Assets/house-chimney-solid.svg" alt="Home Icon" id="Home" class="Insta svgcolor"> </a>
                </p>
            </div>
        </div>
        <br>

        <div class="column">
            <p>
                <a href="Calendar/"><img src="Assets/calendar-days-solid.svg" id="Calendar" alt="Calendar Icon" class="hovercolor"></a>
            </p>
        </div>
        <div class="column">
            <p>
                <a href="Gallery/"><img src="Assets/images-solid.svg" id="Gallery" alt="Gallery Icon" class="hovercolor"></a>
            </p>
        </div>
        <br>
        <div>
            <div class="column">
                <p>
                    <a href="News/"><img src="Assets/bell-solid.svg" id="News" alt="Newsfeed Icon" class="hovercolor"></a>
                </p>
            </div>
        </div>
        <div class="column">
            <p>
                <a href="Help/"><img src="Assets/question-solid.svg" id="Help" alt="Help Icon" class="hovercolor"></a>
            </p>
        </div>
    </div>
</body>
</html>