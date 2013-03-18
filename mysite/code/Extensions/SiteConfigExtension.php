<?php
/**
 * Add some additional site wide configuration options.
 */
class SiteConfigExtension extends DataExtension {

	/**
	 * Add some database variables
	 *
	 * @return array An array of new static variables for the SiteConfig class
	 */
	public static $db = array(
		'GA' => 'Text'
	);

	/**
	 * Display the additional fields in the admin area.
	 *
	 * @param FieldSet $fields The modified fieldset for site admin area.
	 */
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root.Main", new TextField("GA", "Google Analytics ID"));
	}
}