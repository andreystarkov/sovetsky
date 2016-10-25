jQuery(document).ready(function($) {

	$(document).on('click', '.wauc_form .handlediv', function() {
		
		$(this).parent().toggleClass('closed');
		return false;

	});

});
