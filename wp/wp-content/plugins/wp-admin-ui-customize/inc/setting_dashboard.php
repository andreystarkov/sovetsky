<?php

$Data = $this->get_data( 'dashboard' );
$Metaboxes = $this->get_data( "regist_dashboard_metabox" );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Dashboard' ); ?><?php _e( 'Settings' ); ?></h2>
	<p>&nbsp;</p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_dashboard" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="dashboard" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">
					<div id="dashboard">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Meta boxes' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
							
								<?php if( !empty( $Metaboxes["metaboxes"]["dashboard"] ) ) : ?>
			
										<table class="form-table">
											<thead>
												<tr>
													<th>&nbsp;</th>
													<td style="width: 15%;">
														<input type="checkbox" name="" class="check_all" />
														<strong><?php _e( 'Select All' ); ?></strong>
													</td>
													<td><strong><?php _e( 'Update meta box title' , 'wp-admin-ui-customize' ); ?></strong></td>
												</tr>
											</thead>
											<tbody>
												<?php $field = 'show_welcome_panel'; ?>
												<tr>
													<th>
														<label><?php echo _x( 'Welcome', 'Welcome panel' ); ?></label>
													</th>
													<td>
														<?php $Checked = ''; ?>
														<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
														<label><input type="checkbox" name="data[<?php echo $field; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
													</td>
													<td></td>
												</tr>
												<?php foreach( $Metaboxes["metaboxes"]["dashboard"] as $context => $meta_box ) : ?>
													<?php foreach( $meta_box as $priority => $box ) : ?>
														<?php foreach( $box as $metabox_id => $metabox_title ) : ?>
															<?php if( !empty( $metabox_id ) ) : ?>
																<tr>
																	<th>
																		<label><?php _e( $metabox_title ); ?></label>
																	</th>
																	<td>
																		<?php $Checked = ''; ?>
																		<?php if( !empty( $Data[$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																		<label><input type="checkbox" name="data[<?php echo $metabox_id; ?>][remove]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																	</td>
																	<td>
																		<?php $Val = ''; ?>
																		<?php if( !empty( $Data[$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data[$metabox_id]["name"] ) ); endif; ?>
																		<input type="text" name="data[<?php echo $metabox_id; ?>][name]" class="regular-text" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																	</td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php endforeach; ?>
												<?php endforeach; ?>
											</tbody>
										</table>

								<?php endif; ?>

									<?php $load_link = self_admin_url( 'index.php' ); ?>

									<p>
										<a href="<?php echo $load_link; ?>" class="button button-primary column_load">
											<span class="dashicons dashicons-update"></span>
											<?php echo sprintf( __( 'Refresh meta boxes for %s', 'wp-admin-ui-customize' ) , __( 'Dashboard' ) ); ?>
										</a>
									</p>
									<p class="loading">
										<span class="spinner"></span>
										<?php _e( 'Loading&hellip;' ); ?>
									</p>

							</div>
						</div>
			
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Other' , 'wp-admin-ui-customize' ); ?></span></h3>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<?php $field = 'metabox_move'; ?>
										<tr>
											<th>
												<label><?php _e( 'Meta box movement' , 'wp-admin-ui-customize' ); ?></label>
											</th>
											<td>
												<?php $Checked = ''; ?>
												<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
												<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e( "Prevent selected roles from re-arrange meta boxes" , 'wp-admin-ui-customize' ); ?></label>
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
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'Dashboard' ) . __( 'Settings' ) ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e( 'Reset settings' , 'wp-admin-ui-customize' ); ?>" />
		</p>

	</form>

</div>

<style>
.form-table td {
	vertical-align: top;
}
.inside .loading {
	display: none;
}
.inside .loading .spinner {
	float: left;
    visibility: visible;
}
.button.column_load .dashicons {
    margin-top: 3px;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {

	$( document ).on("click", "#wauc_setting_dashboard input.check_all", function() {
		var Checked = $(this).prop("checked");
		$Table = $(this).parent().parent().parent().parent();
		$Table.children("tbody").children("tr").each(function( key, el ) {
			$(el).find("input[type=checkbox]").prop("checked" , Checked);
		});
	});

	$('.wauc_form .column_load').on('click', function( ev ) {
		var load_url = $(ev.target).prop('href');
				
		$.ajax({
			url: load_url,
			beforeSend: function( xhr ) {
				$(ev.target).parent().parent().find('.loading').show();
				$(ev.target).parent().parent().find('.spinner').show();
			}
		}).done(function( data ) {
			location.reload();
		});
		
		return false;
	}).disableSelection();

});
</script>