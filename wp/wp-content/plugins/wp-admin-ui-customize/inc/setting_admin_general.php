<?php

$Data = $this->get_data( 'admin_general' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' , 'thickbox' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style('thickbox');
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php printf( __( '%1$s %2$s' , 'wp-admin-ui-customize' ) , __( 'General' ) , __( 'Settings' ) ); ?></h2>
	<p>&nbsp;</p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_admin_general" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="admin_general" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">
					<div id="admin_general">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo _e( 'Notifications' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<tr>
											<th>
												<label><?php _e( 'WordPress core updates' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $field = 'notice_update_core'; ?>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide notifications' , 'wp-admin-ui-customize' ); ?></label>
											</td>
										</tr>
										<tr>
											<th>
												<label><?php _e( 'Plugin updates' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $field = 'notice_update_plugin'; ?>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide notifications' , 'wp-admin-ui-customize' ); ?></label>
											</td>
										</tr>
										<tr>
											<th>
												<label><?php _e( 'Theme updates' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $field = 'notice_update_theme'; ?>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide notifications' , 'wp-admin-ui-customize' ); ?></label>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
			
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo _e( 'Screen Options and Help Tab' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<tr>
											<th>
												<label><?php _e( 'Screen Options' ); ?></label>
											</th>
											<td>
												<?php $field = 'screen_option_tab'; ?>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
											</td>
										</tr>
										<tr>
											<th>
												<label><?php _e( 'Help' ); ?></label>
											</th>
											<td>
												<?php $field = 'help_tab'; ?>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
			
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo _e( 'Footer' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<tr>
											<th>
												<label><?php _e( 'Footer text' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $field = 'footer_text'; ?>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = esc_html( stripslashes( $Data[$field] ) ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="large-text" />
												<p class="description"><?php _e( 'Default' ); ?>: <?php _e( 'Thank you for creating with <a href="%s">WordPress</a>.' ); ?></p>
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
			
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'General' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'css'; ?>
										<tr>
											<th>
												<label><?php _e( 'CSS file to load' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text">
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
											</td>
										</tr>
										<?php $field = 'title_tag'; ?>
										<tr>
											<th>
												<label><?php _e( 'Admin screen' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Remove "Wordpress" from title tag' , 'wp-admin-ui-customize' ); ?></label>
											</td>
										</tr>
										<?php $field = 'resize_admin_bar'; ?>
										<tr>
											<th>
												<label><?php _e( 'Admin bar' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Disable resizing' , 'wp-admin-ui-customize' ); ?></label>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<br class="clear">

			</div>

		</div>

		<p class="submit">
			<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
		</p>

		<p class="submit reset">
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , sprintf( __( '%1$s %2$s' , 'wp-admin-ui-customize' ) , __( 'General' ) , __( 'Settings' ) ) ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e( 'Reset settings' , 'wp-admin-ui-customize' ); ?>" />
		</p>

	</form>

</div>

<?php require_once( dirname( __FILE__ ) . '/list_variables.php' ); ?>

<style>
</style>
<script>
jQuery(document).ready( function($) {

});
</script>
