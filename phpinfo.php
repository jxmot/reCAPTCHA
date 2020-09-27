<?php 
session_start();

/*
    Reads the userName from the session that
    was written to by a prior validation event.
    At the time this modification was created 
    this file was paired with a reCAPTCHA v2
    validation.
*/
echo "<h2>userName from the reCAPTCHA page is - ".$_SESSION['userName']."</h2><br>";
echo "<h2>site_id from the reCAPTCHA page is - ".$_SESSION['site_id']."</h2><br><br>";

phpinfo(); 

?>
