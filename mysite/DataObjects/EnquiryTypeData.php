<?php 
class EnquiryTypeData extends DataObject
{
	static $db = array(
		'Name' => 'Varchar(255)',
		'DestinationEmail' => 'Varchar(255)'
	);

	static $has_one = array(
		"ContactForm" => "ContactForm"
	);
	
	static $plural_name = 'Enquiry Types';	
	static $singular_name = 'Enquiry Type';	
	
	/**
	 * Remove sort order which is added by default.
	 */
	public function getCMSFields($params = null) {
		$fields = parent::getCMSFields($params);
		$fields->removeByName('SortOrder');
		return $fields;
	}
	
}