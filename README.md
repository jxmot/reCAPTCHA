# reCAPTCHA - A Basic Example Using PHP

## Overview

The files contained in this repository are intended to demonstrate the use of reCAPTCHA. I've used the code here to create a simple "bot proof" entry into a photo gallery on one of my sites.

## Components

The following files are present - 

* `index.php` - manages the reCAPTCHA widget and contains a form with a field for a user name and a submit button. 
* `site.php` - a configuration file.
* `count.php` - a *invisible* hit counter. It only updates a count in a file specified in `site.php`. It does not display on the page that contains it.
* `callerid.php` - logging of the visitor's ip address and the date and time they visited.
* `phpinfo.php` - only displays information regarding the PHP installation on the server. This is the file that is loaded when the reCAPTCHA succeeds *and* the visitor has filled in the name field and clicked the form's submit button.
* `recaptchalib.php` - obtained from *Google Developers*, for more information see - <https://developers.google.com/recaptcha/docs/faq>

### Requirements

* A server capable of **https**. 
* PHP 5.6
* You must sign up for a reCAPTCHA account and obtain the site key and secret for your site. Start here - <https://www.google.com/recaptcha/intro/index.html>

## Use

To prepare for first use edit `site.php` and change the following as needed - 

* line 9 : your reCAPTCHA *site key* goes here
* line 10 : your reCAPTCHA *secret* goes here
* line 19 : this where you would put the path + file for your specific use. For the first test leave this line as-is.
* lines 25 and 26 : reCAPTCHA page title and heading.
* line 28 : Submit button caption

Then follow these steps :

1. Copy all of the files into a folder on your server.
2. Use your browser and go to `https://yourserver/optional-path/`, where `optional-path` is where you placed the files.
3. Fill in the name field and click the submit button.
4. The `phpinfo.php` should load and display information about the PHP installation on your server.

## Extras

### Form User Name

The user name field is saved in a PHP session as `$_SESSION['userName']`. This makes it available to the `SITE_APPL` page. And in this demo `phpinfo.php` will display the user name at the top of the page when it is loaded.

### Hit Counter and Caller ID

There are two files unrelated to reCAPTCHA, they are `count.php` and `callerid.php`. Although commented out, they're called in `index.php` on lines 33 and 34. The following sections describe their behaviors.

#### count.php

This file maintains a hit counter in a text file that is saved in the same folder where `count.php` is used. Unless `count.php` is modified otherwise it will use a text file named `count.log`. If the counter file does not exist the first time `count.php` is used it will be created automatically.

#### callerid.php

This file maintains a text file that contains a time stamped record with the visitors IP address - 

`2017/02/18 - 18:42:27 > 66.102.7.192`

Unless `callerid.php` is modified otherwise it will use a text file named `callerid.log`. If the log file does not exist the first time `callerid.php` is used it will be created automatically. In additon, if the file exceeds approximately 20k in size it is copied to a time stamped back up copy and a new caller ID log is created.



(c) 2017 Jim Motyl

