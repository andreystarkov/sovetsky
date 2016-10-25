<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      INCLUDED AS-IS WHEN THE PLUGIN IS UNINSTALLED                                                             *
     *      =============================================                                                             *
     *                                                                                                                *
     *      Nevma (info@nevma.gr)                                                                                     *
     *                                                                                                                *
     *                                                                                                                *
     ******************************************************************************************************************/



    // Exit, if file is accessed directly.

    if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {

        exit();

    }



    // Include important plugin functions.

    require_once( 'adaptive-images-plugin.php' );
    require_once( 'adaptive-images-actions.php' );



    // Attempt to cleanup the cache.

    $cache_path = adaptive_images_plugin_get_cahe_directory_path();
    adaptive_images_actions_rmdir_recursive( $cache_path );



    // Cleanup possible leftover options from version 0.2.08. 

    delete_option( 'wprxr_include_paths' );
    delete_option( 'wprxr_ai_config' );



    // Cleanup current plugin options. 

    delete_option( 'adaptive-images' );

?>