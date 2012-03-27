<?php
/**
 * Provide an admin interface for browsing/editing form submission data. *
 */
class AdminForms extends ExtendedModelAdmin {

	public static $managed_models = array(
		'ContactFormData'
	);

	static $url_segment = 'forms'; // will be linked as /admin/forms

	static $menu_title = 'Forms';

	static $model_importers = array();

	public static $collection_controller_class = "AdminForms_CollectionController";
}

/**
 * Define the controller clas so we can remove the add form.
 */
class AdminForms_CollectionController extends ExtendedModelAdmin_CollectionController {
	/**
	 * Return false so no add form is displayed.
	 * @return bool false
	 */
	public function CreateForm() {return false;}
	
	
}