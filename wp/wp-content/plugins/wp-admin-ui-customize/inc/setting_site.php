<?php

$Data = $this->get_data( 'site' );
$SiteSetting = get_option( $this->Record["site"] );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Site Settings' , 'wp-admin-ui-customize' ); ?></h2>
	<p>&nbsp;</p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_site" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="site" />

		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">

					<div id="meta_fields">

						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Header Meta' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'wp_generator'; ?>
										<tr>
											<th>
												<label><?php echo $field; ?></label>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $SiteSetting[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												<p class="description"><?php _e( 'Tag' , 'wp-admin-ui-customize' ); ?> : <code><?php echo esc_html( get_the_generator( 'xhtml' ) ); ?></code></p>
											</td>
										</tr>
										<?php $field = 'wlwmanifest_link'; ?>
										<tr>
											<th>
												<?php echo $field; ?>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $SiteSetting[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												<p class="description"><?php _e( 'Required if you are using Windows Live Writer.' , 'wp-admin-ui-customize' ); ?></p>
												<p class="description"><?php _e( 'Tag' , 'wp-admin-ui-customize' ); ?> : <code><?php echo esc_html( '<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="' . get_bloginfo('wpurl') . '/wp-includes/wlwmanifest.xml" />' ); ?></code></p>
											</td>
										</tr>
										<?php $field = 'rsd_link'; ?>
										<tr>
											<th>
												<?php echo $field; ?>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $SiteSetting[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												<p class="description"><?php _e( 'Required if you are using pingbacks.' , 'wp-admin-ui-customize' ); ?></p>
												<p class="description"><?php _e( 'Tag' , 'wp-admin-ui-customize' ); ?> : <code><?php echo esc_html( '<link rel="EditURI" type="application/rsd+xml" title="RSD" href="' . get_bloginfo('wpurl') . '"/xmlrpc.php?rsd" />' ); ?></code></p>
											</td>
										</tr>
										<?php $field = 'feed_links'; ?>
										<tr>
											<th>
												<?php echo $field; ?>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $SiteSetting[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												<p class="description"><?php _e( 'Adds RSS feed links to the HTML &lt;head&gt;' , 'wp-admin-ui-customize' ); ?></p>
												<p class="description"><?php _e( 'Tag' , 'wp-admin-ui-customize' ); ?> : <code><?php echo esc_html( '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr( sprintf( __('%1$s %2$s Feed') , get_bloginfo('name') , '&amp;raquo&#059;' ) ) . '" href="' . get_feed_link( get_default_feed() ) . ' />' ); ?></code></p>
											</td>
										</tr>
										<?php $field = 'feed_links_extra'; ?>
										<tr>
											<th>
												<?php echo $field; ?>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $SiteSetting[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												<p class="description"><?php _e( 'Adds RSS feed links for other feeds such as category feeds' , 'wp-admin-ui-customize' ); ?></p>
												<p class="description"><?php _e( 'Tag' , 'wp-admin-ui-customize' ); ?> : <code><?php echo esc_html( '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr( sprintf( __('%1$s %2$s Comments Feed') , get_bloginfo('name') , '&amp;raquo&#059;' ) ) . '" href="' . get_feed_link( get_default_feed() . '&#038;p=***' ) . ' />' ); ?></code></p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>

				</div>

				<div id="postbox-container-2" class="postbox-container">

					<div id="general">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'General' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'admin_bar'; ?>
										<tr>
											<th>
												<?php _e( 'Admin bar' , 'wp-admin-ui-customize' ); ?>
											</th>
											<td>
												<?php $arr = array( "hide" => __( 'Hide admin bar on the front end' , 'wp-admin-ui-customize' ) , "front" => __( 'Apply WP Admin UI Customize settings to the front end admin bar' , 'wp-admin-ui-customize' ) ); ?>
												<select name="data[<?php echo $field; ?>]">
													<option value="">-</option>
													<?php foreach( $arr as $key => $label ) : ?>
														<?php $Selected = ''; ?>
														<?php if( !empty( $Data[$field] ) ) : ?>
															<?php if( $Data[$field] == $key ) : $Selected = 'selected="selected"'; endif; ?>
															<?php if( $key == "hide" && $Data[$field] == "1" ) : $Selected = 'selected="selected"'; endif; ?>
														<?php endif; ?>
														<option value="<?php echo $key; ?>" <?php echo $Selected; ?>><?php echo $label; ?></option>
													<?php endforeach; ?>
												</select>
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
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'Site Settings' , 'wp-admin-ui-customize' ) ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e( 'Reset settings' , 'wp-admin-ui-customize' ); ?>" />
		</p>

	</form>

</div>

<style>
</style>
<script>
jQuery(document).ready( function($) {

});
</script>