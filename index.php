<?php
session_start();

// control over the use of MySQL
define('USE_MYSQL', false);
// if false or undefined then recaptchalib.php will be used
// if true then the slightly modified v1.2.4 will be used
define('USE_V124', false);

// site and page specific variables...
if(defined('USE_MYSQL') && USE_MYSQL === true) {
    // MySQL version - 
    require_once "sitedb.php";
} else { // -- OR --
    // No db version
    require_once "site.php";
}

/* ********************************************************
    reCAPTCHA 

    Google's reCAPTCHA method for validating a vistor vs.
    a bot. 
*/
if(!defined('USE_V124') || USE_V124 === false) {
    require_once "recaptchalib.php";
} else {
    require_once "./ReCaptcha/ReCaptcha.php";
}

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;

// get a ReCaptcha object....
if(!defined('USE_V124') || USE_V124 === false) {
    $reCaptcha = new ReCaptcha(SITE_SECRET);
} else {
    $reCaptcha = new \ReCaptcha\ReCaptcha(SITE_SECRET);
}

// Was there a reCAPTCHA response?
if ($_POST["g-recaptcha-response"]) {
    if(!defined('USE_V124') || USE_V124 === false) {
        $resp = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    } else {
        $resp = $reCaptcha->verify(
            $_POST["g-recaptcha-response"],
            $_SERVER["REMOTE_ADDR"]
        );
    }
}
/* ********************************************************
    Optional silent hit counter and a visitor log of date/
    time and ip address.
*/
//require_once "count.php";
//require_once "callerid.php";
?>
<!DOCTYPE html>
<html lang="<?php echo SITE_LANG;?>">
<meta charset="<?php echo SITE_CHARSET;?>">
<head>
    <title><?php echo PAGE_TITLE;?></title>
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
$success = false;

// Did we arrive here as the result of the POST?
if($resp != null) {
    if(!defined('USE_V124') || USE_V124 === false) {
        $success = $resp->success;
    } else {
        $success = $resp->isSuccess();
    }
}

if ($success == true) {
    // Save the userName in the session before
    // saving and closing the session.
    $_SESSION['userName']=$_POST['userName'];
    
    $_SESSION['site_id']=SITE_ID;

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
        <h3><?php echo PAGE_MESSAGE;?></h3>
<?php
if(!defined('USE_V124') || USE_V124 === false) {
    echo "        <h3>Using <pre>recaptchalib.php - ";
} else {
    echo "        <h3>Using <pre>reCAPTCHA PHP client library - ";
}
echo $reCaptcha->getVersion() ."</pre></h3>\n";
?>
        <form action="" method="post">
            <br/>
            <br/>
            <input id="userName" name="userName" placeholder="Please enter your name" required></input>
            <br/>
            <br/>
            <div class="g-recaptcha block-centered" data-sitekey="<?php echo SITE_KEY;?>" data-theme="<?php echo RECAPTCHA_THEME;?>"></div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo SITE_LANG;?>"></script>
            <br/>
            <br/>
            <button id="enterSite" type="submit"><?php echo FORM_SUBMIT;?></button>
        </form>
    </div>
<?php } ?>
</body>
</html>
