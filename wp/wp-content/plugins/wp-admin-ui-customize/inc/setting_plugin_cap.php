<?php

$Data = $this->get_data( 'plugin_cap' );
$UserRoles = $this->get_user_role();
$current_user_role_group = $this->current_user_role_group();

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php echo sprintf( __( '%1$s of %2$s %3$s' , 'wp-admin-ui-customize' ) , __( 'Change' ) , __( 'Plugin' ) , __( 'Capabilities' ) ); ?></h2>
	<p><?php echo sprintf( __( 'You can change the user role %2$s of %1$s settings.' , 'wp-admin-ui-customize' ) , $this->Name , __( 'Capabilities' ) ); ?></p>
	<p><?php echo sprintf( __( 'Select the capability required to modify %s settings.' , 'wp-admin-ui-customize' ) , $this->Name ); ?></p>
	
	<p>&nbsp;</p>

	<form id="wauc_setting_plugin_cap" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="plugin_cap" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">

					<div id="appearance_menus">
						<div class="postbox">
							<h3 class="hndle"><span><?php echo sprintf( __( 'Capability required to modify %s settings' , 'wp-admin-ui-customize' ) , $this->Name ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'edit_cap'; ?>
										<tr>
											<th>
												<label><?php _e( 'Capabilities' ); ?></label>
											</th>
											<td>
												<select name="data[<?php echo $field; ?>]">
													<?php $SelectedCap = 'manage_options'; ?>
													<?php if( !empty( $Data[$field] ) ) : ?>
														<?php $SelectedCap = strip_tags( $Data[$field] ); ?>
													<?php endif; ?>
													<?php if( !empty( $UserRoles[$current_user_role_group]["capabilities"] ) ) : ?>
														<?php foreach( $UserRoles[$current_user_role_group]["capabilities"] as $cap => $v ) : ?>
															<?php $Selected = false; ?>
															<?php if( !empty( $SelectedCap ) ) : ?>
																<?php if( $SelectedCap == $cap ) $Selected = 'selected="selected"'; ?>
															<?php endif; ?>
															<option value="<?php echo $cap; ?>" <?php echo $Selected; ?>><?php echo $cap; ?></option>
														<?php endforeach; ?>
													<?php endif; ?>
												</select>
												<p class="description"><?php _e( 'Default' ); ?>: manage_options</p>
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
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , sprintf( __( '%1$s of %2$s %3$s' , 'wp-admin-ui-customize' ) , __( 'Change' ) , __( 'Plugin' ) , __( 'Capabilities' ) ) . __( 'Settings' ) ); ?></span>
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