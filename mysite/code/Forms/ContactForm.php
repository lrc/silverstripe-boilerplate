<?php

/**
 * A generic contact form ready for customisation.
 */
class ContactForm extends Form {	
	
	/**
	 * Construct it
	 * @param RequestHandler $controller The controller handling this request
	 * @param string $name The name of the form
	 */
	public function __construct($controller, $name) {				
		// Setup the fields
		$fields = new FieldList();
		$fields->add($nameField = TextField::create('Name', _t('ContactForm.Name', 'Name', 'The name field label in a contact form.'), "", 80));
		$fields->add($phoneField = TextField::create('Phone', _t('ContactForm.Telephone', 'Telephone', 'The telephone field label in a contact form.'), "", 20));
		$fields->add($emailField = EmailField::create('Email', _t('ContactForm.Email', 'Email', 'The email field label in a contact form.'), "", 255));
		$fields->add(new TextareaField('Message', _t('ContactForm.Message', 'Message', 'The message field label in a contact form.')));
		
		// Setup required field validator
		$required = array(
			'Name',
			'Phone',
			'Email',
			'Message'
		);
		
		// Setup classes for validator
		foreach ($required as $field) {
			$field = $fields->dataFieldByName($field);
			$field->addExtraClass('required'); // Add class for JS validation
			$field->setTitle(preg_replace('/(.*)\*?$/iU', '$1 *', $field->Title(), 1)); // Add an asterik to the label
		}
		$fields->dataFieldByName('Email')->addExtraClass('email');
		
		// Create validator on server 
		$validator = new RequiredFields($required);
		$validator->useLabels(false);
		
		// Create the action
		$actions = new FieldList();
		$actions->add(new LiteralField('RequiredFields', '<div class="required">* Required</div>'));
		$send = FormAction::create('send', 'Send')
			->addExtraClass('btn btn-green')
			->setButtonContent('<i class="icon icon-right"></i>Send');
		$send->useButtonTag = true;
		$actions->add($send);
		
		// Add form css class to Contact Form
		$this->addExtraClass('form validate');
		
		$member = Member::currentUser();
		if ($member) {
			$nameField->setValue($member->Name);
			$phoneField->setValue($member->Phone);
			$emailField->setValue($member->Email);
		}

		parent::__construct($controller, $name, $fields, $actions, $validator);				
	}	
	
	/**
	 * Override the validate function so we can set a form level error messages as 
	 * well as the field level messages set in the Validator.
	 * @return boolean
	 */
	function validate(){
		if (!parent::validate()) {
			// Set the form message	
			$message = _t(
				'ContactForm.ErrorMessage',
				'It appears you have not entered the correct information. Please complete the highlighted fields and re-submit, thank you.',
				'The generic form level error message displayed when server side validation fails.'
			);
			$this->sessionMessage($message, 'error');
			return false;
		}
		return true;
	}
	
	/**
	 * Send Email 
	 */
	public function send($data, $form, $request){
		
		// Get and validate the to email addresses
		$to = $this->controller->ToEmail;
		$to = trim(str_replace(',', ';', $to));
		
		
		// Save the contact enquiry
		$contactData = ContactData::create();
		$form->saveInto($contactData);
		
		// Email title
		$title = _t('ContactForm.EmailSubject', 'New website enquiry', 'The subject line for notification emails sent when form is submitted.');
		
		// Write to database
		$contactData->write();

		// Send email
		if ( !empty($to) ) {
			$email = new Email();
			$email->To = $to;
			$email->From = $data['Email'];
			$email->Subject = $title;
			$email->setTemplate('ContactFormNotification');
			$email->populateTemplate($contactData);
			$email->send();
		}

		// Redirect to thank you page
		$this->controller->redirect('success');
	}
}