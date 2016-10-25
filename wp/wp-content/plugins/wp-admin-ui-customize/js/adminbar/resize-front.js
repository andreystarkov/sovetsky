jQuery(document).ready(function($){

	var ResizeTimer = false;
	var DefaultBodyPaddingTop = parseInt( $(document.body).css('padding-top'), 10);

	$(window).resize(function() {
		if (ResizeTimer !== false) {
			clearTimeout(ResizeTimer);
		}
		ResizeTimer = setTimeout(function() {
			sidebar_resize();
		}, 200);
	});
	
	function sidebar_resize() {
		
		if( 0 < $("#wpadminbar").size() ) {
			var AdminBarHeight = $("#wpadminbar").height();
			var WindowWidth = $(window).width();
			
			if( AdminBarHeight < 47 ) {
				$(document.body).css("padding-top", DefaultBodyPaddingTop);
			} else {
				$(document.body).css("padding-top", ( AdminBarHeight / 2 ) );
			}

		}

	}

	sidebar_resize();

});
