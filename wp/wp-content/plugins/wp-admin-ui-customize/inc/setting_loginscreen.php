<?php

$Data = $this->get_data( 'loginscreen' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' , 'thickbox' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style('thickbox');
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Login Form' , 'wp-admin-ui-customize' ); ?></h2>
	<p>&nbsp;</p>

	<form id="wauc_setting_loginscreen" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="loginscreen" />

		<?php if( is_multisite() ) : ?>
			<p class="description"><?php _e( 'Is not possible to check the login form if you do not log out in the case of MultiSite.' , 'wp-admin-ui-customize' ); ?></p>
		<?php endif; ?>
		<p><a title="<?php _e( 'Login Screen' , 'wp-admin-ui-customize' ); ?>" href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?TB_iframe=1&width=520&height=520" class="thickbox button button-secondary"><?php _e( 'Show Current Login Screen' , 'wp-admin-ui-customize' ); ?></a></p>

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-2">

				<div id="postbox-container-1" class="postbox-container">
	
					<div class="stuffbox" id="usefulbox">
						<h3><span class="hndle"><?php _e( 'Useful plugins' , 'wp-admin-ui-customize' ); ?></span></h3>
						<div class="inside">
							<p><strong><span style="color: orange;">new</span> <a href="http://codecanyon.net/item/login-layout-customize/5729642" target="_blank">Login Layout Customize</a></strong></p>
							<p class="description"><?php _e( 'Flexible plugin for login screen customization.' , 'wp-admin-ui-customize' ); ?></p>
						</div>
					</div>
	
				</div>


				<div id="postbox-container-2" class="postbox-container">
					<div id="login_screen">

						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Login Form' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'login_headerurl'; ?>
										<tr>
											<th>
												<label><?php _e( 'Logo URL' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
												
											</td>
										</tr>
										<?php $field = 'login_headertitle'; ?>
										<tr>
											<th>
												<label><?php _e( 'Logo Title' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
											</td>
										</tr>
										<?php $field = 'login_headerlogo'; ?>
										<tr>
											<th>
												<label><?php _e( 'Logo Image URL' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
												<?php if( !empty( $Val ) ) : ?>
													<?php $img = $this->val_replace( $Val ); ?>
													<p><img src="<?php echo $img; ?>" style="max-width: 100%;" alt="Login Logo" /></p>
												<?php endif; ?>
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
										<?php $field = 'login_css'; ?>
										<tr>
											<th>
												<label><?php _e( 'CSS file to load' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
											</td>
										</tr>
										<?php $field = 'login_footer'; ?>
										<tr>
											<th>
												<label><?php _e( 'Footer text' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Val = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Val = stripslashes( esc_html( $Data[$field] ) ); endif; ?>
												<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="large-text" id="<?php echo $field; ?>">
												<a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a>
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
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'Login Form' , 'wp-admin-ui-customize' ) ); ?></span>
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
