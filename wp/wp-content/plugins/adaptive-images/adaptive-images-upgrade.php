<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      PLUGIN UPGRADE FUNCTIONS                                                                                  *
     *      ========================                                                                                  *
     *                                                                                                                *
     *      Nevma (info@nevma.gr)                                                                                     *
     *                                                                                                                *
     *                                                                                                                *
     ******************************************************************************************************************/



    // Exit, if file is accessed directly.

    if ( ! defined( 'ABSPATH' ) ) {

        exit; 

    }



    /**
     * Checks if the plugin has actually been upgraded and acts accordingly for each version.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_upgrade_action_upgraded () {

        $options = get_option( 'adaptive-images' );



        // Perhaps the previous version was 0.2.08 or earlier, where the options were a bit of a mess.

        if ( ! $options && get_option( 'wprxr_include_paths', FALSE ) !== FALSE ) {

            // Fake the options array of version 0.2.08.

        	$options = array( 'version' => '0.2.08' );

        }

        // If actually a fresh install, then nothing more is necessary.
        
        if ( ! $options ) {

        	return;

        }



        // Check if we have just upgraded from a lower version.

        $previous_version = $options['version'];
        $current_version  = adaptive_images_plugin_get_version();
        $plugin_upgraded  = strcmp( $previous_version, $current_version ) < 0; 

        if ( ! $plugin_upgraded ) {

            return;

        }



        // General plugin updated message.

        add_action( 'admin_notices', 'adaptive_images_upgrade_message_upgraded' );

        

        // Check if upgrading from version 0.2.08 which needs some special handling.

        if ( $previous_version == '0.2.08' ) {
            
            adaptive_images_upgrade_action_upgraded_from_v0208();

            add_action( 'admin_notices', 'adaptive_images_upgrade_message_upgraded_from_v0208' );

        }



        // Check if upgrading to version 0.5.0 to show a nice informative message.

        if ( $current_version == '0.5.0' ) {

            add_action( 'admin_notices', 'adaptive_images_upgrade_message_upgraded_to_v050' );
            
        }



        // Save current version in plugin settings.
        
        $options['version'] = $current_version;
        update_option( 'adaptive-images', $options );

    }



    /**
     * Performs actions related to upgrading from version 0.2.08 because from that version and on major code and 
     * settings changes took place.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_upgrade_action_upgraded_from_v0208 () {

        // Try to remove old htaccess entry.

        $htaccess = adaptive_images_plugin_get_htaccess_file_path();

        $htaccess_available = adaptive_images_plugin_is_htaccess_writeable();

        if ( $htaccess_available ) {

            $htaccess_old_contents = file_get_contents( $htaccess );
            $htaccess_new_contents = preg_replace( '/# Adaptive Images.*# END Adaptive Images\n/s', '', $htaccess_old_contents );

            @file_put_contents( $htaccess, $htaccess_new_contents );

        }



        // Try to remove old cache directory.

        $old_cache_path = realpath( dirname( $_SERVER['SCRIPT_FILENAME'] ) . '/../wp-content/' ) . '/cache-ai/';

        adaptive_images_actions_rmdir_recursive( $old_cache_path );



        // Try to remove old options.

        delete_option( 'wprxr_include_paths' );
        delete_option( 'wprxr_ai_config' );

    }



    /**
     * Adds the admin notice message that informs the user when the plugin has been generally upgraded.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_upgrade_message_upgraded () {

        $current_version = adaptive_images_plugin_get_version();

        echo 
            '<div class = "updated settings-error notice is-dismissible adaptive-images-settings-error">' .
                '<p>' . 
                    'Adaptive Images &mdash; Upgraded' . 
                '</p>' . 
                '<hr />' . 
                '<p>' . 
                    'The Adaptive Images plugin has been succesfully updated to version ' . $current_version . '. Perhaps you would like to review its <a href = "options-general.php?page=adaptive-images">Settings</a>.' .
                '</p>' . 
            '</div>';

    }



    /**
     * Adds the admin notice message that informs the user when the pluggin has been upgraded from version 0.2.08, 
     * where major code and settings changes took place and the user settings need to be manually updated. 
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_upgrade_message_upgraded_from_v0208 () {

        $current_version = adaptive_images_plugin_get_version();

        echo 
            '<div class = "updated settings-error notice is-dismissible adaptive-images-settings-error">' .
                '<p>' . 
                    'Adaptive Images &mdash; Upgrade notice' . 
                '</p>' . 
                '<hr />' . 
                '<p>' . 
                    'The Adaptive Images plugin has been recently updated to version ' . $current_version . '.' .
                '</p>' . 
                '<p>' .
                    'You should probably save your settings once again in <a href = "options-general.php?page=adaptive-images">Adaptive Images Settings</a>, because since version 0.2.08 major rewrites of the code have taken place.' .
                '</p>' .
                '<p>' .
                    'We are very sorry for the inconvenience and we promise to keep a steady path from now on.'. 
                '</p>' . 
            '</div>';

    }



    /**
     * Adds the admin notice message that informs the user when the pluggin has been upgraded to version 0.3.0, which 
     * has a major rewrite and the user settings needed to be manually updated. It is done via an  admin notice and 
     * not via the settings errors, because in some pages the settings errors are called by the system itself and this
     * results in being called multiple times.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_upgrade_message_upgraded_to_v050 () {

        $current_version = adaptive_images_plugin_get_version();

        echo 
            '<div class = "updated settings-error notice is-dismissible adaptive-images-settings-error">' .
                '<p>' . 
                    'Adaptive Images &mdash; New version ' . $current_version .
                '</p>' . 
                '<hr />' . 
                '<p>' . 
                    'Version ' . $current_version . ' has some very interesting new features. Go to <a href = "options-general.php?page=adaptive-images">Adaptive Images Settings</a> to check them out.' .
                '</p>' . 
            '</div>';

    }

?>