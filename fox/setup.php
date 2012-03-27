<?php
/*
 * Run a bunch of automatic setup stuff.
 */

// Die a silent death if this isn't a CLI call
if (php_sapi_name() !== 'cli') die;

define('ROOT', dirname(__file__) . '/..');

@list($script, $project, $dbname, $dbuser, $dbpass, $dbtype, $dbhost) = $argv;

// At the very least we need a project name to keep going
if ( empty($project) ) die('No project name supplied.');

// Put in place some defaults
if ( empty($dbuser) ) $dbuser = 'dev';
if ( empty($dbname) ) $dbname = $project;
if ( empty($dbpass) ) $dbpass = 'w1nd0w';
if ( empty($dbtype) ) $dbtype = 'MySQL';
if ( empty($dbhost) ) $dbhost = 'localhost';

// Setup the config file
$conf_tmp  = ROOT . '/mysite/_config.tmp.php';
$conf_new = ROOT . '/mysite/_config.php';
if ( file_exists($conf_new) ) // Never overwrite the config file. Ever.
{ 
	echo "Config file already exists. \n";
}
else
{
	$conf = @file_get_contents($conf_tmp);
	if ( $conf === false ) 
	{
		echo "Could not find $conf_tmp \n";
	}
	else
	{
		$conf = str_replace('<project_name>', $project, $conf);
		$conf = str_replace('<admin_pass>', substr(md5(rand().microtime().rand()),0,9), $conf);
		if ( false === @file_put_contents($conf_new, $conf) ){
			echo "Could not write $conf_new \n";
		}
	}
}

// Setup the DB file
$db_tmp = ROOT . '/mysite/_db.tmp.php';
$db_new = ROOT . '/mysite/_db.php';
if ( file_exists($db_new) ) 
{ // Never overwrite the db file. Ever.
	echo "Database file already exists. \n";
} 
else 
{
	$db = @file_get_contents($db_tmp);
	if ( $db === false ) 
	{
		echo "Could not find $db_tmp \n";
	}
	else
	{
		$db = str_replace('<dbuser>', $dbuser, $db);
		$db = str_replace('<dbtype>', $dbtype, $db);
		$db = str_replace('<dbpass>', $dbpass, $db);
		$db = str_replace('<dbhost>', $dbhost, $db);
		$db = str_replace('<dbname>', $dbname, $db);
		if ( false === @file_put_contents($db_new, $db)) {
			echo "Could not write $db_new \n";
		}
	}
}
