<?php

/**
 * A model admin which provides access to form responses.
 */
class FormResponsesAdmin extends ModelAdmin {	
	
	public static $managed_models = array(
		'ContactData'
	); 

	public static $url_segment = 'forms'; // Linked as /admin/forms/
	public static $menu_title = 'Form Responses';  
}