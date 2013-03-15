<?php
global $project;
$project = 'mysite';

// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");

MySQLDatabase::set_connection_charset('utf8');

// Set default theme
SSViewer::set_theme('silverstripe-boilerplate-theme');

// Set the site locale & timezone
i18n::set_locale('en_AU');
date_default_timezone_set('Australia/Brisbane');

// Enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();

// Add the search feature for the website
FulltextSearchable::enable();

// Warnings and errors to log file we can access easily.
SS_Log::add_writer(new SS_LogFileWriter(dirname(__FILE__) . '/logs/errors-' . date('Ymd')), SS_Log::WARN, '<=');

// Improve default image quality for resized images.
GD::set_default_quality(90);

if (Director::isDev()) {
	SSViewer::flush_template_cache();
	Email::send_all_emails_to('${admin_email}');
}

if (Director::isTest()) {
	Email::send_all_emails_to('${admin_email}');
}

// Set default email address for admin
Email::setAdminEmail('${admin_email}');

// Configure some CMS interface defaults.
HtmlEditorConfig::get('cms')->insertButtonsBefore('bullist','sup','sub');
HtmlEditorConfig::get('cms')->setOption('content_css', Director::absoluteBaseURL() . '/themes/default/css/build/editor.css');
DateField::set_default_config('showcalendar', true);