<?php
/**
 * Featured Image Admin Thumb.
 *
 * @package   Featured_Image_Admin_Thumb_Admin
 * @author    Sean Hayes <sean@seanhayes.biz>
 * @license   GPL-2.0+
 * @link      http://www.seanhayes.biz
 * @copyright 2014 Sean Hayes
 */

/**
 * Plugin class. This class works with the
 * administrative side of the WordPress site.
 *
 * @package Featured_Image_Admin_Thumb_Admin
 * Sean Hayes <sean@seanhayes.biz>
 */
class Featured_Image_Admin_Thumb_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */

	protected $fiat_nonce = null;
	protected $text_domain;
	protected $fiat_image_size = 'fiat_thumb';
	protected $is_woocommerce_active;

	// For post types
	// Expect that we won't need thumbnails for these post types
	protected $default_excluded_post_types = array(
			'nav_menu_item',
			'revision',
			'attachment',
	);

	private function __construct() {

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 */
		$plugin = Featured_Image_Admin_Thumb::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->text_domain = $plugin->load_plugin_textdomain();

		// Load admin style sheet and JavaScript.
//		add_action( 'admin_enqueue_scripts',        array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts',        array( $this, 'enqueue_admin_scripts' ) );

		add_image_size( $this->fiat_image_size , 60  );

		add_action( 'admin_init', array( $this, 'fiat_init_columns' ) );

		add_action( 'wp_ajax_fiat_get_thumbnail',   array( $this, 'fiat_get_thumbnail' ) );

		$this->is_woocommerce_active = in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}

	/**
	 * Register admin column handlers for posts and pages, taxonomies and other custom post types
	 *
	 * Fired in the 'init' action
	 */

	public function fiat_init_columns() {

		$available_post_types = array_diff( get_post_types(), $this->default_excluded_post_types );
		foreach ( $available_post_types as $post_type ) {
			add_action( "manage_{$post_type}_posts_custom_column" ,  array( $this, 'fiat_custom_columns' ), 2 );
			add_filter( "manage_{$post_type}_posts_columns" ,        array( $this, 'fiat_add_thumb_column' ) );
		}

		// For taxonomies:

		$taxonomies = get_taxonomies( '', 'names' );

		foreach ( $taxonomies as $taxonomy ) {
			add_action( "manage_{$taxonomy}_posts_custom_column" ,  array( $this, 'fiat_custom_columns' ), 2, 2 );
			add_filter( "manage_{$taxonomy}_posts_columns" ,        array( $this, 'fiat_add_thumb_column' ) );
		}


	}
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue inline admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		// blank and unused since v 1.5
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		// Enable the next block if the settings page returns
		/*if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}*/
		$screen = get_current_screen();
		$current_post_type = get_post_type();
		// Add custom uploader css and js support for all post types.
		if ( "edit-{$current_post_type}" == $screen->id  ) {

			// Add support for custom media uploader to be shown inside a thickbox
			add_thickbox();
			wp_enqueue_media();
			wp_enqueue_script(
			$this->plugin_slug . '-admin-script-thumbnail',
				plugins_url( 'assets/js/admin-thumbnail.js', __FILE__ ),
			array( 'post' ), Featured_Image_Admin_Thumb::VERSION, true );
			wp_localize_script(
				$this->plugin_slug . '-admin-script-thumbnail',
				'fiat_thumb',
				array(
					'button_text' => __( 'Use as thumbnail', 'featured-image-admin-thumb-fiat' ),
					'change_featured_image' => __( 'Change featured image', 'featured-image-admin-thumb-fiat' )
				)
			);
		}
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	* @return array|bool
	* @since 1.0.0
	*
	* @uses fiat_thumb
	*
	* Function to process an image attachment id via AJAX and return to caller
	* This is used to populate the "Thumb" column with an image html snippet of the selected thumbnail
	*
	*/
	public function fiat_get_thumbnail() {

		// Get the post id we are to attach the image to
		$post_ID = intval( $_POST['post_id'] );
		if ( ! current_user_can( 'edit_post', $post_ID ) ) {
			wp_die( - 1 );
		}

		// Check who's calling us before proceeding
		check_ajax_referer( 'set_post_thumbnail-' . $post_ID, $this->fiat_nonce );

		// Get thumbnail ID so we can then get html src to use for thumbnail
		$thumbnail_id = intval( $_POST['thumbnail_id'] );
		$thumb_url = wp_get_attachment_image( $thumbnail_id, $this->fiat_image_size );
		echo $thumb_url;

		die();
	}

	/**
	* @param $column
	* @return void
	* @since 1.0.0
	* @uses fiat_thumb, thumb
	*
	* Insert representative thumbnail image into Admin Dashboard view
	* for All Posts/Pages if we are on the "thumb" column
	*
	*/
	public function fiat_custom_columns( $column ) {
		global $post;
		$post_id = $post->ID;
		switch ( $column ) {
			case 'thumb':
				if ( has_post_thumbnail( $post_id ) ) {
					// Determine if our image size has been created and use
					// that size/attribute combination
					// else get the post-thumbnail image and apply custom sizing to
					// size it to fit in the admin dashboard
					$sizes = '';
					$thumbnail_id = get_post_thumbnail_id( $post_id );
					$tpm = wp_get_attachment_metadata( $thumbnail_id );
					if ( false !== $tpm && ! empty( $tpm ) ) {
						$sizes = $tpm['sizes'];
					}

					// Default to thumbnail size (as this will be sized down reducing the bandwidth until the image thumbnail is regenerated)
					$fiat_image_size = 'thumbnail';

					// Review the sizes this particular image has been set to
					if ( is_array( $sizes ) ) {
						foreach ( $sizes as $s => $k ) {
							if ( $this->fiat_image_size == $s ) {
								// our size is present, set it and break out
								$fiat_image_size = $this->fiat_image_size;
								break;
							}
						}
					}
					/**
					 * Check if WooCommerce is active
					 * If so, only return anchor link markup to inline edit thumbnail
					 * WooCommerce will supply the image markup
					 **/
					if ( $this->fiat_on_woocommerce_products_list() ) {
						$thumb_url = '';
					} else {
						if ( 'thumbnail' == $fiat_image_size ) {
							// size down this time
							$thumb_url = wp_get_attachment_image( $thumbnail_id, array( 60, 60 ) );
						} else {
							// use native sized image
							$thumb_url = get_image_tag( $thumbnail_id, '', '', '', $fiat_image_size );
						}
					}
					// Here it is!
					$this->fiat_nonce = wp_create_nonce( 'set_post_thumbnail-' . $post_id );
					$template_html = '<a title="' . __( 'Change featured image', 'featured-image-admin-thumb-fiat' ) . '" href="%1$s" id="set-post-thumbnail" class="fiat_thickbox" data-thumbnail-id="%3$d">%2$s</a>';
					$html = sprintf( $template_html,
						home_url() . '/wp-admin/media-upload.php?post_id=' . $post_id .'&amp;type=image&amp;TB_iframe=1&_wpnonce=' . $this->fiat_nonce,
						$thumb_url,
						$thumbnail_id
					);
					// Click me to change!
					echo $html;
				} else {

						// This nonce "action" parameter must match the Ajax Referrer action used in the js and PHP
					// wp-admin/includes/ajax-actions.php wp-includes/pluggable.php
					// It's like dealing with the IRS. :-)

					$this->fiat_nonce = wp_create_nonce( 'set_post_thumbnail-' . $post_id );
					$set_featured_image = sprintf( __( 'Set %s featured image', 'featured-image-admin-thumb-fiat' ), '<br/>' );
					$set_edit_markup = $this->fiat_on_woocommerce_products_list() ? '' : $set_featured_image;
					$template_html = '<a title="' . __( 'Set featured image', 'featured-image-admin-thumb-fiat' ) . '" href="%1$s" id="set-post-thumbnail" class="fiat_thickbox" >%2$s</a>';
					$html = sprintf( $template_html,
						home_url() . '/wp-admin/media-upload.php?post_id=' . $post_id .'&amp;type=image&amp;TB_iframe=1&_wpnonce=' . $this->fiat_nonce,
						$set_edit_markup
					);
					// Click me!
					echo $html;
				}
				break;
		}
	}

	/**
	 * @return bool
	 *
	 * Is WooCommerce installed and activated and we are showing the product post type?
	 *
	 * Logic from here: https://docs.woothemes.com/document/create-a-plugin/
	 */
	public function fiat_on_woocommerce_products_list() {
		global $post;
		return $post != null && 'product' == $post->post_type && $this->is_woocommerce_active;
	}
	/**
	* @param $columns
	* @return array
	* @since 1.0.0
	*
	* Add our custom column to all posts/pages/custom post types view
	*
	*/
	public function fiat_add_thumb_column( $columns ) {
		/**
		 * Check if WooCommerce is active
		 * If so WooCommerce supplies the title for the column and then we bail
		 **/
		if ( $this->fiat_on_woocommerce_products_list() ) {
			return $columns;
		} else {
			return array_merge(
					$columns,
					array(
							'thumb' => __( 'Thumb', 'featured-image-admin-thumb-fiat' ),
					)
			);
		}
	}

}
