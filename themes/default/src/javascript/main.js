/*
 * The site's main javascript file. Everything should stem from here with other scripts loaded dynamically using require.js
 */
;(function(window, undefined){
	
	// Define persistent variables here.

	// Kick everything off. $ = jQuery within this function.
	require(['jquery'], function($) {
		
		// Wait for the DOM
		$(function(){
			
			var $forms = $('form.validate'); // Forms that should be validated
			
			// If there are forms that need validating include the form js
			if ($forms.length) {
				require(['forms'], function(){
					$forms.validate();
				});
			}
			
		});
	});

}(window)); 