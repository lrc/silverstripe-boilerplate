<?php
class Page extends SiteTree 
{
	public static $description = 'A standard page.';
	public static $singular_name = 'Standard Page';
	public static $plural_name = 'Standard Pages';

	public static $db = array(
		'InFooter' => 'Boolean',
		'InSitemap' => 'Boolean',
		'TextExcerpt' => 'Text',
	);

	static $has_one = array(
		'ImageExcerpt'=>'Image',
	);

	function  getCMSFields() 
	{
		$fields = parent::getCMSFields();
		
		$excerptsGroup = ToggleCompositeField::create('ExcerptsGroup', 'Content Summary',
			array(
				UploadField::create('ImageExcerpt', 'Image excerpt for this page'),
				TextareaField::create('TextExcerpt', 'Text excerpt for this page')
			)
		)->setHeadingLevel(4);
		$fields->insertBefore($excerptsGroup, 'Content');

		return $fields;
	}
	
	/**
	 * Modify the settings screen.
	 * @return FieldList
	 */
	public function getSettingsFields() 
	{
		$fields = parent::getSettingsFields();
		
		$fields->insertAfter( new CheckboxField('InSitemap', 'Show in sitemap?'), 'ShowInSearch');
		$fields->insertAfter( new CheckboxField('InFooter', 'Show in footer?'), 'ShowInSearch');
		
		return $fields;
	}
}

class Page_Controller extends ContentController 
{

	/**
	 * Footer Menu
	 */
	public function FooterMenu()
	{
		return Page::get()->filter(array('InFooter' => true, 'ParenteID' => 0));
	}
	
	/**
	 * Give the templates access to the live mode flag.
	 *
	 * @return boolean
	 */
	public function IsLive() 
	{
		return Director::isLive();
	}
	
	/**
	 * Search Form Request
	 */
	function results($data, $form){
		$data = array(
            'Results' => $form->getResults(),
            'Query' => $form->getSearchQuery(),
            'Title' => 'Search Results',
            'MenuTitle' => 'Search Results',
			'ResultsPage' => 'true'
        );
        $this->Query = $form->getSearchQuery();

		// TODO: Should this really return this? Maybe make it a blank page object.
        return $this->customise($data)->renderWith(array('Page_results', 'Page'));
    }
	
}