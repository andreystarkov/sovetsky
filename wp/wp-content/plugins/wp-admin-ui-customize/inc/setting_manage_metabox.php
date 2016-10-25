<?php

$Data = $this->get_data( 'manage_metabox' );
$Metaboxes = $this->get_data( "regist_metabox" );
$CustomPosts = $this->get_custom_posts();
$activated_plugin = $this->ActivatedPlugin;

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Management of meta boxes' , 'wp-admin-ui-customize' ); ?></h2>
	<p><?php _e( 'Ensure at least one post and page is present and then refresh to display the available meta boxes.' , 'wp-admin-ui-customize' ); ?></p>
	<p><?php _e( 'It is also possible to change the meta box display name.' , 'wp-admin-ui-customize' ); ?></p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<form id="wauc_setting_manage_metabox" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="manage_metabox" />

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-1">

				<div id="postbox-container-1" class="postbox-container">
					<div id="built_in">

						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php _e( 'Posts' ); ?></span></h3>
							<div class="inside">
			
								<?php if( !empty( $Metaboxes["metaboxes"]["post"] ) ) : ?>
								
									<table class="form-table">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<td style="width: 15%;">
													<label>
														<input type="checkbox" name="" class="check_all" />
														<strong><?php _e( 'Select All' ); ?></strong>
													</label>
												</td>
												<td style="width: 15%;">
													<strong><?php _e( 'Default Open' , 'wp-admin-ui-customize' ); ?></strong>
												</td>
												<td><strong><?php _e( 'Update meta box title' , 'wp-admin-ui-customize' ); ?></strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach( $Metaboxes["metaboxes"]["post"] as $context => $meta_box ) : ?>
												<?php foreach( $meta_box as $priority => $box ) : ?>
													<?php foreach( $box as $metabox_id => $metabox_title ) : ?>

														<tr>
															<th>
																<?php _e( $metabox_title ); ?>
															</th>
															<td>
																<?php if( $metabox_id != 'submitdiv' ) : ?>
																	<?php $Checked = ''; ?>
																	<?php if( !empty( $Data["post"][$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																	<label><input type="checkbox" name="data[post][<?php echo $metabox_id; ?>][remove]" value="1" class="show_check" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																<?php else : ?>
																	<?php _e( 'Show' ); ?>
																<?php endif; ?>
															</td>
															<td>
																<?php if( $metabox_id != 'submitdiv' ) : ?>
																	<?php $Selected = 0; ?>
																	<?php if( !empty( $Data["post"][$metabox_id]["toggle"] ) ) : $Selected = true; endif; ?>
																	<select name="data[post][<?php echo $metabox_id; ?>][toggle]" class="select_toggle">
																		<option value="0" <?php Selected( $Selected , 0 ); ?>><?php _e( 'Expanded' , 'wp-admin-ui-customize' ); ?></option>
																		<option value="1" <?php Selected( $Selected , 1 ); ?>><?php _e( 'Collapsed' , 'wp-admin-ui-customize' ); ?></option>
																	</select>
																<?php else : ?>
																	<?php _e( 'Show' ); ?>
																<?php endif; ?>
															</td>
															<td>
																<?php $Val = ''; ?>
																<?php if( !empty( $Data["post"][$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data["post"][$metabox_id]["name"] ) ); endif; ?>
																<input type="text" name="data[post][<?php echo $metabox_id; ?>][name]" class="regular-text metabox_rename" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																<?php if( $metabox_id == 'commentstatusdiv' ) : ?>
																	<p class="description"><?php _e( 'If the discussion meta box is hidden comments will not be displayed on new posts for the selected role.' , 'wp-admin-ui-customize' ); ?></p>
																	<p><img src="<?php echo $this->Url; ?>images/discussion_allow_comments.png" /></p>
																	<p><a href="<?php echo admin_url( 'admin.php?page=' . $this->PageSlug . '_post_add_edit_screen' ); ?>"><?php _e( 'Change this setting to allow comments on new posts' , 'wp-admin-ui-customize' ); ?></a></p>
																<?php endif; ?>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endforeach; ?>
										</tbody>
									</table>

								<?php endif; ?>
			
									<?php $post = get_posts( array( 'post_type' => 'post' , 'order' => 'DESC' , 'orderby' => 'post_date' , 'numberposts' => 1 ) ); ?>
									
									<?php if( !empty( $post ) ) : ?>

										<?php $load_link = self_admin_url( 'post.php?post=' . $post[0]->ID . '&action=edit' ); ?>

									<?php else: ?>

										<?php $load_link = self_admin_url( 'post-new.php' ); ?>

									<?php endif; ?>

									<p>
										<a href="<?php echo $load_link; ?>" class="button button-primary column_load">
											<span class="dashicons dashicons-update"></span>
											<?php echo sprintf( __( 'Refresh meta boxes for %s', 'wp-admin-ui-customize' ) , __( 'Posts' ) ); ?>
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
							<h3 class="hndle"><span><?php _e( 'Pages' ); ?></span></h3>
							<div class="inside">
			
								<?php if( !empty( $Metaboxes["metaboxes"]["page"] ) ) : ?>
			
									<table class="form-table">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<td style="width: 15%;">
													<label>
														<input type="checkbox" name="" class="check_all" />
														<strong><?php _e( 'Select All' ); ?></strong>
													</label>
												</td>
												<td style="width: 15%;">
													<strong><?php _e( 'Default Open' , 'wp-admin-ui-customize' ); ?></strong>
												</td>
												<td><strong><?php _e( 'Update meta box title' , 'wp-admin-ui-customize' ); ?></strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach( $Metaboxes["metaboxes"]["page"] as $context => $meta_box ) : ?>
												<?php foreach( $meta_box as $priority => $box ) : ?>
													<?php foreach( $box as $metabox_id => $metabox_title ) : ?>
														<tr>
															<th>
																<?php _e( $metabox_title ); ?>
															</th>
															<td>
																<?php if( $metabox_id != 'submitdiv' ) : ?>
																	<?php $Checked = ''; ?>
																	<?php if( !empty( $Data["page"][$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																	<label><input type="checkbox" name="data[page][<?php echo $metabox_id; ?>][remove]" value="1" class="show_check" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																<?php else : ?>
																	<?php _e( 'Show' ); ?>
																<?php endif; ?>
															</td>
															<td>
																<?php if( $metabox_id != 'submitdiv' ) : ?>
																	<?php $Selected = 0; ?>
																	<?php if( !empty( $Data["page"][$metabox_id]["toggle"] ) ) : $Selected = true; endif; ?>
																	<select name="data[page][<?php echo $metabox_id; ?>][toggle]" class="select_toggle">
																		<option value="0" <?php Selected( $Selected , 0 ); ?>><?php _e( 'Expanded' , 'wp-admin-ui-customize' ); ?></option>
																		<option value="1" <?php Selected( $Selected , 1 ); ?>><?php _e( 'Collapsed' , 'wp-admin-ui-customize' ); ?></option>
																	</select>
																<?php else : ?>
																	<?php _e( 'Show' ); ?>
																<?php endif; ?>
															</td>
															<td>
																<?php $Val = ''; ?>
																<?php if( !empty( $Data["page"][$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data["page"][$metabox_id]["name"] ) ); endif; ?>
																<input type="text" name="data[page][<?php echo $metabox_id; ?>][name]" class="regular-text metabox_rename" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																<?php if( $metabox_id == 'commentstatusdiv' ) : ?>
																	<p class="description"><?php _e( 'If the discussion meta box is hidden comments will not be displayed on new posts for the selected role.' , 'wp-admin-ui-customize' ); ?></p>
																	<p><img src="<?php echo $this->Url; ?>images/discussion_allow_comments.png" /></p>
																	<p><a href="<?php echo admin_url( 'admin.php?page=' . $this->PageSlug . '_post_add_edit_screen' ); ?>"><?php _e( 'Change this setting to allow comments on new posts' , 'wp-admin-ui-customize' ); ?></a></p>
																<?php endif; ?>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
			
								<?php endif; ?>
			
									<?php $post = get_posts( array( 'post_type' => 'page' , 'order' => 'DESC' , 'orderby' => 'post_date' , 'numberposts' => 1 ) ); ?>
									
									<?php if( !empty( $post ) ) : ?>

										<?php $load_link = self_admin_url( 'post.php?post=' . $post[0]->ID . '&action=edit' ); ?>

									<?php else: ?>

										<?php $load_link = self_admin_url( 'post-new.php?post_type=page' ); ?>

									<?php endif; ?>

									<p>
										<a href="<?php echo $load_link; ?>" class="button button-primary column_load">
											<span class="dashicons dashicons-update"></span>
											<?php echo sprintf( __( 'Refresh meta boxes for %s', 'wp-admin-ui-customize' ) , __( 'Pages' ) ); ?>
										</a>
									</p>
									<p class="loading">
										<span class="spinner"></span>
										<?php _e( 'Loading&hellip;' ); ?>
									</p>
							</div>
						</div>

					</div>
				</div>
				
				<?php if ( !empty( $CustomPosts ) ) : ?>
				
				<div id="postbox-container-2" class="postbox-container">
					<div id="custom_post">
						
						<?php foreach( $CustomPosts as $post_name => $cpt ) : ?>
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo strip_tags( $cpt->labels->name ); ?></span></h3>
							<div class="inside">
			
								<?php if( !empty( $Metaboxes["metaboxes"][$post_name] ) ) : ?>

									<table class="form-table">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<td style="width: 15%;">
													<label>
														<input type="checkbox" name="" class="check_all"  />
														<strong><?php _e( 'Select All' ); ?></strong>
													</label>
												</td>
												<td style="width: 15%;">
													<strong><?php _e( 'Default Open' , 'wp-admin-ui-customize' ); ?></strong>
												</td>
												<td><strong><?php _e( 'Update meta box title' , 'wp-admin-ui-customize' ); ?></strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach( $Metaboxes["metaboxes"][$post_name] as $context => $meta_box ) : ?>
												<?php foreach( $meta_box as $priority => $box ) : ?>
													<?php foreach( $box as $metabox_id => $metabox_title ) : ?>
														<?php if( !empty( $metabox_id ) ) : ?>
															<tr>
																<th><?php echo $metabox_title; ?></th>
																<td>
																	<?php if( $metabox_id != 'submitdiv' ) : ?>
																		<?php $Checked = ''; ?>
																		<?php if( !empty( $Data[$post_name][$metabox_id]["remove"] ) ) : $Checked = 'checked="checked"'; endif; ?>
																		<label><input type="checkbox" name="data[<?php echo $post_name; ?>][<?php echo $metabox_id; ?>][remove]" value="1" class="show_check" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
																	<?php else : ?>
																		<?php _e( 'Show' ); ?>
																	<?php endif; ?>
																</td>
																<td>
																	<?php if( $metabox_id != 'submitdiv' ) : ?>
																		<?php $Selected = 0; ?>
																		<?php if( !empty( $Data[$post_name][$metabox_id]["toggle"] ) ) : $Selected = true; endif; ?>
																		<select name="data[<?php echo $post_name; ?>][<?php echo $metabox_id; ?>][toggle]" class="select_toggle">
																			<option value="0" <?php Selected( $Selected , 0 ); ?>><?php _e( 'Expanded' , 'wp-admin-ui-customize' ); ?></option>
																			<option value="1" <?php Selected( $Selected , 1 ); ?>><?php _e( 'Collapsed' , 'wp-admin-ui-customize' ); ?></option>
																		</select>
																	<?php else : ?>
																		<?php _e( 'Show' ); ?>
																	<?php endif; ?>
																</td>
																<td>
																	<?php $Val = ''; ?>
																	<?php if( !empty( $Data[$post_name][$metabox_id]["name"] ) ) : $Val = esc_html( stripslashes( $Data[$post_name][$metabox_id]["name"] ) ); endif; ?>
																	<input type="text" name="data[<?php echo $post_name; ?>][<?php echo $metabox_id; ?>][name]" class="regular-text metabox_rename" value="<?php echo $Val; ?>" placeholder="<?php _e( $metabox_title ); ?>" />
																</td>
															</tr>
														<?php endif; ?>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
			
								<?php endif; ?>
			
									<?php $args = array( 'post_type' => $post_name , 'order' => 'DESC' , 'orderby' => 'post_date' , 'numberposts' => 1 ); ?>

									<?php if( !empty( $activated_plugin['woocommerce'] ) && $post_name == 'shop_order' ) : ?>

										<?php $args['post_status'] = array( 'wc-processing', 'wc-completed' ); ?>

									<?php endif; ?>
									
									<?php $post = get_posts(  $args ); ?>
									
									<?php if( !empty( $post ) ) : ?>

										<?php $load_link = self_admin_url( 'post.php?post=' . $post[0]->ID . '&action=edit' ); ?>

									<?php else: ?>

										<?php $load_link = self_admin_url( 'post-new.php?post_type=' . $post_name ); ?>

									<?php endif; ?>

									<p>
										<a href="<?php echo $load_link; ?>" class="button button-primary column_load">
											<span class="dashicons dashicons-update"></span>
											<?php echo sprintf( __( 'Refresh meta boxes for %s', 'wp-admin-ui-customize' ) , $cpt->label ); ?>
										</a>
									</p>
									<p class="loading">
										<span class="spinner"></span>
										<?php _e( 'Loading&hellip;' ); ?>
									</p>
							</div>
						</div>
						<?php endforeach; ?>

					</div>
				</div>
				
				<?php endif; ?>
				
				<br class="clear">

			</div>

		</div>

		<p class="submit">
			<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
		</p>

		<p class="submit reset">
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'Management of meta boxes' , 'wp-admin-ui-customize' ) . __( 'Settings' ) ); ?></span>
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

	var $Form = $("#wauc_setting_manage_metabox");
	$(".check_all", $Form).click(function() {
		var Checked = $(this).prop("checked");
		$Table = $(this).parent().parent().parent().parent().parent();
		$Table.children("tbody").children("tr").each(function( index, el ) {
			var $Tr = $(el);
			$Tr.find("input[type=checkbox]").prop("checked" , Checked);
			if( Checked ) {
				$Tr.find('.select_toggle').prop('disabled', true);
				$Tr.find('.metabox_rename').prop('disabled', true).addClass('disabled');
			} else {
				$Tr.find('.select_toggle').prop('disabled', false);
				$Tr.find('.metabox_rename').prop('disabled', false).removeClass('disabled');
			}
		});
	});
	
	$('.postbox .inside .form-table').each(function( key, el ) {
		$(el).find('tbody tr').each(function( tr_key , tr_el ) {
			if( $(tr_el).find('.show_check').size() > 0 ) {
				if( $(tr_el).find('.show_check').prop('checked') ) {
					$(tr_el).find('.select_toggle').prop('disabled', true);
					$(tr_el).find('.metabox_rename').prop('disabled', true).addClass('disabled');
				}
			}
		});
	});
	
	$('.postbox .inside .form-table tbody tr td .show_check').on('click', function( ev ) {
		var Tr = $(ev.target).parent().parent().parent();
		if( $(ev.target).prop('checked') ) {
			Tr.find('.select_toggle').prop('disabled', true);
			Tr.find('.metabox_rename').prop('disabled', true).addClass('disabled');
		} else {
			Tr.find('.select_toggle').prop('disabled', false);
			Tr.find('.metabox_rename').prop('disabled', false).removeClass('disabled');
		}
	});

	$('.wauc_form .column_load').on('click', function( ev ) {
		var load_url = $(ev.target).prop('href');
		
		load_url += '&<?php echo $this->ltd; ?>_metabox_load=1';
		
		$.ajax({
			url: load_url,
			beforeSend: function( xhr ) {
				$(ev.target).parent().parent().find('.loading').show();
				$(ev.target).parent().parent().find('.spinner').show();
			}
		}).done(function( post_html_el ) {
			
			if( post_html_el.indexOf( "adminpage = 'post-php'" ) != -1 || post_html_el.indexOf( "adminpage = 'post-new-php'" ) != -1 ) {

				location.reload();

			}
			
		});

		return false;
		
	}).disableSelection();

});
</script>