<?php
/* 
 * Custom Class for site forms to extend
 *
 * This class is required to properly display server site summary errors.
 */

class CustomForm extends Form {
	/**
	 * Ensure the site config is accessible from the Form template.
	 */
	function getSiteConfig() {
		$altConfig = false;
		if($this->hasMethod('alternateSiteConfig')) {
			$altConfig = $this->alternateSiteConfig();
		}
		if($altConfig) {
			return $altConfig;
		} elseif($this->hasExtension('Translatable')) {
			 return SiteConfig::current_site_config($this->Locale);
		} else {
			return SiteConfig::current_site_config();
		}
	}

	/**
	 * Set the form (as opposed to field) specific error message if there were
	 * any validation errors. This is very important for server side validation
	 * where there is no JS available.
	 *
	 * @return bool TRUE if there were no validation errors FALSE otherwise.
	 */
	public function validate() {
		if (!parent::validate()) {
			// Set the form message
			$count = count($this->validator->getErrors());
			$message = "You missed $count fields been highlighted below.";
			$this->sessionMessage($message, 'error');
			return false;
		}
		return true;
	}
}

?>
