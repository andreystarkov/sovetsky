<?php
namespace PostListFeaturedImage;

use PostListFeaturedImage\Lib\Helper;
use PostListFeaturedImage\Lib\Debugger;

if ( !defined( 'ABSPATH' ) || preg_match(
        '#' . basename( __FILE__ ) . '#',
        $_SERVER['PHP_SELF']
    )
) {
    die( "You are not allowed to call this page directly." );
}

class Model {

    protected static $instance;
	
	protected $ms_plugin_options;
	
	protected $plugin_options;

    public static function instance() {
        null === self::$instance && self::$instance = new self;

        return self::$instance;
    }

    public function __construct() {
	    $options_key             = Helper::get_options_key();
	    $this->plugin_options    = get_option( $options_key );
	    $this->ms_plugin_options = get_site_option( "ms_$options_key" );
    }

	public function save_plugin_settings( $new_settings = array(), $is_ms = false ) {
		$new_settings = $_POST[Helper::get_options_key()];
		$is_ms        = ( isset( $_POST['is_ms'] ) && $_POST['is_ms'] === 'true' && is_multisite() && is_main_site() );

		$new_settings = apply_filters( 'plfi_save_new_plugin_settings', $new_settings );
		$new_settings = !empty( $new_settings )
			? $new_settings
			: array();

		if ( $is_ms ) {
			$settings = $this->ms_plugin_options = $new_settings;

			update_site_option( 'ms_' . Helper::get_options_key(), $this->ms_plugin_options );
		} else {
			$settings = $this->plugin_options = $new_settings;

			$this->plugin_options = array_merge( $this->plugin_options, $new_settings );

			update_option( Helper::get_options_key(), $this->plugin_options );
		}
		
		return $settings;
	}
}
