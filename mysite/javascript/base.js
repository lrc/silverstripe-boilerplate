// Fire up the JS
var base = function($){

	$(function(){

	});

	// Some public functions that are used site wide.
	return {
		invalidHandler : function(e, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {

				if ( !$('form p.error').length ) {
					$('<p class="message error">').hide().prependTo(validator.currentForm);
				}

				var message = errors == 1
						? "You missed 1 field. It has been highlighted below"
						: "You missed " + errors + " fields.  They have been highlighted below.";
				$("form p.error").html(message).show();
			} else {
				$("form p.error").remove();
			}
		}
	}

}(jQuery);