<?php 
/*
    Reads the userName from the session that
    was written to by a prior validation event.
    At the time this modification was created 
    this file was paired with a reCAPTCHA v2
    validation.
*/
echo "userName from the reCAPTCHA page is - ".$_SESSION['userName']."\n\n";

phpinfo(); 

?>
