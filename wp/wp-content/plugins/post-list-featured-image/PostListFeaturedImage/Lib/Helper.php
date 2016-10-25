<?php
namespace PostListFeaturedImage\Lib;

if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}

class Helper {

	public static function get_plugin_data( $file = __FILE__ ) {
		$default_headers = array(
			'Name'        => 'Plugin Name',
			'PluginURI'   => 'Plugin URI',
			'Version'     => 'Version',
			'Description' => 'Description',
			'Author'      => 'Author',
			'AuthorURI'   => 'Author URI',
			'TextDomain'  => 'Text Domain',
			'DomainPath'  => 'Domain Path',
			'Network'     => 'Network',
			// Site Wide Only is deprecated in favor of Network.
			'_sitewide'   => 'Site Wide Only',
		);

		return (object) get_file_data( $file, $default_headers, 'plugin' );
	}

	public static function array_except( $array, $keys ) {
		return array_diff_key( $array, array_flip( (array) $keys ) );
	}

	public static function is_plugin_active( $plugin ) {
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) ||
		       self::is_plugin_active_for_network( $plugin );
	}

	public static function is_plugin_active_for_network( $plugin ) {
		if ( !is_multisite() ) {
			return false;
		}

		$plugins = get_site_option( 'active_sitewide_plugins' );
		if ( isset( $plugins[$plugin] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get the stylesheet URI.
	 *
	 * <br><b>Note:</b> <i>If you want to include your own stylesheets, provide the URI to the minified version only
	 * but make sure the non-minified version can also be found in the same location.</i>
	 *
	 * <br><b>Required file name format:</b> [stylesheet_name]<b>.min.css</b>
	 *
	 * @param string $handle The array key of the stylesheet.
	 *
	 * @return mixed|void|\WP_Error The stylesheet URI on success or WP_Error if <b>$handle</b> doesn't exist.
	 */
	public static function get_stylesheet_uri( $handle ) {
		$styles = array(
			'settings-page'  => 'styles/settings-page-style.min.css',
			'flexbox-grid'   => 'styles/flexboxgrid.min.css'
		);

		$styles = apply_filters( 'plfi_styles_path', $styles );

		if ( !array_key_exists( $handle, $styles ) ) {
			return new \WP_Error( __( 'ERROR: file not found.', 'post-list-featured-image' ) );
		}

		$style = $styles[$handle];
		if ( defined( 'POST_LIST_FEATURED_IMAGE_DEBUG' ) && POST_LIST_FEATURED_IMAGE_DEBUG ) {
			$style = apply_filters(
				'plfi_styles_debug_mode',
				str_replace( '.min.css', '.css', $style )
			);
		}

		return apply_filters( 'plfi_get_stylesheet_uri', $style, $handle );
	}

	/**
	 * Get the script URI.
	 *
	 * <br><b>Note:</b> <i>If you want to include your own scripts, provide the URI to the minified version only
	 * but make sure the non-minified version can also be found in the same location.</i>
	 *
	 * <br><b>Required file name format:</b> [script_name]<b>.min.js</b>
	 *
	 * @param string $handle The array key of the script.
	 *
	 * @return mixed|void|\WP_Error The script URI on success or WP_Error if <b>$handle</b> doesn't exist.
	 */
	public static function get_script_uri( $handle ) {
		$scripts = array(
			'settings-page' => 'scripts/settings-page-script.min.js'
		);

		$scripts = apply_filters( 'plfi_scripts_path', $scripts );

		if ( !array_key_exists( $handle, $scripts ) ) {
			return new \WP_Error( __( 'ERROR: file not found.', 'post-list-featured-image' ) );
		}

		$script = $scripts[$handle];
		if ( defined( 'POST_LIST_FEATURED_IMAGE_DEBUG' ) && POST_LIST_FEATURED_IMAGE_DEBUG ) {
			$script = apply_filters(
				'plfi_scripts_debug_mode',
				str_replace( '.min.js', '.js', $script )
			);
		}

		return apply_filters( 'plfi_get_script_uri', $script, $handle );
	}

	/**
	 * Based on WP's do_settings_sections()
	 *
	 * @see do_settings_sections
	 *
	 * @param string $page The slug name of the page whos settings sections you want to output
	 */
	public static function do_settings_sections( $page ) {
		global $wp_settings_sections, $wp_settings_fields;

		if ( !isset( $wp_settings_sections[$page] ) ) {
			return;
		}

		foreach ( (array) $wp_settings_sections[$page] as $section ) {
			if ( $section['title'] ) {
				echo "<h3>{$section['title']}</h3>\n";
			}

			if ( $section['callback'] ) {
				call_user_func( $section['callback'], $section );
			}

			if ( !isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) ) {
				continue;
			}
			echo '<div><table class="form-table">';
			do_settings_fields( $page, $section['id'] );
			echo '</table></div>';
		}
	}

	public static function get_options_key() {
		return 'plfi_plugin_settings';
	}

	public static function get_plugin_settings_section() {
		return 'plfi-plugin-settings-section';
	}

	public static function get_list_table_column_slug() {
		return 'featured_image';
	}

	public static function get_thumb_slug() {
		return 'admin-thumbs';
	}

	public static function get_settings_page_slug() {
		return 'plfi-settings';
	}
}
