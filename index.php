<?php
session_start();

// site and page specific variables
require_once "site.php";

/* ********************************************************
    reCAPTCHA 


*/
require_once "recaptchalib.php";

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;

// 
$reCaptcha = new ReCaptcha(SITE_SECRET);

// Was there a reCAPTCHA response?
if ($_POST["g-recaptcha-response"]) {
    $resp = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
/* ********************************************************
    Silent hit counter and a visitor log of date/time and
    ip address.
*/
// require_once "count.php";
// require_once "callerid.php";
?>
<!DOCTYPE html>
<html lang="<?php echo SITE_LANG;?>">
<meta charset="<?php echo SITE_CHARSET;?>">
<head>
    <title><?php echo PAGE_TITLE;?></title>
    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <style>
        body {
            background:#333333;
            color:#aaaaaa;
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            font-weight:normal;
            margin:0px;
            padding:0px;
            overflow:hidden;
        }

        h1 {
            font-family:"Courier New", Courier, monospace;
            font-weight:bold;
        }

        .text-center {
            text-align: center;
        }

        .block-centered {
            display: inline-block;
        }
    </style>
</head>
<body>
<?php
// Did we arrive here as the result of the POST?
if ($resp != null && $resp->success) {
    // Save the userName in the session before
    // saving and closing the session.
    $_SESSION['userName']=$_POST['userName'];

    session_write_close();

    // load the application page...
    echo "
        <script>
            location.replace('".SITE_APPL."');
        </script>
    ";
} else {
    // "Real" user validation and user name collection...
?>
    <div class="text-center">
        <h1><?php echo PAGE_HEADING;?></h1>
        <form action="" method="post">
            <br/>
            <br/>
            <input id="userName" name="userName" placeholder="Please enter your name" required></input>
            <br/>
            <br/>
            <div class="g-recaptcha block-centered" data-sitekey="<?php echo SITE_KEY;?>" data-theme="dark"></div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo SITE_LANG;?>"></script>
            <br/>
            <br/>
            <button id="enterSite" type="submit"><?php echo FORM_SUBMIT;?></button>
        </form>
<?php } ?>
    </div>
</body>
</html>