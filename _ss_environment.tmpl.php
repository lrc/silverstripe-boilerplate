<?php
/* What kind of environment is this: development, test, or live (ie, production)? */
define('SS_ENVIRONMENT_TYPE', 'dev');
 
/* Database connection */
global $database;
define('SS_DATABASE_SERVER', '${dbhost}');
define('SS_DATABASE_USERNAME', '${dbuser}');
define('SS_DATABASE_PASSWORD', '${dbpass}');
define('SS_DATABASE_NAME', '${dbname}');
$database = SS_DATABASE_NAME;

/* Configure a default username and password to access the CMS on all sites in this environment. */
define('SS_DEFAULT_ADMIN_USERNAME', '${admin_email}');
define('SS_DEFAULT_ADMIN_PASSWORD', '${admin_pass}');