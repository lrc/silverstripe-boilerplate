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

		$fields->addFieldToTab('Root.Behaviour', new CheckboxField($name = 'InFooter', $title = 'Show in footer?' ), 'ProvideComments');
		$fields->addFieldToTab('Root.Behaviour', new CheckboxField($name = 'InSitemap', $title = 'Show in sitemap?' ), 'ProvideComments');
		$fields->addFieldToTab('Root.Content.Excerpts', new ImageField('ImageExcerpt', 'Image excerpt for this page'));
		$fields->addFieldToTab('Root.Content.Excerpts', new TextareaField('TextExcerpt', 'Text excerpt for this page'));

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

		// Add the default page javascript
		Stack::add( 'header_javascript', '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', 'jquery-cdn' );
		Stack::add( 'header_javascript', '!window.jQuery && document.write(\'<script src="../../mysite/javascript/jquery/jquery.min.js"><\/script>\')', 'jquery','jquery-cdn' );
		
		Stack::add( 'footer_javascript', Director::absoluteBaseURL() . MY_SITE_DIR . '/javascript/base.js', 'base' );

		// Add default page JS for lt IE 9 conditionals.
		Stack::add( 'header_javascript_html5shiv', Director::absoluteBaseURL() . MY_SITE_DIR . '/javascript/html5.js', 'html5' );
		Stack::add( 'header_javascript_ltie9', Director::absoluteBaseURL() . MY_SITE_DIR . '/javascript/selectivizr.js', 'selectivizr' );

		// Add default style sheets
		Stack::add( 'theme_styles', array(Director::absoluteBaseURL() . 'themes/' . SSViewer::current_theme() . '/css/layout.css' , 'all' ), 'layout', 'base' );
		Stack::add( 'theme_styles', array(Director::absoluteBaseURL() . 'themes/' . SSViewer::current_theme() . '/css/form.css' , 'all' ), 'form', 'base' );
		Stack::add( 'theme_styles', array(Director::absoluteBaseURL() . 'themes/' . SSViewer::current_theme() . '/css/print.css' , 'print' ), 'print', 'base' );

		Requirements::set_write_js_to_body(false);

		// Disable SilverStripe's Prototype validation
		Validator::set_javascript_validation_handler('none');
	}

	/**
	 * Get the top level ancestor of a page.
	 */
	public function RootAncestor() 
	{

		$parent = $this->Parent();
		if ( $parent->ID == 0 ) {
			return $this;
		}

		while ( $parent->Parent()->ID != 0 ) {
			$parent = $parent->Parent();
		}

		return $parent;	
	}

	/**
	 * Footer Menu
	 */
	public function FooterMenu()
	{
		return DataObject::get( 'SiteTree', '"InFooter" = 1 AND "ParentID" = 0' );
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
	
	/**
	 * Manually change the template used for display on the home page.
	 */
	public function index() {
		if ($this->IsHome()) {
			return $this->renderWith(array('Page_home', 'Page'));
		}
		return $this;
	}
}