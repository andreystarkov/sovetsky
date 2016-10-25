<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      THIS FILE HOLDS ALL THE INCLUDES, ACTIONS AND FILTERS NECESSARY                                           *
     *      ===============================================================                                           *
     *                                                                                                                *
     *      Nevma (info@nevma.gr)                                                                                     *
     *                                                                                                                *
     *                                                                                                                *
     ******************************************************************************************************************/



    // Exit, if file is accessed directly.

    if ( ! defined( 'ABSPATH' ) ) {

        exit; 

    }



    // Include the plugin PHP files in the correct order.

    require_once( 'adaptive-images-plugin.php' );
    require_once( 'adaptive-images-actions.php' );
    require_once( 'adaptive-images-upgrade.php' );
    require_once( 'adaptive-images-admin.php' );
    require_once( 'adaptive-images-front.php' );
    require_once( 'adaptive-images-debug.php' );



    // Update installation htaccess when plugin is activated.

    register_activation_hook( 
        adaptive_images_plugin_get_name(), 
        'adaptive_images_actions_update_htaccess' 
    );

    // Restore installation htaccess when plugin is deactivated.

    register_deactivation_hook( 
        adaptive_images_plugin_get_name(), 
        'adaptive_images_actions_restore_htaccess' 
    );
    


    // Adds the action which registers the plugin settings.

    add_action( 'admin_init', 'adaptive_images_admin_register_settings' );

    // Adds a filter which adds the plugin settings link to the pugin links.

    add_filter( 
        'plugin_action_links_' . adaptive_images_plugin_get_name(), 
        'adaptive_images_admin_add_plugin_settings_link' 
    ); 

    // Adds a filter which adds the support page link to the additional links of the plugin.

    add_filter( 'plugin_row_meta', 'adaptive_images_admin_add_row_meta', 10, 2 );


    
    // Adds the action which adds the plugin settings page.

    add_action( 'admin_menu', 'adaptive_images_admin_add_options_page' );



    // Adds the action which checks for plugin upgrades.

    add_action( 'admin_head', 'adaptive_images_admin_show_admin_css' );

    // Adds the action which checks for plugin upgrades.

    add_action( 'admin_head', 'adaptive_images_upgrade_action_upgraded' );

    // Adds the action which checks the PHP GD image library availability.

    add_action( 'admin_head', 'adaptive_images_actions_check_gd_available' );

    // Cheks whether the plugin settings have been saved yet or not.
    
    add_action( 'admin_head', 'adaptive_images_actions_check_settings_saved' );

    // Adds the action which checks the PHP GD image library availability.

    add_action( 'admin_head', 'adaptive_images_actions_check_htaccess_ok' );



    // Sets up the cookie generating Javascript in the head element of the theme.

    add_action( 'wp_head', 'adaptive_images_front_head_cookie_javascript', 0 );

    // Sets up the Javascript in the head element of the theme which adds a URL parameter to images for CDNs.

    add_action( 'wp_head', 'adaptive_images_front_head_image_cdn_javascript', 0 );

?>