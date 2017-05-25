<?php
$_site_id = 'demo_01';
define('SITE_ID', $_site_id);

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
/*
    some page elements
*/
define('PAGE_TITLE', 'Title for this Page goes here');
define('PAGE_HEADING', 'Page Heading');
define('PAGE_MESSAGE', 'This demonstration illustrates reCAPTCHA v2 and MySQL, where MySQL is used for storing things like site specific content. Like this message.');
// Submit button caption
define('FORM_SUBMIT', 'Enter');
// reCAPTCHA theme (light or dark)
define('RECAPTCHA_THEME', 'dark');
?>
