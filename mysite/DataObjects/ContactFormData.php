<?php 
class ContactFormData extends DataObject
{
	static $db = array(
		'FirstName' => 'Varchar(255)',
		'LastName' => 'Varchar(255)',
		'Email' => 'Varchar(255)',
		'Phone' => 'Varchar(20)',
		'Message' => 'Text',
		'EnquiryType' => 'Varchar(300)'
	);
	
	static $plural_name = 'Contacts';	
	static $singular_name = 'Contact';
	static $default_sort = 'Created DESC';
	
	static $searchable_fields = array(
        'FirstName',
		'LastName',
		'Email'
	);
	
	static $summary_fields = array(
        'FirstName',
		'LastName',
		'Email',
		'Created'
	);
	
	static $csv_fields = array(	
		'FirstName',
        'LastName',
		'Phone',
		'Email',
		'EnquiryType',
		'Message'
	);
}