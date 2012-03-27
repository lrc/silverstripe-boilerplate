<?php

/**
 * Setup some additional form field methods for use by the custom form templates.
 */
class FormFieldDecorator extends Extension {

	/**
	 * Check if this field has data
	 *
	 * @return bool True if the field has data
	 */
	public function Dataless() {
		return !$this->owner->hasData();
	}

	/**
	 * Check if this field is an instance of CheckboxField
	 * @return bool	True if the field is a checkbox field.
	 */
	public function IsCheckbox() {
		return ($this->owner instanceof CheckboxField);
	}


}