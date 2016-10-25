<?php
namespace PostListFeaturedImage\Controller;

use PLFIProAddon\Lib\Debugger;
use PostListFeaturedImage\Lib\Helper;

if ( !defined( 'ABSPATH' ) || preg_match( '#' . basename( __FILE__ ) . '#',
                                          $_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}

class View {

	protected static $instance;

	public static function instance() {
		null === self::$instance && self::$instance = new self;

		return self::$instance;
	}

	public function __construct() {

	}

	public function make( $templates, $vars = array(), $load = true, $require_once = true ) {
		$vars = apply_filters( 'plfi_view_make_vars', $vars );
		
		if ( !empty( $vars ) ) {
			extract( $vars, EXTR_SKIP );
		}

		$located = locate_template( $templates );

		if ( empty( $located ) ) {
            foreach ( (array) $templates as $template ) {
                if ( !$template ) {
                    continue;
                }
                if ( file_exists( PLFI_PLUGIN_DIR_PATH . 'PostListFeaturedImage/View/' . $template ) ) {
                    $located = PLFI_PLUGIN_DIR_PATH . 'PostListFeaturedImage/View/' . $template;
                    break;
                }
            }
        }

        if ( $load && '' != $located ) {
            if ( $require_once ) {
                require_once( $located );
            } else {
                require( $located );
            }
        }

        return $located;
	}
}
