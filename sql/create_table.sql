-- change as desired, the '_dev' can be removed.
-- NOTE: If modified, must also modify seed.sql
-- and sitedb.php
create schema recaptcha_dev;

use recaptcha_dev;

create table sites(
    id integer(5) auto_increment not null,
    primary key(id),
    -- "site_id" - a string that uniquely identifies this data row. A 
    -- possible choice could be the associated domain name (without the TLD) 
    -- or application name. Keep it simple. This is also used by the optional 
    -- caller ID and hit count code when naming their output files. However, 
    -- this column cannot be null or empty. It must contain a unique string.
    site_id varchar(32)  not null,
    -- Register API keys at - 
    --     https://www.google.com/recaptcha/admin
    site_key varchar(64) not null,
    site_secret varchar(64) not null,
    -- reCAPTCHA supported 40+ languages listed here -
    --     https://developers.google.com/recaptcha/docs/language
    site_lang varchar(4) default 'en',
    -- used in our html output
    site_charset varchar(16) default 'UTF-8',
    -- the page to jump to when the reCAPTCHA is successful
    site_appl varchar(84) default './phpinfo.php',
    -- reCAPTCHA page content
    page_title varchar(32) default 'Title for this Page goes here',
    page_heading varchar(32) default 'Page Heading',
    page_message varchar(255) default 'A message of up to 255 characters can be here.',
    -- submit button caption
    form_submit varchar(16) default 'Enter',
    -- reCAPTCHA theme (light or dark)
    recaptcha_theme varchar(8) default 'dark'
);

select * from sites;
