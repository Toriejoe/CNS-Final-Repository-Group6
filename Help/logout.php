
<?php
session_start();
session_destroy();			// This page simply destroys all data in the session and sends the user to the main index.
header('Location: ../index.php');
exit;
?>
