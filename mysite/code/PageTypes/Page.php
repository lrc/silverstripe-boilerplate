<?php
class Page extends SiteTree 
{

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

		$fields->addFieldToTab('Root.Excerpts', new UploadField('ImageExcerpt', 'Image excerpt for this page'));
		$fields->addFieldToTab('Root.Excerpts', new TextareaField('TextExcerpt', 'Text excerpt for this page'));

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
	
	public function init() 
	{
		parent::init();
		
		// Provide the opportunity to set themes via the URL.
		if ( isset($_GET['settheme']) ) {
			$_SESSION['theme'] = $_GET['settheme'];
		}
		if ( isset($_GET['theme']) || isset($_SESSION['theme']) ) {
			$theme = (isset($_GET['theme'])) ? $_GET['theme'] : $_SESSION['theme'];
			SSViewer::set_theme($theme);
		}
	}

	/**
	 * Footer Menu
	 */
	public function FooterMenu()
	{
		return DataObject::get( 'Page', '"InFooter" = 1 AND "ParentID" = 0' );
	}
	
	/**
	 * Test if the current page is the homepage for the current domain.
	 * 
	 * @return boolean True if this page is the homepage for the current domain.
	 */
	public function IsHome() 
	{
		$domains = explode(',', $this->HomepageForDomain);
		if (isset($_SERVER['HTTP_HOST']) ) 
		{
			foreach ($domains as $domain) 
			{
				if (trim($domain) == $_SERVER['HTTP_HOST']) return true;
			}
		}
		return false;
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