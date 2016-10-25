<?php

$update_data = wp_get_update_data();
$awaiting_mod = wp_count_comments();
$awaiting_mod = $awaiting_mod->moderated;
$current_user = wp_get_current_user();
if( is_multisite() ) {
	$current_site = get_current_site();
}

?>

<div id="list_variables">
	<div class="list_variables_wrap">

		<table class="widefat fixed">
			<thead>
				<tr>
					<th><?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?></th>
					<th><?php _e( 'Value' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if( is_multisite() ) : ?>
					<tr>
						<th><strong>[site_name]</strong></th>
						<td>
							<code><?php echo esc_attr( $current_site->site_name ); ?></code>
						</td>
					</tr>
					<tr>
						<th><strong>[site_url]</strong></th>
						<td>
							<?php $protocol = is_ssl() ? 'https://' : 'http://'; ?>
							<code><?php echo $protocol . esc_attr( $current_site->domain . $current_site->path );?></code>
						</td>
					</tr>
				<?php endif; ?>
				<tr>
					<th><strong>[blog_name]</strong></th>
					<td>
						<code><?php echo get_bloginfo( 'name' ); ?></code>
						<?php if( is_multisite() ) : ?>
							<span class="description"><?php _e( 'Blog name of logged in.' , 'wp-admin-ui-customize' ); ?></span>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th><strong>[blog_url]</strong></th>
					<td>
						<code><?php echo get_bloginfo( 'url' ); ?></code>
						<?php if( is_multisite() ) : ?>
							<span class="description"><?php _e( 'Blog URL of logged in.' , 'wp-admin-ui-customize' ); ?></span>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th><strong>[template_directory_uri]</strong></th>
					<td>
						<code><?php echo get_bloginfo( 'template_directory' ); ?></code>
					</td>
				</tr>
				<tr>
					<th><strong>[stylesheet_directory_uri]</strong></th>
					<td>
						<code><?php echo get_stylesheet_directory_uri(); ?></code>
					</td>
				</tr>
				<tr>
					<th><strong>[update_total]</strong></th>
					<td>
						<code>&lt;span class=&quot;update-plugins count-<?php echo $update_data["counts"]["total"]; ?>&quot;&gt;&lt;span class=&quot;update-count&quot;&gt;<strong><?php echo number_format_i18n( $update_data["counts"]["total"] ); ?></strong>&lt;/span&gt;&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<th><strong>[update_plugins]</strong></th>
					<td>
						<code>&lt;span class=&quot;update-plugins count-<?php echo $update_data["counts"]["plugins"]; ?>&quot;&gt;&lt;span class=&quot;plugin-count&quot;&gt;<strong><?php echo number_format_i18n( $update_data["counts"]["plugins"] ); ?></strong>&lt;/span&gt;&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<th><strong>[update_themes]</strong></th>
					<td>
						<code>&lt;span class=&quot;update-plugins count-<?php echo $update_data["counts"]["themes"]; ?>&quot;&gt;&lt;span class=&quot;theme-count&quot;&gt;<strong><?php echo number_format_i18n( $update_data["counts"]["themes"] ); ?></strong>&lt;/span&gt;&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<th><strong>[comment_count]</strong></th>
					<td>
						<code>&lt;span class&quot;ab-icon&quot;&gt&lt;/span&gt; &lt;span id=&quot;ab-awaiting-mod&quot; class=&quot;ab-label awaiting-mod pending-count count-<?php echo $awaiting_mod; ?>&quot;&gt;<strong><?php echo number_format_i18n( $awaiting_mod ); ?></strong>&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<th><strong>[comment_count_format]</strong></th>
					<td>
						<code><?php echo $awaiting_mod; ?></code>
					</td>
				</tr>
				<tr>
					<th><strong>[user_name]</strong></th>
					<td>
						<code><?php echo $current_user->display_name; ?></code>
						<span class="description"><?php _e( 'In your case.' , 'wp-admin-ui-customize' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><strong>[user_login_name]</strong></th>
					<td>
						<code><?php echo $current_user->user_login; ?></code>
						<span class="description"><?php _e( 'In your case.' , 'wp-admin-ui-customize' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><strong>[user_avatar]</strong></th>
					<td>
						<code><?php echo get_avatar( $current_user->ID , 16 ); ?></code>
						<span class="description"><?php _e( 'In your case.' , 'wp-admin-ui-customize' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><strong>[user_avatar_64]</strong></th>
					<td>
						<code><?php echo get_avatar( $current_user->ID , 64 ); ?></code>
						<span class="description"><?php _e( 'In your case.' , 'wp-admin-ui-customize' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><strong>[post_type]</strong></th>
					<td>
						<code><?php _e( 'Posts' ); ?></code>
						<span class="description"><?php _e( 'Current Post Type Name' , 'wp-admin-ui-customize' ); ?> ( <?php _e( 'Pages' ); ?>/<?php _e( 'Categories' ); ?>/<?php _e( 'Tags' ); ?>/<?php _e( 'Custom Post Type' , 'wp-admin-ui-customize' ); ?>)</span>
					</td>
				</tr>
				<?php if( !empty( $this->ActivatedPlugin ) ) : ?>
				
					<?php $activated_plugins = $this->ActivatedPlugin; ?>
					
					<?php if( !empty( $activated_plugins['woocommerce'] ) ) : ?>
					
						<?php if( function_exists( 'wc_processing_order_count' ) ) : ?>
							<?php $order_count = intval( wc_processing_order_count() ); ?>
							<?php if( !empty( $order_count ) ) : ?>
							<tr>
								<th><strong>[woocommerce_order_process_count]</strong></th>
								<td>
									<code>&lt;span class=&quot;awaiting-mod update-plugins count-<?php echo $order_count ?>&quot;&gt;&lt;span class=&quot;processing-count&quot;><?php echo number_format_i18n( $order_count ); ?>&lt;/span&gt;&lt;/span&gt;</code>
								</td>
							</tr>
							<?php endif; ?>
						<?php endif; ?>
					
					<?php endif; ?>
				
				<?php endif; ?>
			</tbody>
		</table>

	</div>
</div>