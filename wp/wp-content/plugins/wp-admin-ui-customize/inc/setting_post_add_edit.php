<?php

$Data = $this->get_data( 'post_add_edit' );
$comment_status = get_option( 'default_comment_status' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Add New Post and Edit Post Screen Setting' , 'wp-admin-ui-customize' ); ?></h2>
	<p>&nbsp;</p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_post_add_edit" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="post_add_edit" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">

					<div id="post_add">
						<div class="postbox">
							<h3 class="hndle"><span><?php _e( 'Add New Post' ); ?> &amp; <?php _e( 'Add New Page' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'allow_comments'; ?>
										<tr>
											<th>
												<label><?php _e( 'Allow comments if discussion meta box is hidden' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php  if( $comment_status == 'open' ) : ?>
													<?php $Checked = ''; ?>
													<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
													<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Allow' ); ?></label>
													<p class="description"><?php _e( 'If the discussion meta box is hidden comments will not be displayed on new posts for the selected role.' , 'wp-admin-ui-customize' ); ?></p>
													<p><?php _e( 'Check \'Allow\' to allow comments on new posts.' , 'wp-admin-ui-customize' ); ?></p>
													<p><a href="<?php echo admin_url( 'options-discussion.php' ); ?>"><?php echo sprintf( __( 'The %s in WordPress will override this setting.' , 'wp-admin-ui-customize' ) , __( 'Default article settings' ) ); ?></a></p>
												<?php else : ?>
													<p><a href="<?php echo admin_url( 'options-discussion.php' ); ?>"><?php echo sprintf( __( 'Please select the <strong>%s</strong>' , 'wp-admin-ui-customize' ) , __( 'Allow people to post comments on new articles' ) ); ?></a></p>
												<?php endif; ?>

											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div id="post_add_edit">
						<div class="postbox">
							<h3 class="hndle"><span><?php _e( 'Add New Post' ); ?> &amp; <?php _e( 'Edit Post' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'default_permalink'; ?>
										<tr>
											<th>
												<label><?php _e( 'Change Permalinks' ); ?></label>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
												<p class="description"><?php _e( 'Only appears when the permalinks are set to the default setting.' , 'wp-admin-ui-customize' ); ?></p>
												<p><img src="<?php echo $this->Url; ?>images/post_add_edit_screen__edit_ppermalink.png" /></p>
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
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'Add New Post and Edit Post Screen Setting' , 'wp-admin-ui-customize' ) ); ?></span>
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