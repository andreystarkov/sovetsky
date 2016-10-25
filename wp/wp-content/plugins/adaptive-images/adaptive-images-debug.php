<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      PLUGIN DEBUG/DIAGNOSTIC FUNCTIONS                                                                         *
     *      =================================                                                                         *
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
     * Prints useful debug information for the plugin.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param bool $echo Whether to echo the result or return it as a string.
     * 
     * @return Nothing really!
     */

    function adaptive_images_debug_general_info ( $echo = true ) {

        $options = get_option( 'adaptive-images' );

        $icons = array( 'true' => '&#10004;', 'false' => '&#10006;', 'debug' => '&#10070;' );

        

        // PHP GD image library debug info.

        $gd_extenstion_installed = adaptive_images_plugin_is_gd_extension_installed();

        $message = 
            '<p>' . 
                ( $gd_extenstion_installed ? $icons['true'] : $icons['false'] ) . 
                ' PHP GD library is ' . ( $gd_extenstion_installed ? '' : 'not ' ) . ' installed.' . 
            '</p>';



        // Image cache directory debug info.

        $cache_path = adaptive_images_plugin_get_cahe_directory_path();

        $cache_path_exists = file_exists( $cache_path );

        $message .= 
            '<p>' .
                ( $cache_path_exists ? $icons['true'] : $icons['false'] ) . 
                ' Image cache directory has ' . ( $cache_path_exists ? '' : 'not ' ) . 'been created.' .
            '</p>' .
            ( 
                $cache_path_exists ? 

                    '<blockquote><p>' .
                        '<code>' . 
                            $cache_path . ' => ' . 
                            adaptive_images_plugin_file_permissions( $cache_path ) . 
                        '</code>' .
                    '</p></blockquote>' : 
               
                    '<blockquote><p>' .
                        ( 
                            ! $cache_path_exists && is_writable( dirname( $cache_path ) ) ? 
                                'But this is probably because the cache has not been accessed yet. <br />' . 
                                'After accessing your website from a mobile device the directory should be automatically created.' . 
                                '<br /><br />' : 
                                'It seems that the directory is not writeable. This is probably a filesystem permissions issue. <br />' . 
                                ' Consider adding manually the image cache directory: &quot;/wp-content/cache/adaptive-images&quot;.' . 
                                '<br /><br />' 
                        ) . 
                        '<code>' . 
                            dirname( $cache_path ) . ' => ' . 
                            adaptive_images_plugin_file_permissions( dirname( $cache_path ) ) . 
                        '</code>' .
                    '</p></blockquote>'
            );



        // Check .htaccess file availability

        $htaccess = adaptive_images_plugin_get_htaccess_file_path();

        $htaccess_ok        = adaptive_images_actions_is_htaccess_ok();
        $htaccess_writeable = adaptive_images_plugin_is_htaccess_writeable();

        $message .= 
            '<p>' .
                ( $htaccess_ok ? $icons['true'] : $icons['false'] ) . 
                ' Installation .htaccess file is ' . ( $htaccess_ok ? 'setup OK.' : 'not properly setup.' ) . 
            '</p>' .
            ( 
                $htaccess_writeable ? 

                    '<blockquote><p>' .
                        '<code>' . 
                            $htaccess . ' => ' . adaptive_images_plugin_file_permissions( $htaccess ) . 
                        '</code>' . 
                    '</p></blockquote>' : 

                    '<blockquote><p>' .
                        'The .htaccess file is not writeable so it might have not been updated.' . 
                        '<br /><br />' . 
                        '<code>' . 
                            $htaccess . ' => ' . 
                            adaptive_images_plugin_file_permissions( $htaccess ) . 
                        '</code>' .
                    '</p></blockquote>'
            );



        // Image cache settings dump.

        $message .= '<p>' . $icons['debug'] . ' Adaptive images settings dump:</p>';

        $message .= '<blockquote><pre>';
        ob_start();
        var_dump( $options );
        $message .= ob_get_clean();
        $message .= '</pre></blockquote>';



        // Echo debug info or return it.

        if ( $echo ) {
            
            echo $message;

        } else {

            return $message;

        }

    }



    /**
     * Gets all kinds of system installation info. Kudos to WP-Migrate-DB and Send-System-Info plugins for the most of 
     * this.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void Nothing really!
     */

    function adaptive_images_debug_diagnostic_info ( $echo = true ) {

        global $table_prefix;
        global $wpdb;



        // Collect diagnostic information.

        $debug = array();

        $debug['Web Server']          = esc_html( $_SERVER['SERVER_SOFTWARE']  );
        $debug['Document Root']       = esc_html( $_SERVER['DOCUMENT_ROOT']  );

        $debug['PHP']                 = esc_html( phpversion() );
        $debug['PHP Time Limit']      = esc_html( ini_get( 'max_execution_time' ) );
        $debug['PHP Memory Limit']    = esc_html( ini_get( 'memory_limit' ) );
        $debug['PHP Post Max Size']   = esc_html( ini_get( 'post_max_size' ) );
        $debug['PHP Upload Max Size'] = esc_html( ini_get( 'upload_max_filesize' ) );
        $debug['PHP Max Input Vars']  = esc_html( ini_get( 'max_input_vars' ) );
        $debug['PHP Display Errors']  = esc_html( ini_get( 'display_errors' ) ? 'Yes' : 'No' );
        $debug['PHP Error Log']       = esc_html( ini_get( 'error_log' ) );
        
        $debug['MySQL']               = esc_html( empty( $wpdb->use_mysqli ) ? 
            mysql_get_server_info() : 
            mysqli_get_server_info( $wpdb->dbh ) 
        );
        $debug['MySQL Ext/mysqli']   = empty( $wpdb->use_mysqli ) ? 'No' : 'Yes';
        $debug['MySQL Table Prefix'] = esc_html( $table_prefix );
        $debug['MySQL DB Charset']   = esc_html( DB_CHARSET );
        
        $debug['WP']                 = get_bloginfo( 'version' );
        $debug['WP Multisite']       = ( is_multisite() ) ? 'Yes' : 'No';
        $debug['WP Debug Mode']      = esc_html( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? 'Yes' : 'No' );
        $debug['WP Site url']        = esc_html( site_url() );
        $debug['WP WP Home url']     = esc_html( home_url() );
        $debug['WP Permalinks']      = esc_html( get_option( 'permalink_structure' ) );
        $debug['WP home path']       = esc_html( get_home_path() );
        $debug['WP content dir']     = esc_html( WP_CONTENT_DIR );
        $debug['WP plugin dir']      = esc_html( WP_PLUGIN_DIR );
        $debug['WP content url']     = esc_html( WP_CONTENT_URL );
        $debug['WP plugin url']      = esc_html( WP_PLUGIN_URL );
        $debug['WP Locale']          = esc_html( get_locale() );
        $debug['WP Memory Limit']    = esc_html( WP_MEMORY_LIMIT );
        $debug['WP Max Upload Size'] = esc_html( adaptive_images_plugin_file_size_human( wp_max_upload_size() ) );



        // Active system plugins.

        $active_plugins = ( array ) get_option( 'active_plugins', array() );

        $active_plugins_output = '';

        foreach ( $active_plugins as $plugin ) {

            $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );

            $active_plugins_output .= 
                $plugin_data['Name'] . 
                ' v.' . $plugin_data['Version'] . 
                ' by ' . $plugin_data['AuthorName'] . 
                '<br />';

        }

        $debug['WP Active plugins'] = $active_plugins_output;



        // Multisite (network) plugins.

        if ( is_multisite() ) {

            $network_active_plugins = wp_get_active_network_plugins();

            $active_plugins_output = '';

            if ( count( $network_active_plugins ) > 0 ) {

                foreach ( $network_active_plugins as $plugin ) {

                    $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );

                    $active_plugins_output .= 
                        $plugin_data['Name'] . 
                        ' v.' . $plugin_data['Version'] . 
                        ' by ' . $plugin_data['AuthorName'] . 
                        '<br />';
                }
            }

            $debug['WP Network active plugins'] = $active_plugins_output;

        }



        // Must-use plugins.

        $mu_plugins = wp_get_mu_plugins();

        $active_plugins_output = '';

        if ( count( $mu_plugins ) > 0 ) {
            
            foreach ( $mu_plugins as $plugin ) {

                $plugin_data = get_plugin_data( $plugin );

                $active_plugins_output .= 
                    $plugin_data['Name'] . 
                    ' v.' . $plugin_data['Version'] . 
                    ' by ' . $plugin_data['AuthorName'] . 
                    '<br />';
            }
        }

        $debug['WP MU plugins'] = $active_plugins_output;



        // Create diagnostic output HTML table.

        $debug_output = '<table><tbody>';

        foreach ( $debug as $key => $value ) {

            $debug_output .= 
                '<tr>' . 
                    '<td style = "vertical-align: top; whitespace: nowrap; padding-right: 5px;">' . $key . '</td>' . 
                    '<td><p style = "margin: 0; padding: 0 0 2px 0;">' . $value . '</p></td>' . 
                '</tr>';
            
        }

        $debug_output .= '</tbody></table>';



        // Echo debug info or return it.

        if ( $echo ) {
            
            echo $debug_output;

        } else {

            return $debug_output;

        }
    }

?>