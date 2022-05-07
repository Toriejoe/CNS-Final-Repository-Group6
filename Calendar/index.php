<?php
session_start();
if($_SESSION["loggedIn"] != true){
    echo 'not logged in';
    header("Location: ../index.php");
    exit;
}

if(isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]); 
} else {
    $msg = "";
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link href='fullcalendar/packages/core/main.css' rel='stylesheet'/>
    <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet'/>
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
<link rel="stylesheet" href="../homepagestylesheet.css">
    <link rel="stylesheet" href="css/style.css">


<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src='fullcalendar/packages/core/main.js'></script>
    <script src='fullcalendar/packages/interaction/main.js'></script>
    <script src='fullcalendar/packages/daygrid/main.js'></script>



    <title>Calendar</title>
  </head>
  <body>
      <div class="body">
           <div class="row navbar">
                <div class="column">
                    <div>
                <p> <a href="../welcome.php"> <img src="Images/house-chimney-solid%20copy.svg" alt="Home Icon" class="hovercolor"> </a> </p>
            </div>
               </div>
               <br>
               
               <div class="column">
                    <p><a href="index.php"> <img src="Images/calendar-days-solid%20copy.svg" alt="Calendar Icon" class="svgcolor"></a></p>
               </div>
               <div class="column">
                    <p><a href="../Gallery/"> <img src="Images/images-solid%20copy.svg" alt="Gallery Icon" class="hovercolor"></a></p>
               </div>
               <br>
               <div>
                <div class="column">
                    <p><a href="../News/"> <img src="Images/bell-solid%20copy.svg" alt="Newsfeed Icon" class="hovercolor"></a></p> 
               </div>
               </div>
                <div class="column">
                    <p><a href="../Help/"> <img src="Images/question-solid%20copy.svg" alt="Help Icon" class="hovercolor"></a></p>
               </div>
            </div>
        </div>
  <div class="content">
<?php echo $msg ?>
    <div id='calendar'></div>
  </div>
 
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      defaultDate: new Date(),
      editable: true,
displayEventEnd: true,
      eventLimit: true, // allow "more" link when too many events
eventClick: function(info) {
                    var eventObj = info.event;
                    var id = info.event.id
document.getElementById('id02').style.display='block';

                    if (eventObj.extendedProps.description) {
			document.getElementById("CalendarTitle").innerHTML = 'Title: ' + eventObj.title;
                        document.getElementById("CalendarDescription").innerHTML = 'Description: ' + eventObj.extendedProps.description;
                        document.getElementById("checkyear").value = id;


                    }
                },
      events: "events.php",
//[      
    });

    calendar.render();
  });
    </script>
    <script src="js/main.js"></script>
<?php
if($_SESSION["accessLevel"] == 2){
  echo"
      <button class=\"uploadbutton\" onclick=\"document.getElementById('id01').style.display='block'\">Upload New Event</button>
";
}
?>


<!-- This modal is used for input  -->
      <div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content" action="newevents.php" method="post">
    <div class="container">
       <p> Add New Calendar Event</p>
                <input type="eventTitle" name="eventTitle" class="form-control-sm" id="eventTitle" placeholder="Enter Event Name" required="">
<br><label for="eventTitle"><p>Enter Event Title</p> </label><br>
              <input type="eventDescription" name="eventDescription" class="form-control-sm" id="eventDescription" placeholder="Enter Event Description" required="">
<br><label for="eventDescription"><p>Enter Event Description</p> </label><br>
                <input type="date" name="startDate" class="form-control-sm" id="startDate" placeholder="Enter Starting day" required="">
<br><label for="startDate"><p>Enter Starting Day</p> </label><br><br>
<input type="date" name="endDate" class="form-control-sm" id="endDate placeholder="Enter End Date">
<br><label for="endDate"><p>Enter End Date</p></label><br><br>

                <input type="time" name="startTime" class="form-control-sm" id="startTime" placeholder="Enter Starting Time">
<br><label for="startTime"><p>Enter Starting Time</p></label><br><br>
                <input type="time" name="endTime" class="form-control-sm" id="endTime" placeholder="Enter Event End Time">
<br><label for="endTime"><p>Enter Event End Time.</p></label>

            <br>  
          <br>
<input type="hidden" name="action" value="image">
    
          <input  type="submit" name="Submit" value="upload">
    </form>
    </div>
</div>



<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content2" action="newevents.php" method="post">
    <div class="container">
<p> Add New Calender Event</p>
          <label for="eventtitle">Event Title:</label>
<p id="CalendarTitle"> </p>
                <p id="CalendarDescription"> </p>
<?php


if($_SESSION["accessLevel"] == 2){ // User must be an administrator for the delete button to be rendered

   echo "<button type='button' onclick='DeleteConfirmation()' class='deletebtn'>Delete</button>";
}
?>
            <br>  
          <br>
<input type="hidden" name="action" value="image">
    
     
    </form>
    </div>
</div>

<?php


if($_SESSION["accessLevel"] == 2){ // User must be an administrator for this modal to be rendered.

   echo

"<div id='id03' class='modal'>
 <span onclick=\"document.getElementById('id03').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>  <form class='modal-content2' action='deleteEvent.php' method='post'>
    <div class='container'>
       <p>Delete this event?</p>
<p id='CalendarTitle'> </p>
                <p id='CalendarDescription'> </p>
                 <input type='hidden' id='checkyear' name='id' value='id' >
                <button type='submit' onclick='document.getElementById('id02').style.display='none'' class='deletebtn'>Yes, Delete</button>
<button type='button' onclick=\"document.getElementById('id03').style.display='none'\" class='cancelbtn'>No, Cancel</button>            <br>  
          <br>
<input type='hidden' name='action' value='image'>
    
     
    </form>
    </div>
</div>"
;
}
?>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}

function DeleteConfirmation() {
    document.getElementById('id02').style.display='none';
    document.getElementById('id03').style.display='block';
//document.getElementById("checkyear").value = id;

    
    
}

</script>



<!--      </div>-->
  </body>
</html>