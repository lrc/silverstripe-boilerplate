<?php
/**
 * Add some additional site wide configuration options.
 */
class SiteConfigDecorator extends DataObjectDecorator {

	/**
	 * Add some database variables
	 *
	 * @return array An array of new static variables for the SiteConfig class
	 */
	function extraStatics() {
		return array(
			'db' => array(
				'FooterContent' => 'HTMLText',
                'EmailFooterContent' => 'Text',
				'GA' => 'Text'
			)
		);
	}

	/**
	 * Display the additional fields in the admin area.
	 *
	 * @param FieldSet $fields The modified fieldset for site admin area.
	 */
	public function updateCMSFields(FieldSet $fields) {
		$fields->addFieldToTab("Root.Main", new HTMLEditorField("FooterContent", "Footer Copyright Block",5));
        $fields->addFieldToTab("Root.Main", new TextareaField("EmailFooterContent", "Email Footer Copyright Block",5));
		$fields->addFieldToTab("Root.Main", new TextField("GA", "Google Analytics ID"));
	}
}