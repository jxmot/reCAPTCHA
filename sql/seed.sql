-- change as desired, the '_dev' can be removed.
-- NOTE: If modified, must also modify create_table.sql
-- and sitedb.php
use recaptcha_dev;

-- Register API keys at - 
--     https://www.google.com/recaptcha/admin
-- 
-- reCAPTCHA supported 40+ languages listed here -
--     https://developers.google.com/recaptcha/docs/language

-- write to all columns
insert into sites (site_id,site_key,site_secret,site_lang,site_charset,site_appl,page_title,page_heading,page_message,form_submit) 
values ('demo_01','YOUR RECAPTCHA SITE KEY GOES HERE','YOUR RECAPTCHA SECRET GOES HERE','en','UTF-8','./phpinfo.php','reCAPTCHA Demo','reCAPTCHA Demo using MySQL','This demonstration illustrates reCAPTCHA v2 and MySQL, where MySQL is used for storing things like site specific content. Like this message.','Run Application');

-- minimum required columns for creating a row
-- insert into sites (site_id, site_key,site_secret) 
-- values ('demo_01','YOUR RECAPTCHA SITE KEY GOES HERE','YOUR RECAPTCHA SECRET GOES HERE');

select * from sites;
