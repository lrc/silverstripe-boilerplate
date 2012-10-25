<?php
class ContactPage extends Page 
{
	
	public static $singlular_name = 'Contact Page';
	public static $plural_name = 'Contact Pages';
	
	public static $description = 'A page with a generic contact form';

	public static $db = array (
		'ToEmail' => 'Varchar(500)',
		'SuccessMessage' => 'HTMLText'
	);
	
	/**
	 * Add some fields to the CMS
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->insertAfter( HtmlEditorField::create('SuccessMessage', 'Message to display to users on successful submission of the contact form')->addExtraClass('stacked'), 'Content' );
		return $fields;
	}
	
	/**
	 * Modify the settings screen.
	 * @return FieldList
	 */
	public function getSettingsFields() 
	{
		$fields = parent::getSettingsFields();
		$fields->push( TextField::create('ToEmail', 'Where should enquiries be sent?') );
		return $fields;
	}
}

/**
 * Controller which handles contact page reqeusts
 */
class ContactPage_Controller extends Page_Controller 
{
	/**
	 * The contact form
	 */
	public function Form() {
		return ContactForm::create($this, 'Form');
	}
	
	/**
	 * Handle the success action on successful form submission.
	 */
	public function success() {
		$data = array(
			"Content" => $this->SuccessMessage,
			"Form" => ""
		);
		return $this->customise($data);
	}
}