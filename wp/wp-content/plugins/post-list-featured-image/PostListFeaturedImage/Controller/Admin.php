<?php
namespace PostListFeaturedImage\Controller;

use PostListFeaturedImage\Lib\Helper;
use PostListFeaturedImage\Lib\Debugger;
use PostListFeaturedImage\Lib\TabsData;
use PostListFeaturedImage\Model;

if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}

class Admin {

	protected static $instance;

	protected $view_vars;

	protected $plugin_options;

	protected $ms_plugin_options;

	protected $admin_page_hook_suffix;

	protected $ms_admin_page_hook_suffix;

	protected $supported_post_types;

	protected $default_thumb_size;

	public static function instance() {
		null === self::$instance && self::$instance = new self;

		return self::$instance;
	}

	public function __construct() {
		$this->plugin_options     = get_option( Helper::get_options_key() );
		$this->ms_plugin_options  = get_site_option( 'ms_' . Helper::get_options_key() );
		$this->default_thumb_size = 100;

		$this->supported_post_types = array( 'post', 'page' );

		$this->view_vars = array(
			'plugin'      => Helper::get_plugin_data( PLFI_PLUGIN_FILE ),
			'options_key' => Helper::get_options_key()
		);
	}

	public function init() {
		if ( !empty( $this->plugin_options['thumb_size'] ) && $this->plugin_options['thumb_size'] ) {
			add_image_size(
				Helper::get_thumb_slug(),
				$this->plugin_options['thumb_size'],
				$this->plugin_options['thumb_size']
			);
		} else {
			add_image_size( Helper::get_thumb_slug(), $this->default_thumb_size, $this->default_thumb_size );
		}

		$this->action_hooks();

		$this->filter_hooks();
	}

	protected function action_hooks() {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_init', array( $this, 'list_table_customization' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'network_admin_menu', array( $this, 'network_admin_menu' ) );
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ), 20 );
		add_action( 'wp_ajax_do_save_plfi_plugin_settings', array( $this, 'save_plfi_plugin_settings' ) );

		do_action( 'plfi_action_hooks' );
	}

	protected function filter_hooks() {
		add_filter( 'plugin_action_links_' . PLFI_PLUGIN_SLUG, array( $this, 'add_settings_link' ) );
		add_filter(
			'network_admin_plugin_action_links_' . PLFI_PLUGIN_SLUG,
			array( $this, 'add_network_settings_link' )
		);

		do_action( 'plfi_filter_hooks' );
	}

	//<editor-fold desc="ACTION HANDLERS">
	/**********************************************
	 *            Plugin Settings Page
	 **********************************************/

	public function admin_enqueue_scripts( $hook ) {
        /**
         * @var \WP_Scripts $wp_scripts
         */
        global $wp_scripts;

		wp_register_style(
			'flexbox-grid-style',
			plugins_url( Helper::get_stylesheet_uri( 'flexbox-grid' ), PLFI_PLUGIN_FILE )
		);

        wp_register_style(
            'plfi-settings-ui-theme',
            sprintf(
                '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.min.css',
                $wp_scripts->registered['jquery-ui-core']->ver
            )
        );

		if ( $hook === $this->admin_page_hook_suffix || $hook === $this->ms_admin_page_hook_suffix ) {
			wp_enqueue_style(
				'plfi-settings-page-style',
				plugins_url( Helper::get_stylesheet_uri( 'settings-page' ), PLFI_PLUGIN_FILE ),
				array( 'flexbox-grid-style', 'plfi-settings-ui-theme' )
			//, time()
			);

			wp_enqueue_script(
				'plfi-settings-page-script',
				plugins_url( Helper::get_script_uri( 'settings-page' ), PLFI_PLUGIN_FILE ),
				array( 'jquery', 'jquery-ui-tabs', 'common', 'wp-lists', 'postbox' ),
				false,
				true
			);
			$plfi = array(
				'nonces' => array(
					'save_plfi_settings'    => wp_create_nonce( 'save-plfi-plugin-settings' ),
					'ms_save_plfi_settings' => wp_create_nonce( 'ms-save-plfi-plugin-settings' )
				)
			);
			wp_localize_script( 'plfi-settings-page-script', 'plfi', $plfi );

			do_action( 'plfi_admin_enqueue_scripts' );
		}
	}

	public function admin_menu() {
		$this->admin_page_hook_suffix = add_media_page(
			$this->view_vars['plugin']->Name,
			__( 'Featured Image Settings', 'post-list-featured-image' ),
			'manage_options',
			Helper::get_settings_page_slug(),
			array( $this, 'render_plugin_admin_page' )
		);

		do_action( 'plfi_admin_menu' );
	}

	public function network_admin_menu() {
		$this->ms_admin_page_hook_suffix = add_submenu_page(
			'settings.php',
			$this->view_vars['plugin']->Name,
			__( 'PLFI Settings', 'post-list-featured-image' ),
			'manage_network_plugins',
			Helper::get_settings_page_slug(),
			array( $this, 'render_ms_plugin_admin_page' )
		);
	}

	public function register_settings() {
		register_setting(
			Helper::get_options_key(),
			Helper::get_options_key(),
			array( $this, 'settings_validate' )
		);

		// WHAT Settings Section
		add_settings_section(
			'plfi_list_table',
			__( 'Featured Image List Table Column', 'post-list-featured-image' ),
			'__return_false',
			Helper::get_plugin_settings_section()
		);

		add_settings_field(
			'thumb_size',
			__( 'Thumbnail Size', 'post-list-featured-image' ),
			array( $this, 'plugin_settings_fields' ),
			Helper::get_plugin_settings_section(),
			'plfi_list_table',
			array( 'field' => 'thumb_size' )
		);

		do_action( 'plfi_register_settings' );
	}

	public function settings_validate( $data ) {
		if ( empty( $data['thumb_size'] ) ) {
			$data['thumb_size'] = $this->default_thumb_size;
		}

		$data = apply_filters( 'plfi_settings_validate_data', $data );

		return $data;
	}

	public function plugin_settings_fields( $args = array() ) {
		if ( !empty( $args ) ) {
			switch ( $args['field'] ) {
				case 'thumb_size':
					$sizes = array( 150, $this->default_thumb_size, 50 );
					foreach ( $sizes as $size ) {
						if ( ( isset( $this->plugin_options['thumb_size'] ) && $this->plugin_options['thumb_size'] == $size ) ||
						     ( !isset( $this->plugin_options['thumb_size'] ) && $size == $this->default_thumb_size )
						) {
							$checked = ' checked="checked"';
						} else {
							$checked = '';
						}
						?>
						<input type="radio" name="plfi_plugin_settings[thumb_size]"
						       value="<?php echo $size; ?>"<?php echo $checked; ?>>
						<?php
						echo $size . ' x ' . $size . 'px<br>';
					}
					printf(
						'<div class="desc">%s</div>',
						__( 'The size of the featured image preview in post list table.', 'post-list-featured-image' )
					);
					break;
			}

			do_action( 'plfi_plugin_settings_fields', $args['field'] );
		}
	}

	/**
	 * Render meta box in plugin overview page.
	 *
	 * @param null  $obj  Unused
	 * @param array $args Arguments passed when calling add_meta_box
	 */
	public function admin_page_meta_boxes( $obj = null, $args = array() ) {
		extract( $args );
		switch ( $args['box'] ) {
			case 'author_news':
				View::instance()->make( 'plugin-author-news.php', $this->view_vars );
				break;
			case 'social':
				View::instance()->make( 'admin-page-social.php', $this->view_vars );
				break;
			case 'go_pro':
				View::instance()->make( 'admin-page-go-pro.php', $this->view_vars );
				break;
		}

		do_action( 'plfi_admin_page_meta_boxes', $args['box'] );
	}

	public function render_plugin_admin_page() {
		// Misc. var
		$this->view_vars['object'] = new \stdClass();

		// Main
		$main_metaboxes = $this->admin_page_main_meta_boxes();
		$this->add_meta_boxes( $main_metaboxes );

		// Sidebar
		$sidebar_metaboxes = $this->admin_page_sidebar_meta_boxes();
		$this->add_meta_boxes( $sidebar_metaboxes );

		// Tabs
		$tabs = TabsData::admin_page();
		$this->view_vars['tabs'] = array_filter( $tabs );

		$this->view_vars['help_content'] = TabsData::help_content();

		$this->view_vars['plugin_settings_section'] = Helper::get_plugin_settings_section();

		View::instance()->make(
		    array( 'PostListFeaturedImage/plugin-admin-page.php', 'plugin-admin-page.php' ),
		    $this->view_vars
		);
	}

	public function render_ms_plugin_admin_page() {
		// Misc. var
		$this->view_vars['object'] = new \stdClass();

		// Tabs
		$tabs = TabsData::ms_admin_page();
		$this->view_vars['tabs'] = array_filter( $tabs );

		// Main
		$main_metaboxes = $this->admin_page_main_meta_boxes();
		$this->add_meta_boxes( $main_metaboxes );

		// Sidebar
		$sidebar_metaboxes = $this->admin_page_sidebar_meta_boxes();
		$this->add_meta_boxes( $sidebar_metaboxes );

		View::instance()->make(
		    array( 'PostListFeaturedImage/plugin-admin-page.php', 'plugin-admin-page.php' ),
		    $this->view_vars
		);
	}

	protected function admin_page_main_meta_boxes() {
		$main_metaboxes = array(
			array(
				'id'            => 'author_news',
				'title'         => sprintf( __( '%s News', 'post-list-featured-image' ), $this->view_vars['plugin']->Author ),
				'callback'      => array( $this, 'admin_page_meta_boxes' ),
				'screen'        => 'post_list_featured_image_dashboard_main',
				'context'       => 'left',
				'priority'      => 'core',
				'callback_args' => array( 'box' => 'author_news' )
			)
		);

		if ( !Helper::is_plugin_active( 'plfi-pro-addon/plfi-pro-addon.php' ) ) {
			array_unshift(
				$main_metaboxes,
				array(
					'id'            => 'go_pro',
					'title'         => __(
						'Want more features? Get more control in the Pro Addon!',
						'post-list-featured-image'
					),
					'callback'      => array( $this, 'admin_page_meta_boxes' ),
					'screen'        => 'post_list_featured_image_dashboard_main',
					'context'       => 'left',
					'priority'      => 'core',
					'callback_args' => array( 'box' => 'go_pro' )
				)
			);
		}

		return apply_filters( 'plfi_admin_page_main_meta_boxes', $main_metaboxes );
	}

	protected function admin_page_sidebar_meta_boxes() {
		$sidebar_metaboxes = array(
			array(
				'id'            => 'plugin_useful',
				'title'         => __( 'Find the plugin useful?', 'post-list-featured-image' ),
				'callback'      => array( $this, 'admin_page_meta_boxes' ),
				'screen'        => 'post_list_featured_image_dashboard_sidebar',
				'context'       => 'right',
				'priority'      => 'core',
				'callback_args' => array( 'box' => 'social' )
			)
		);

		return apply_filters( 'plfi_admin_page_sidebar_meta_boxes', $sidebar_metaboxes );
	}

	protected function add_meta_boxes( $meta_boxes ) {
		foreach ( $meta_boxes as $meta_box ) {
			add_meta_box(
				$meta_box['id'],
				$meta_box['title'],
				$meta_box['callback'],
				$meta_box['screen'],
				$meta_box['context'],
				$meta_box['priority'],
				$meta_box['callback_args']
			);
		}
	}

	public function add_theme_support() {
		$this->supported_post_types = apply_filters( 'plfi_supported_post_types', $this->supported_post_types );

		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Display post/page featured image.
	 *
	 * @param $column_name string Current column in the loop.
	 * @param $id          int Current post id in the loop.
	 */
	public function posts_custom_columns( $column_name, $id ) {
		if ( $column_name === Helper::get_list_table_column_slug() ) {
			$attr = array(
				'data-imgid' => get_post_thumbnail_id( $id )
			);
			the_post_thumbnail( Helper::get_thumb_slug(), $attr );
		}
	}

	/**
	 * Alter query filter for list table by featured image.
	 *
	 * @param \WP_Query $query
	 */
	public function filter_list_table_by_featured_image( $query ) {
		global $pagenow;

		if ( !is_admin() ) {
			return;
		}

		$qv = & $query->query_vars;

		if ( $pagenow == 'edit.php' && !empty( $qv['post_type'] ) &&
		     in_array( $qv['post_type'], $this->supported_post_types )
		) {
			if ( empty( $_GET['plfi_filter'] ) ) {
				return;
			}

			if ( $_GET['plfi_filter'] == 'all' ) {
				$query->set( 'meta_key', '_thumbnail_id' );
			} else if ( $_GET['plfi_filter'] == 'none' ) {
				$query->set(
				      'meta_query',
				      array(
					      array(
						      'key'     => '_thumbnail_id',
						      'value'   => 'not exists',
						      'compare' => 'NOT EXISTS'
					      )
				      )
				);
			}
		}
	}

	public function list_table_customization() {
		if ( !empty( $this->supported_post_types ) ) {
			foreach ( $this->supported_post_types as $post_type ) {
				add_action( "manage_{$post_type}_posts_custom_column", array( $this, 'posts_custom_columns' ), 5, 2 );
				add_action( "restrict_manage_posts", array( $this, 'filter_list_table_by_featured_image_dropdown' ) );

				add_filter( "manage_{$post_type}_posts_columns", array( $this, 'posts_columns' ), 5, 2 );
				add_filter( "manage_edit-{$post_type}_sortable_columns", array( $this, 'post_sortable_columns' ) );
				add_filter( "pre_get_posts", array( $this, 'orderby_featured_image_title' ) );
				add_filter( "pre_get_posts", array( $this, 'filter_list_table_by_featured_image' ) );
			}
		}
	}

	public function save_plfi_plugin_settings() {
		check_ajax_referer( 'save-plfi-plugin-settings' );

		$new_settings = $_POST[Helper::get_options_key()];
		$is_ms        = ( isset( $_POST['is_ms'] ) && $_POST['is_ms'] === 'true' && is_multisite() && is_main_site() );

		$new_settings = apply_filters( 'plfi_pre_save_new_plugin_settings', $new_settings );
		$new_settings = !empty( $new_settings )
			? $new_settings
			: array();

		$settings = Model::instance()->save_plugin_settings( $new_settings, $is_ms );

		wp_send_json_success(
			array(
				'message'  => __( 'Settings Updated!', 'post-list-featured-image' ),
				'settings' => apply_filters( 'plfi_save_settings_json_success_response', $settings )
			)
		);
	}
	//</editor-fold>

	//<editor-fold desc="FILTER HANDLERS">
	/**
	 * Add "Settings" action link.
	 *
	 * @param $links array Default action links.
	 *
	 * @return mixed array Modified actions links.
	 */
	public function add_settings_link( $links ) {
		$plugin_settings_link = '<a href="upload.php?page=plfi-settings">' . __( 'Settings' ) . '</a>';
		$links = !empty( $links )
			? $links
			: array();
		array_unshift( $links, $plugin_settings_link );

		return $links;
	}

	public function add_network_settings_link( $links ) {
		$plugin_settings_link = '<a href="settings.php?page=plfi-settings">' . __( 'Settings' ) . '</a>';
		$links = !empty( $links )
			? $links
			: array();
		array_unshift( $links, $plugin_settings_link );

		return $links;
	}

	/**
	 * Add "Featured Image" label column.
	 *
	 * @param $defaults array Default column names.
	 *
	 * @return array An array of column names.
	 */
	public function posts_columns( $defaults ) {
		$defaults[Helper::get_list_table_column_slug()] = __( 'Featured Image' );

		return $defaults;
	}

	/**
	 * Add Featured Image column to sortable columns.
	 *
	 * @param array $columns All sortable columns.
	 *
	 * @return array The modified array of sortable columns.
	 */
	public function post_sortable_columns( $columns = array() ) {
		$columns[Helper::get_list_table_column_slug()] = Helper::get_list_table_column_slug();

		return $columns;
	}

	/**
	 * Order posts by featured image id
	 *
	 * @param \WP_Query $query
	 */
	public function orderby_featured_image_title( $query ) {
		if ( !is_admin() ) {
			return;
		}

		$order_by = $query->get( 'orderby' );

		if ( $order_by === Helper::get_list_table_column_slug() ) {
			$query->set( 'meta_key', '_thumbnail_id' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}

	/**
	 * Add select dropdown filter in post list table.
	 */
	public function filter_list_table_by_featured_image_dropdown() {
		global $wp_query, $typenow;

		if ( in_array( $typenow, $this->supported_post_types ) ) {
			$post_type = get_post_type_object( $typenow );
			?>
			<select class="postform" id="plfi_filter" name="plfi_filter" style="max-width: 320px;width: auto;">
				<option value="default"><?php printf(
						__( 'Show All %s with|without Featured Images', 'post-list-featured-image' ),
						$post_type->label
					); ?></option>
				<option value="all"><?php printf(
						__( 'Show All %s with Featured Image', 'post-list-featured-image' ),
						$post_type->label
					); ?></option>
				<option value="none"><?php printf(
						__( 'Show All %s without Featured Image', 'post-list-featured-image' ),
						$post_type->label
					); ?></option>
			</select>
		<?php
		}
	}
	//</editor-fold>

	//<editor-fold desc="METHODS">
	public function get_supported_post_types() {
		return $this->supported_post_types;
	}
	//</editor-fold>
}
