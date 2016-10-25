<?php

$Data = $this->get_data( 'user_role' );
$UserRoles = $this->get_user_role();

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>
<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Reset Settings' , 'wp-admin-ui-customize' ); ?></h2>
	<p>&nbsp;</p>

	<form id="wauc_reset_userrole" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="user_role" />

		<h3><?php _e( 'Applied user roles' , 'wp-admin-ui-customize' ); ?></h3>
		<ul class="description">
			<?php foreach( $Data as $key => $val ) : ?>
				<?php if( !empty( $UserRoles[$key] ) ): ?>
					<li><?php echo $UserRoles[$key]["label"]; ?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<br />

		<p><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'User Roles Settings' , 'wp-admin-ui-customize' ) ); ?></p>
		<p class="submit">
			<input type="submit" class="button-primary" name="reset" value="<?php _e( 'Reset User Roles Settings' , 'wp-admin-ui-customize' ); ?>" />
		</p>

	</form>
	
	<p>&nbsp;</p>

	<h2><?php _e( 'Reset all settings' , 'wp-admin-ui-customize' ); ?></h2>
	<form id="wauc_reset_all_settings" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="all_settings" />
		<p><?php _e( 'All settings below will be deleted.' , 'wp-admin-ui-customize' ); ?></p>
		<ul class="description">
			<li><?php _e( 'Frontend' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php printf( __( '%1$s %2$s' , 'wp-admin-ui-customize' ) , __( 'General' ) , __( 'Settings' ) ); ?></li>
			<li><?php _e( 'Dashboard' ); ?></li>
			<li><?php _e( 'Admin bar' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php _e( 'Sidebar' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php _e( 'Meta boxes' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php _e( 'Posts and Pages' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php _e( 'Appearance Menus' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php _e( 'Login Form' , 'wp-admin-ui-customize' ); ?></li>
			<li><?php printf( __( '%1$s of %2$s %3$s' , 'wp-admin-ui-customize' ) , __( 'Change' ) , __( 'Plugin' ) , __( 'Capabilities' ) ); ?></li>
		</ul>
		<br />

		<p><?php _e( 'Are you sure you want to delete all settings?' , 'wp-admin-ui-customize' ); ?></p>
		<p class="submit">
			<input type="submit" class="button-primary" name="reset" value="<?php _e( 'Reset all settings' , 'wp-admin-ui-customize' ); ?>" />
		</p>

	</form>

</div>

<style>
</style>
<script>
jQuery(document).ready( function($) {

});
</script>
