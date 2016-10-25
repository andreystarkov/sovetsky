<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      ALL FUNCTIONS RELEVANT TO THE GENERAL PLUGIN FUNCTIONS                                                    *
     *      ======================================================                                                    *
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
     * Returns the adaptive images default user settings as an associative array.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return array The associative array with the default user settings!
     */

    function adaptive_images_plugin_get_default_settings () {

        return array(
            'resolutions'         => array( 1024, 640, 480 ),
            'landscape'           => FALSE,
            'hidpi'               => FALSE,
            'cdn-support'         => FALSE,
            'cache-directory'     => 'cache/adaptive-images',
            'watched-directories' => array( 'wp-content/uploads', 'wp-content/themes' ),
            'jpeg-quality'        => 75,
            'sharpen-images'      => TRUE,
            'watch-cache'         => TRUE,
            'browser-cache'       => 180
        );

    }



    /**
     * Checks if the given option is not set and returns its default value.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param array  $options The associative array that holds the given options, which should be passed by reference
     *                        so it can be directly altered as necessary.
     * 
     * @param string $key     The name of the option to check if is set.
     * 
     * @return mixed The current value of the option if it is set or its default value if it is not set.
     */

    function adaptive_images_plugin_check_empty_setting ( &$options, $key ) {

        if ( ! isset( $options[$key] ) )  {

            $defaults = adaptive_images_plugin_get_default_settings();

            $options[$key] = $defaults[$key];

        }

    }



    /**
     * Returns the name of the plugin for usage in activations hooks and so on.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The name of the plugin which is the directory slash the main PHP file.
     */

    function adaptive_images_plugin_get_name () {

        return dirname( plugin_basename( __FILE__ ) ) . '/adaptive-images.php';

    }



    /**
     * Returns the full path to the plugin main PHP file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The full path to the plugin the main PHP file.
     */

    function adaptive_images_plugin_get_path () {

        return dirname( __FILE__ ) . '/adaptive-images.php';

    }



    /**
     * Returns the full path to the plugin main PHP file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The full path to the plugin the main PHP file.
     */

    function adaptive_images_plugin_get_version () {

        $plugin_data = get_plugin_data( adaptive_images_plugin_get_path() );
        
        return $plugin_data['Version'];

    }



    /**
     * Returns the path to the user settings PHP file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The path to the user settings PHP file!
     */

    function adaptive_images_plugin_get_cahe_directory_path () {

        $options = get_option( 'adaptive-images' );

        return ( $options && $options['cache-directory'] ) ? trailingslashit( WP_CONTENT_DIR ) . $options['cache-directory'] : '-';

    }


    
    /**
     * Returns the plugin options array from the database.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return array|boolean The plugin options form the database.
     */

    function adaptive_images_plugin_get_options () {

        return get_option( 'adaptive-images' );

    }


    
    /**
     * Returns whether the plugin options have been set in the database.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return boolean Whether the plugin options are set or not.
     */

    function adaptive_images_plugin_are_options_set () {

        return get_option( 'adaptive-images' ) !== false ;

    }


    
    /**
     * Returns the path to the installation htaccess file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The path to the installation htaccess file!
     */

    function adaptive_images_plugin_get_htaccess_file_path () {

        return get_home_path() . '.htaccess';

    }


    
    /**
     * Checks whether the installation .htaccess file is actually writable.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return boolean Whether the installation htaccess file is actually writable.
     */

    function adaptive_images_plugin_is_htaccess_writeable () {

        $htaccess = adaptive_images_plugin_get_htaccess_file_path();

        return
            ( ! file_exists( $htaccess ) && @fopen( $htaccess, 'w' ) ) ||
            (   file_exists( $htaccess ) && is_writable( $htaccess ) );

    }


    
    /**
     * Returns the path to the user settings PHP file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The path to the user settings PHP file!
     */

    function adaptive_images_plugin_get_user_settings_file_path () {

        return plugin_dir_path( __FILE__ ) . 'user-settings.php';
        return plugin_dir_path( __FILE__ ) . 'adaptive-images/ai-user-settings.php';

    }


    
    /**
     * Checks whether the PHP GD image library is installed.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return boolean Whether the PHP GD image library is installed.
     */

    function adaptive_images_plugin_is_gd_extension_installed () {

        return extension_loaded( 'gd' ) && function_exists( 'gd_info' );

    }


    
    /**
     * Checks whether a given path is inside the WordPress installation.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return boolean Whether the given path is inside the Wordpress isntallation.
     */

    function adaptive_images_plugin_is_file_in_wp ( $path ) {

        $home_path = get_home_path();

        return strpos( trailingslashit( $path ), $home_path ) !== 0 && $path != $home_path;

    }


    
    /**
     * Checks whether a given path is inside the WordPress /wp-content directory.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return boolean Whether the given path is inside /wp-content.
     */

    function adaptive_images_plugin_is_file_in_wp_content ( $path ) {

        $wp_content = trailingslashit( WP_CONTENT_DIR );

        return strpos( trailingslashit( $path ), $wp_content ) !== 0 && $path != $wp_content;

    }


    
    /**
     * Returns a human readable string for the permissions of a given file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param string $file The file whose permissions we are checking;
     * 
     * @return string The file permissions in the usual UNIX format (like -rwxr--r--).
     */

    function adaptive_images_plugin_file_permissions ( $file ) {

        if ( ! file_exists( $file ) ) {

            return '';

        }

        // Get file permissions number.

        $permissions = fileperms( $file );



        // Analyze the file permissions number.

        if ( ( $permissions & 0xC000 ) == 0xC000 ) {

            $info = 's'; // Socket.

        } elseif ( ( $permissions & 0xA000 ) == 0xA000 ) {
            
            $info = 'l'; // Symbolic Link.

        } elseif ( ( $permissions & 0x8000 ) == 0x8000 ) {

            $info = '-'; // Regular
            
        } elseif ( ( $permissions & 0x6000 ) == 0x6000 ) {

            $info = 'b'; // Block special.

        } elseif ( ( $permissions & 0x4000 ) == 0x4000 ) {

            $info = 'd'; // Directory.

        } elseif ( ( $permissions & 0x2000 ) == 0x2000 ) {

            $info = 'c'; // Character special.

        } elseif ( ( $permissions & 0x1000 ) == 0x1000 ) {

            $info = 'p'; // FIFO pipe.

        } else {

            $info = 'u'; // Unknown.

        }



        // User part.

        $info .= ( ( $permissions & 0x0100 ) ? 'r' : '-' );
        $info .= ( ( $permissions & 0x0080 ) ? 'w' : '-' );
        $info .= ( ( $permissions & 0x0040 ) ?
                    ( ( $permissions & 0x0800 ) ? 's' : 'x' ) :
                    ( ( $permissions & 0x0800 ) ? 'S' : '-' ) );

        

        // Group part.

        $info .= ( ( $permissions & 0x0020 ) ? 'r' : '-' );
        $info .= ( ( $permissions & 0x0010 ) ? 'w' : '-' );
        $info .= ( ( $permissions & 0x0008) ?
                    ( ( $permissions & 0x0400 ) ? 's' : 'x' ) :
                    ( ( $permissions & 0x0400 ) ? 'S' : '-' ) );

        

        // Other part.

        $info .= ( ( $permissions & 0x0004) ? 'r' : '-' );
        $info .= ( ( $permissions & 0x0002) ? 'w' : '-' );
        $info .= ( ( $permissions & 0x0001) ?
                    ( ( $permissions & 0x0200 ) ? 't' : 'x' ) :
                    ( ( $permissions & 0x0200 ) ? 'T' : '-' ) );



        return $info;

    }



    /**
     * Calculates the contents of a directory recursively. Warning: this might be a long process.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param string $dir The directory whose contents to calculate recursively.
     * 
     * @return int The total size of the directory and its children recursively in bytes.
     */

    function adaptive_images_plugin_dir_size ( $dir ) {

        // var_dump( $dir );
        // echo '<hr />';

        // $result = exec( 'du -hcs ' . $dir, $output, $code );

        // var_dump( $result ); // ==> empty when not done, echoes "3.5M Total" when done
        // echo '<hr />';
        // var_dump( $output ); // ==> empty when not done, holds lines of command output when done
        // echo '<hr />';
        // var_dump( $code );   // ==> 0 when command executed successfully, 1 when not
        // echo '<hr />';

        // return;



        // Keep count of recursively accessed files.

        static $total_files = 0;
        static $total_size  = 0;
        static $total_dirs  = 0;



        // Do not take into acount files and symbolic links.

        if ( is_dir( $dir ) && ! is_link( $dir ) ) {

            $objects = scandir( $dir );

            foreach ( $objects as $object ) {

                if ( $object != "." && $object != ".." ) {

                    $file = $dir . "/" . $object;

                    if ( filetype( $file ) != "dir" ) { 

                        // Add file size in total.
                        
                        $total_files++;
                        $total_size += filesize( $file );

                    } else {

                        // Descend into directory children.

                        $total_dirs++;
                        adaptive_images_plugin_dir_size( $file );

                    }

                }
            }

        }



        return array( 'files' => $total_files, 'size' => $total_size, 'dirs' => $total_dirs );

    } 



    /**
     * Gets a human readable version of a file size. For instance 1024 bytes means 1kb.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param int $size The given file size.
     * 
     * @return string The human readable version of the file size.
     */

    function adaptive_images_plugin_file_size_human ( $size ) {

        $kilo_byte = 1024;
        $mega_byte = 1024 * $kilo_byte;
        $giga_byte = 1024 * $mega_byte;

        if ( $size == 0 ) {

            return '0';

        } else if ( $size < $kilo_byte ) {
            
            return $size . 'b';

        } else if ( $size < $mega_byte ) {

            return round( $size / $kilo_byte, 2 ) . 'kb';
        
        } else if ( $size < $giga_byte ) {

            return round( $size / $mega_byte, 2 ) . 'mb';

        } else {

            return round( $size / $giga_byte, 2 ) . 'gb';

        }
    } 

?>