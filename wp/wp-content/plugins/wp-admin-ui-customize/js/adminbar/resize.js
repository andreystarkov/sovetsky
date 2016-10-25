jQuery(document).ready(function($){

	var ResizeTimer = false;

	$(window).resize(function() {
		if (ResizeTimer !== false) {
			clearTimeout(ResizeTimer);
		}
		ResizeTimer = setTimeout(function() {
			sidebar_resize();
		}, 200);
	});
	
	function sidebar_resize() {
		var AdminBarHeight = $("#wpadminbar").height();
		var WindowWidth = $(window).width();
		if( WindowWidth > 600 ) {
			$("#adminmenu").css("top", 0);
			$("#wpbody").css("padding-top", 0);
		} else {
			$(".auto-fold #adminmenu").css("top", AdminBarHeight);
			$(".auto-fold #wpbody").css("padding-top", AdminBarHeight);
		}
	}

	sidebar_resize();

});
