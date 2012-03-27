<?php

/**
 * This abstract class provides generic validation functions for all forms. It
 * should be used in place of the RequiredFields validator which only validates
 * required fields.
 */
abstract class GenericValidator extends Validator {

	protected $required;

	/**
	 * Setup the validation class.
	 *
	 * @param array $args An array specifying validation methods to apply to fields.
	 */
	public function  __construct($args) {
		// Setup the required fields
		if ( isset( $args['required']) && is_array($args['required']) ){
			$this->required = $args['required'];
		}

		// Call the parent constructor (there's no need to pass an arguement from here)
		parent::__construct();
	}

	/**
	 * Check the max length requirement.
	 *
	 * @todo This somehow fails on EmailField types. Needs fixing.
	 *
	 * @param FormField $field The form field object being tested
	 * @param array $data The form data submitted.
	 * @return bool True if field (and all child fields) pass the max length test
	 */
	private function max_length($field, $data) {
		Debug::dump($field->Name());
		$valid = true;
		if ( method_exists($field, 'getMaxLength') && $field->getMaxLength() ) {
			Debug::dump($field->getMaxLength());

			if ( $field->getMaxLength() < strlen( $data[$field->Name()] ) ) {
				$this->validationError(
					$field->Name(),
					'Input exceeds the maximum length allowed.',
					"error"
				);
				$valid = false;
			}
		}

		// Do field children
		if ( method_exists($field, 'getChildren') ) {
			foreach ($field->getChildren() as $child) {
				$valid = ($valid && $this->max_length($child, $data));
			}
		}
		
		//if ($field->Name() == 'SecurityCode') die;
		return $valid;
	}

	/**
	* Apply default validation (required fields and field type validation).
	*/
	function php($data) {
		$valid = true;
		
		// Validate based on individual field type validation functions.
		$fields = $this->form->Fields();
		foreach($fields as $field) {
			$valid = ($field->validate($this) && $valid);

			// Do field lengths while we're here
			// This doesn't work and I don't have time to make it work.
			//$valid = ($valid && $this->max_length($field, $data));
		}

		// Validate required
		if($this->required) {
			foreach($this->required as $fieldName) {
				$formField = $fields->dataFieldByName($fieldName);

				$error = true;
				// submitted data for file upload fields come back as an array
				$value = isset($data[$fieldName]) ? $data[$fieldName] : null;
				if(is_array($value)) {
					$error = ($value) ? false : true;
				} else {
					if ($formField instanceof CheckboxField) {
						$error = ($value == 0);
					} else {
						// assume a string or integer
						$error = (strlen($value)) ? false : true;
					}
				}

				if($formField && $error) {
					if($msg = $formField->getCustomValidationMessage()) {
						$errorMessage = $msg;
					} else {
						$errorMessage = sprintf(_t('Form.FIELDISREQUIRED', '%s is required').'.', strip_tags('"' . ($formField->Title() ? $formField->Title() : $fieldName) . '"'));
					}

					$this->validationError(
						$fieldName,
						$errorMessage,
						"required"
					);
					$valid = false;
				}
			}
		}
		return $valid;
	}
}