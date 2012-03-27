<?php
global $project;
$project = 'mysite';

// Path used for site directory
define('MYSITE_DIR', $project );
Director::set_dev_servers(array('localhost', 'dev-<project_name>','dev-<project_name>:8080'));
Director::set_test_servers(array('staging.<project_name>'));

// DB config is in a separate non-versioned file (which you will need to create)so devs are free to commit config changes without disturbing database connection details.
require_once dirname(__FILE__) . '/_db.php';

MySQLDatabase::set_connection_charset('utf8');

// Set default theme
SSViewer::set_theme('default');

// Set the site locale
i18n::set_locale('en_AU');

// Enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();

// Set default admin username and password
Security::setDefaultAdmin('admin', '<admin_pass>');

// Add the search feature for the website
FulltextSearchable::enable();

// Warnings and errors to log file we can access easily.
SS_Log::add_writer(new SS_LogFileWriter(dirname(__FILE__) . '/logs/errors-' . date('Ymd')), SS_Log::WARN, '<=');

// Add some decorators to improve some core functionality.
Object::add_extension('SiteConfig', 'SiteConfigDecorator');
Object::add_extension('FormField', 'FormFieldDecorator');
Object::add_extension('Form', 'FormDecorator');

// Improve default image quality for resized images.
GD::set_default_quality(90);

if (Director::isDev()) {
	SSViewer::flush_template_cache();
	Email::send_all_emails_to('<developer_email>');
}

if (Director::isTest()) {
	Email::send_all_emails_to('<developer_email>');
}

// Set default email address for admin
Email::setAdminEmail('<developer_email>');

// Configure the CMS editor
HtmlEditorConfig::get('cms')->insertButtonsBefore('bullist','sup','sub');

// For some reason DOM adds the SortableDataObject decorator to the files table
// which is a real problem when there are a large number of files in the database
// This removes that...for now.
SortableDataObject::remove_sortable_class('File');