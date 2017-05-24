<?php
/*
    sitedb.php
        
        Reads the required reCAPTCHA settings and page content from a MySQL 
        database.

        
    NOTE: Modify $_site_id as needed, it's a string that uniquely identifies 
    this site's data from others in the database.

    A possible choice could be the associated domain name (without the TLD) 
    or application name. Keep it simple. This is also used by the optional 
    caller ID and hit count code when naming their output files.

*/
$_site_id = 'demo_01';

/* connect to the server and database... */
/* NOTE: If 'recaptcha_dev' is modified, must also modify seed.sql and 
   create_table.sql */
$sqldb = mysqli_connect('localhost', 'root', 'root', 'recaptcha_dev');

if (!$sqldb) {
    echo "<p>";
    echo "Error: Unable to connect to MySQL.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    echo "</p>";
    exit;
}

/* Select queries return a resultset */
if ($result = mysqli_query($sqldb, "SELECT * FROM sites WHERE site_id='" . $_site_id . "'")) {
    /* expecting only one row to be returned */
    if (($cnt = mysqli_num_rows($result)) != 1) {
        echo "<p>";
        echo "Error: Incorrect results, num rows = " . $cnt . "<br>";
        echo "</p>";
        exit;
    }
    /* fetch associative array */
    $row = $result->fetch_assoc();
    
    define('SITE_ID', $_site_id);
    
    /*
        Register API keys at - 
            https://www.google.com/recaptcha/admin
    
        reCAPTCHA supported 40+ languages listed here -
            https://developers.google.com/recaptcha/docs/language
    */
    define('SITE_KEY', $row["site_key"]);
    define('SITE_SECRET', $row["site_secret"]);
    /*
        Language setting used by our HTML and required by the
        reCAPTCHA api. The charset is only used in our HTML.
    */
    define('SITE_LANG', $row["site_lang"]);
    define('SITE_CHARSET', $row["site_charset"]);
    /*
        The page that is loaded upon passing the reCAPTCHA and
        entering a user name
    */
    define('SITE_APPL', $row["site_appl"]);
    /* some page elements */
    define('PAGE_TITLE', $row["page_title"]);
    define('PAGE_HEADING', $row["page_heading"]);
    define('PAGE_MESSAGE', $row["page_message"]);
    /* Submit button caption */
    define('FORM_SUBMIT', $row["form_submit"]);
    /* free result set */
    $result->free();
} else {
    echo "<p>";
    echo "Error: site_id not found, looking for - " . $_site_id . "<br>";
    echo "</p>";
    exit;
}

?>
