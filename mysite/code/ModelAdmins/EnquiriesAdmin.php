<?php

/**
 * A model admin which provides access to form enquiries.
 */
class EnquiriesAdmin extends ModelAdmin {	
	
	public static $managed_models = array(
		'ContactData'
	); 

	public static $menu_icon = 'mysite/images/icon-enquiries.png'; 
	public static $url_segment = 'enquiries'; // Linked as /admin/enquiries/
	public static $menu_title = 'Enquiries';  
}