<?php

// This upload feature utlized a class by verot to upload and process images. https://github.com/verot/class.upload.php

namespace Verot\Upload;

error_reporting(E_ALL);

// we first include the upload class, as we will need it here to deal with the uploaded file
include('src/class.upload.php');
include '../dbconnection.php';

// set variables
$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'tmp');
$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);

$log = '';

?>



<?php

session_start();
if($_SESSION["accessLevel"] == 2){ // Before doing anything else, make sure the user has access to use this feature.

// we have several forms on the test page, so we redirect accordingly
$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : ''));


//$Subject = $_POST["Subject"]; 
//$Posts = $_POST["Posts"]; 

//$Subject ="sample subject";
//$Post ="sample post";
//$Filepath = '  <img src="'.$dir_dest.'/' . $handle->file_dst_name . '" />';

//$sql = "INSERT INTO Gallery (Subject, Post, Filepath) VALUES ('$Subject', '$Posts', '$Filepath')";


//if ($conn->query($sql) === TRUE) {

if ($action == 'image') {

    // ---------- IMAGE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 300;
	$handle->allowed      = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->process('/home/www/my_uploads/');
        $handle->process('images/');

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
header('Location: index.php');
        } else {
            // An error occured
// Return user to index if incorrect file is uploaded.
session_start();
$_SESSION["msg"].='<p style="color:red;"> Incorrect File Type, Images only please.</p>';
header('Location: index.php');
        }

        // we now process the image a second time, with some other settings
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 300;
$handle->allowed      = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
        $handle->image_reflection_height = '25%';
        $handle->image_contrast          = 50;

        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            //echo '  <img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] .' - ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';

	// Insert the filepath into gallery table, so that it can be retrieved later.
            $Subject = $_POST["Subject"]; 
            $Posts = $_POST["Posts"]; 
            $Filepath = ' '.$dir_dest.'/' . $handle->file_dst_name .'';
            $sql = "INSERT INTO Gallery (Subject, Post, Filepath) VALUES (?, ?, ?)";
	    $stmt= $conn->prepare($sql);
	    $stmt->bind_param("sss", $Subject, $Posts, $Filepath);

            if ($stmt->execute()) {
                echo 'inserted!';
            }
            else {
                echo 'connection failed.';
            }
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        // we delete the temporary files
	// Due to this not working correctly, we altered the gallery to use the temporary folder and cleaned up the images folder instead.
        $handle-> clean();
	$CleanDuplicates = "images/";
	$CleanDuplicates .= basename($handle->file_dst_name);
	unlink($CleanDuplicates);


    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
header('Location: index.php');
    }

    $log .= $handle->log . '<br />';
}
//}



if ($log) echo '<pre>' . $log . '</pre>';
}

else {
echo "Error, attempted to upload without access";
}

?>
</body>

</html>