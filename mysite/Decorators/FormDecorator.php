<?php
/**
 * Provide some additional Form methods for use in custom form templates.
 */
class FormDecorator extends Extension {

	/**
	 * Get a count of errors for this form object.
	 *
	 * @return int Count of errors for this form.
	 */
	public function Errors() {
		$count = 0;
		foreach ($this->owner->fields as $field) {
			if ($field->Message()) {
				$count++;
			}
			// Check for child fields
			if ($field->children) {
				foreach ($this->owner->fields as $child) {
					if ($child->Message()) {
						$count++;
					}
				}
			}
		}
		return $count;
	}

}