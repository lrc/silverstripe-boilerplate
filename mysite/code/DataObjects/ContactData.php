<?php

/**
 * Contact form data.
 */
class ContactData extends DataObject 
{
	public static $singlular_name = 'Contact Form Enquiries';
	public static $plural_name = 'Contact Form Enquiry';
	
	public static $db = array(
		'Name' => 'Varchar(80)',
		'Phone' => 'Varchar(20)',
		'Email' => 'Varchar(255)',
		'Message' => 'Text'
	);
	
	public static $summary_fields = array('Name','Phone','Email');
	public static $default_sort = 'Created DESC';
	
}
