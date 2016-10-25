<?php
if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}
?>
<div class="admin-page-social">
	<div class="jem">
		<a href="http://jaggededgemedia.com/plugins/" target="_blank">
			<img class="aligncenter wp-image-121" id="jem-logo" title="Jagged Edge Media - Plugins"
			     alt="Jagged Edge Media - Plugins" width="230"
			     src="http://jaggededgemedia.com/wp-content/uploads/2013/05/cropped-logo-icon-lg-300x60.png"/>
		</a>

		<div style="clear:both;"></div>
		<div class="fb-like" data-href="https://www.facebook.com/JaggedEdgeMedia" data-send="true"
		     data-layout="button_count" data-width="450" data-show-faces="false" data-font="tahoma"></div>
	</div>
	<div class="twitter">
		<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/JaggedEdgeMedia"
		   data-widget-id="401196566704185346"><?php printf(
				__( 'Tweets by %s', 'post-list-featured-image' ),
				'@JaggedEdgeMedia'
			); ?></a>
		<script>!function ( d, s, id ) {
				var js, fjs = d.getElementsByTagName( s )[0], p = /^http:/.test( d.location ) ? 'http' : 'https';
				if ( !d.getElementById( id ) ) {
					js = d.createElement( s );
					js.id = id;
					js.src = p + "://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore( js, fjs );
				}
			}( document, "script", "twitter-wjs" );</script>
	</div>
	<div class="facebook">
		<div class="fb-like-box" data-href="http://www.facebook.com/jaggededgemedia" data-width="252" data-height="304"
		     data-show-faces="true" data-stream="false" data-show-border="false" data-header="false"></div>
	</div>
</div>
