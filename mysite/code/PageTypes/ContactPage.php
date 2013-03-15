<?php
class ContactPage extends Page 
{
	public static $description = 'A page with a generic contact form';
	public static $singlular_name = 'Contact Page';
	public static $plural_name = 'Contact Pages';

	public static $db = array (
		'ToEmail' => 'Varchar(500)',
		'SuccessTitle' => 'Varchar(300)',
		'SuccessMessage' => 'HTMLText'
	);
	
	public static $defaults = array(
		'SuccessTitle' => 'Thank you',
		'SuccessMessage' => '<p>Thank you for your enquiry.</p>'
	);
	
	/**
	 * Add some fields to the CMS
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->insertAfter( 
			HtmlEditorField::create(
				'SuccessMessage', 
				'Message to display to users on successful submission of the contact form'
			)->addExtraClass('stacked'), 'Content' );
		$fields->insertAfter( 
			TextField::create(
				'SuccessTitle', 
				'Title for success message screen'
			), 'Content' );
		return $fields;
	}
	
	/**
	 * Modify the settings screen.
	 * @return FieldList
	 */
	public function getSettingsFields() 
	{
		$fields = parent::getSettingsFields();
		$fields->push(
			TextField::create('ToEmail', _t('ContactPage.NotificationsLabel', 'Notifications email'))
				->setRightTitle(_t(
					'ContactForm.NotificationsHelp', 
					'Where should enquiries be sent? Separate multiple addresses with a comma.'
				))
		);
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
			"Title" => $this->SuccessTitle,
			"Content" => $this->SuccessMessage,
			"Form" => ''
		);
		return $this->customise($data);
	}
}