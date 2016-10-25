<?php
if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}
?>
<div id="help-wrapper">
	<div id="help-container">
		<?php
		if ( !empty( $help_content ) ) {
			foreach ( (array) $help_content as $help ) {
				?>
				<h3><?php echo $help['header']; ?></h3>
				<div><?php echo $help['content']; ?></div>
			<?php
			}
		}
		?>
		
		<?php do_action( 'post_list_featured_image_help' ); ?>
	</div>
</div>
