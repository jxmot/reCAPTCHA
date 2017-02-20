<?php
/*
    Register API keys at - 
        https://www.google.com/recaptcha/admin

    reCAPTCHA supported 40+ languages listed here -
        https://developers.google.com/recaptcha/docs/language
*/
define('SITE_KEY', 'YOUR RECAPTCHA SITE KEY GOES HERE');
define('SITE_SECRET', 'YOUR RECAPTCHA SECRET GOES HERE');
/*
    Language setting used by our HTML and required by the
    reCAPTCHA api. The charset is only used in our HTML.
*/
define('SITE_LANG', 'en');
define('SITE_CHARSET', 'UTF-8');
// the page that is loaded upon passing the reCAPTCHA and
// entering a user name
define('SITE_APPL', './phpinfo.php');
// used by callerid.php
define('SITE_USERIP', $_SERVER['REMOTE_ADDR']);
/*
    some page elements
*/
define('PAGE_TITLE', 'Title for this Page goes here');
define('PAGE_HEADING', 'Page Heading');
// Submit button caption
define('FORM_SUBMIT', 'Enter');
/*
    For use in subsequent code, for example the 
    counter might use this to create page named
    counters. 
*/
$tmp = basename($_SERVER['PHP_SELF']);
define('SITE_RESOURCE', substr($tmp, 0, (strlen($tmp) - 4)));
?>
