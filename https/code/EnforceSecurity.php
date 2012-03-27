<?php

class EnforceSecurity extends DataObjectDecorator {
	
	public function contentcontrollerInit() {
		// Go back to HTTP from HTTPS if this isn't secure.
		if ( ! method_exists($this->owner, 'IsSecure') || ! $this->owner->IsSecure() ) {
			$this->force_HTTP();
		}
	}
	
	/**
	 * Ensure this page is loaded using HTTP rather than HTTPS
	 */
    public function force_HTTP() {
        $page_url    = Director::absoluteURL( $_SERVER['REQUEST_URI'] );
        if ( $page_url !== $new_url = preg_replace( '{^https:}', 'http:', $page_url ) ) {
            Director::redirect($new_url);
        }
    }
	
}