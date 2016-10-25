<?php
if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}
?>
<div id="fb-root"></div>
<script>
	(function ( d, s, id ) {
		var js, fjs = d.getElementsByTagName( s )[0];
		if ( d.getElementById( id ) ) {
			return;
		}
		js = d.createElement( s );
		js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=404710116249124";
		fjs.parentNode.insertBefore( js, fjs );
	}( document, 'script', 'facebook-jssdk' ));
</script>
<div id="plugin-admin-page" class="wrap">
	<h2><?php printf( __( '%s: Settings', 'post-list-featured-image' ), $plugin->Name ); ?></h2>
	<?php
	if ( !current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="updated settings-error" id="setting-error-settings_updated" style="display: none;"></div>
	<div id="dashboard-widgets-container" class="post-list-featured-image-dashboard">
		<div id="dashboard-widgets" class="metabox-holder">
			<div id="post-body">
				<div id="dashboard-widgets-main-content">
					<div id="main-container" class="postbox-container" style="width: 75%;">
						<?php if ( !empty( $tabs ) ) { ?>
							<div id="tabs">
								<ul>
									<?php foreach ( $tabs as $tab ) : ?>
										<?php if ( !empty( $tab['template'] ) ) : ?>
											<li><a href="<?php echo $tab['href']; ?>"><?php echo $tab['title']; ?></a>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>

								<?php foreach ( $tabs as $tab ) : ?>
									<?php if ( !empty( $tab['template'] ) ) : ?>
										<div id="<?php echo $tab['id'] ?>">
											<?php include_once( $tab['template'] ); ?>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php } ?>
						<?php do_meta_boxes( 'post_list_featured_image_dashboard_main', 'left', $object ); ?>
					</div>
					<div id="sidebar-container" class="postbox-container" style="width: 24%;">
						<?php do_meta_boxes( 'post_list_featured_image_dashboard_sidebar', 'right', $object ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
