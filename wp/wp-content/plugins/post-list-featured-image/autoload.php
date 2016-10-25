<?php
if ( !defined( 'ABSPATH' ) || preg_match(
        '#' . basename( __FILE__ ) . '#',
        $_SERVER['PHP_SELF']
    )
) {
    die( "You are not allowed to call this page directly." );
}

class Post_List_Featured_Image_Loader
{

    public static function init()
    {
        spl_autoload_register( array( 'Post_List_Featured_Image_Loader', 'autoload' ) );

        register_activation_hook(
            PLFI_PLUGIN_FILE,
            array( 'Post_List_Featured_Image_Loader', 'activationActions' )
        );
        register_deactivation_hook(
            PLFI_PLUGIN_FILE,
            array( 'Post_List_Featured_Image_Loader', 'deactivationActions' )
        );

        add_action( 'plugins_loaded', array( 'Post_List_Featured_Image_Loader', 'initControllers' ) );
    }

    public static function autoload( $class )
    {
        if ( 'PostListFeaturedImage' !== mb_substr( $class, 0, 21 ) ) {
            return;
        }

        $file = PLFI_PLUGIN_DIR_PATH . str_replace( '\\', '/', $class ) . '.php';
        if ( file_exists( $file ) ) {
            require_once $file;
        }
    }

    public static function initControllers()
    {
        \PostListFeaturedImage\Controller\Admin::instance()->init();
        \PostListFeaturedImage\Controller\Front::instance()->init();
    }

    /**
     * Run plugin activation routine
     */
    public static function activationActions()
    {
        flush_rewrite_rules();
    }

    /**
     * Run deactivation routine
     */
    public static function deactivationActions()
    {
        flush_rewrite_rules();
    }
}

Post_List_Featured_Image_Loader::init();
