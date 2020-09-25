# reCAPTCHA - A Basic Example Using PHP and MySQL

**I will be maintaining this repository until it is no longer possible. As of 2020-09 this code is still working. However Google has completely removed `recaptchalib.php` after version 1.0.0. My reasons for keeping this going are:**

* It works.
* It's **far less** complicated to use.
* Issues with the new "stuff":
    * The newest(v1.2.4) requires a installation procedure that some people have permissions to install via *Composer* or it is available with *direct download* according to the official README.
    * The 1.2.4 examples are targeted to Google hosting. There is a lot of unnecessary "stuff" that most people will not use or care about.
    * I have tried adapting the "examples" to tub used my hosting server. There are no guides, or usable information regarding what to do in a no-Composer environment.
* I fixed the PHP deprecation warning about the *constructor* in `recaptchalib.php`.

In addition to keeping `recaptchalib.php` around I have also modified a copy of v1.2.4 so that *it can be used* in a similar way to `recaptchalib.php`. 



# Table of Contents

* [Overview](#overview)
    * [History](#history)
* [Requirements](#requirements)
    * [reCAPTCHA and localhost](#recaptcha-and-localhost)
    * [Local Server](#local-server)
* [Components](#components)
* [Use](#use)
    * [Without MySQL](#without-mysql)
    * [With MySQL](#with-mysql)
        * [MySQL Configuration Items](#mysql-configuration-items)
        * [SQL Files](#sql-files)
    * [Screen Shot](#screen-shot)
* [Features](#features)
    * [Configuration](#configuration)
    * [Form User Name](#form-user-name)
    * [Hit Counter and Caller ID](#hit-counter-and-caller-id)
* [Future](#future)

# Overview

The files contained in this repository are intended to demonstrate the use of reCAPTCHA. I've used a previous version of the code here to create a simple "bot proof" entry into a photo gallery on one of my sites.

## History

As an *improvement* to the gallery version I decided to use a MySQL database to store configuration data instead of hard-coding it in the original `site.php` file. That allows me to easily use this code in other applications with only a single line change. And providing that a corresponding row of data exists within the database.

# Requirements

* An internet web server capable of **https**, or a local **http** server (*for development*) running on your PC. 
* PHP 7.x or newer.
* You must sign up for a reCAPTCHA account and obtain the site key and secret for your site. Start here - <https://www.google.com/recaptcha/intro/index.html>. 

## reCAPTCHA and localhost

Before you can use reCAPTCHA when serving from *localhost* you will need to go to **_Key Settings_** and add the following lines to the **_Domains_** box - 

```
localhost
127.0.0.1
```

## Local Server

My preference for a local HTTP server is MAMP(<https://www.mamp.info/en/>). There are alternatives, including a web server running on a virtual machine. However MAMP is very easy to use and there's a *free* version. The free version also includes MySQL. However, if you're already running a MySQL server you will need to make modifications to the MAMP server configuration files. A guide can be found in my Toolbox, see [MAMP Set Up](https://bitbucket.org/jxmot/toolbox/src/f748ca316f0095eb0e298a24348f21b2315808d9/MAMP.md?fileviewer=file-view-default). Another option is to disable *one* of your MySQL servers.

An alternative to MAMP is XAMPP(<https://www.apachefriends.org/index.html>). I've been using it more than MAMP because I prefer the features and options that are available to me.

# Components

The following files are present - 

* `index.php` - manages the reCAPTCHA widget and contains a form with a field for a user name and a submit button. 
* `sitedb.php` - a configuration file that uses MySQL to store configuration data.
* `site.php` - a configuration file.
* `count.php` - a *invisible* hit counter. It only updates a count in a file specified in `site.php`. It does not display on the page that contains it.
* `callerid.php` - logging of the visitor's ip address and the date and time they visited.
* `phpinfo.php` - only displays information regarding the PHP installation on the server. This is the file that is loaded when the reCAPTCHA succeeds *and* the visitor has filled in the name field and clicked the form's submit button.
* `recaptchalib.php` - obtained from *Google Developers*, for more information see - <https://developers.google.com/recaptcha/docs/faq>
* `sql/create_table.sql` - an SQL script file that creates the `site` table.
* `sql/seed.sql` - an SQL script file that seeds a single row.

# Use

The following sections describe two methods of use, "*With MySQL*" and "*Without MySQL*". To switch between them modify `index.php`, lines 6 and 8. The default is to use MySQL.

## Without MySQL

To prepare for first use edit `site.php` and change the following as needed - 

* line 2 : unique identifier for this reCAPTCHA site, 
* line 12 : your reCAPTCHA *site key* goes here
* line 13 : your reCAPTCHA *secret* goes here
* line 22 : this where you would put the path + file for your specific use. For the first test leave this line as-is.
* lines 26, 27, 28  : reCAPTCHA page title, heading, and message.
* line 30 : Submit button caption
* line 32 : reCAPTCHA theme - `light` or `dark`

**Then follow these steps :**

1. Copy all of the files into a folder on your server. Be careful! Don't put it in your web document root. Place it in a subfolder so you don't over write any existing `index.php` files
2. Use your browser and go to `https://yourserver/optional-path/`, where `optional-path` is where you placed the files.
3. Fill in the name field and click the submit button.
4. The `phpinfo.php` should load and display information about the PHP installation on your server.

## With MySQL

Use the following steps - 

1. Edit `sitedb.php`, `create_table.sql` and `seed.sql` as necessary
2. Run `create_table.sql`
3. Run `seed.sql`
4. Copy all of the files into a folder on your server
5. Run `index.php` as a client to your server

### MySQL Configuration Items

The following is only found in `sitedb.php` - 

```php
  $_db_name = 'recaptcha_dev';    // database name
  $_site_table = 'sites';         // table name
  $_db_server = 'localhost';      // MySQL server
  $_db_user = 'root';             // MySQL user 
  $_db_passw = 'root';            // MySQL user's password
```

**NOTE :** Modify the user and password as needed to suit your database server's and application's security requirements.

The following is also found in `sitedb.php`, it used in finding the correct settings in the database - 

```php
  $_site_id = 'demo_01';          // unique identifier for this reCAPTCHA site
```

**NOTE :** It is recommended that the *site ID* string contain only - 

* Letters - uppercase, lowercase, or mixed
* Numbers - 0 through 9, as necessary
* Other - `_` (*underscore*), `-` (*hyphen*)

It should **not** contain any whitespace, or characters not listed above.

### SQL Files

The `create_table.sql` and `seed.sql` files can be ran (*MySQL Workbench can run them*) to create the table's schema and to seed some data. The data in the `seed.sql` file is for demonstration only, edit as necessary or create your own seed-file.

## Screen Shot

If your reCAPTCHA *site key*, *secret*, and *domains* have been set properly, and your server is running then you should see the following - 

![reCAPTCHA Demo](./mdimg/recaptcha-thumb-900x500.png)

# Features

## Configuration

Either the hard-coded (`site.php`) or the MySQL (`sitedb.php` and `seed.sql`) have the following configurable items - 

* reCAPTCHA *site key* and *site secret*.
* Site ID - a unique string used for identifying the specific site using this reCAPTCHA (*found in* `site.php` *and* `sitedb.php` *as* `$_site_id`)
* Site Language - used in `index.php` within the `<HTML>` tag and for setting the reCAPTCHA language
* Site Character Set - used in `index.php` within the `<META>` tag and for setting the page character set
* Site Application - a string that contains a path and file that are loaded upon success from reCAPTCHA, this can also be a URL
* Page Title - the title for the page generated by `index.php`
* Page heading - the `<H1>` page heading
* Page Message - any content (*including HTML*) to be used as a message to the user
* Form Submit Button Caption - the caption to be used in the submit button
* reCAPTCHA Theme - `light` or `dark` are the only two choices allowed by reCAPTCHA

## Form User Name

The user name field is saved in a PHP session as `$_SESSION['userName']`. This makes it available to the `SITE_APPL` page. And the demonstration *in this repository* the file `phpinfo.php` will display the user name at the top of the page when it is loaded. The site ID is also displayed.

## Hit Counter and Caller ID

There are two files unrelated to reCAPTCHA, they are `count.php` and `callerid.php`. Although commented out, they're called in `index.php` on lines 38 and 39. And are commented out as default. The following sections describe their behaviors.

**`count.php` :**

This file maintains a hit counter in a text file that is saved in the same folder where `count.php` is used. The file is named `siteID_count.log`. Where `siteID` is the string that had been configured above. If using the demonstration settings that string will be `demo_01`.

If the counter file does not exist the first time `count.php` is ran it will be created automatically.

**`callerid.php` :**

This file maintains a text file that is saved in the same folder where `callerid.php` is used. The file is named `siteID_callerid.log`. Where `siteID` is the string that had been configured above. If using the demonstration settings that string will be `demo_01`.

For each visitor a time stamped record with the visitors IP address is created - 

`2017/02/18 - 18:42:27 > 66.102.7.192`

If the log file does not exist the first time `callerid.php` is ran it will be created automatically. In additon, if the file exceeds approximately 20k in size it is copied to a time stamped back up copy and a new caller ID log is created. The time stamp in the file name will be the date and time when the *back up* is created.

# Future

* An administration form is planned that will allow an admin user to enter sites into the database.
* Might create a MongoDB version.
* Store the CSS in the site config data.

(c) 2017 Jim Motyl

