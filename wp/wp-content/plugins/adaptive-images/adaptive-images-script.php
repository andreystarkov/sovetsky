<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      SCRIPT THAT RESIZES AND OUTPUTS IMAGES TO BROWSERS                                                        *
     *      IT IS CALLED DIRECTLY AND NOT INSIDE THE WORDPRESS ENVIRONMENT                                            *
     *      ==============================================================                                            *
     *                                                                                                                *
     *      Nevma (info@nevma.gr)                                                                                     *
     *                                                                                                                *
     *                                                                                                                *
     ******************************************************************************************************************/

    

    // Define codes for certain debugging cases. 
    
    define( 'SILENCE', FALSE );



    /**
     * Retrieves the settings required for this script to run.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return array An array with the script settings.
     */

    function adaptive_images_script_get_settings () {

        // Setup script settings.

        if ( ! isset( $_REQUEST['adaptive-images-settings'] ) ) {

            // Default script settings which are set in the plugin settings page.

            $resolutions   = array( 1024, 600, 480 );
            $landscape     = TRUE;
            $hidpi         = TRUE;
            $cache_dir     = "cache/adaptive-images";
            $jpg_quality   = 65;
            $png8          = FALSE;
            $sharpen       = TRUE;
            $watch_cache   = TRUE;
            $browser_cache = 60*60*24*7;



            // Check if user settings from the WordPress admin exist.

            $current_directory  = dirname( $_SERVER['SCRIPT_FILENAME'] );
            $user_settings_file = realpath( $current_directory . '/user-settings.php' );

            if ( file_exists( $user_settings_file ) ) {

                // Load user settings saved form the plugin settings page.

                include( 'user-settings.php' );

            }



            // Resolve paths of necessary directories.

            $wp_content = realpath( dirname( $_SERVER['SCRIPT_FILENAME'] ) . '/../../' );

            // Resolve the path of the image file based on the /wp-content path and the request URI.

            $requested_uri = parse_url( urldecode( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH );
            $index = strpos( $requested_uri, '/wp-content' );
            $index += strlen( '/wp-content' );
            $source_file = $wp_content . substr( $requested_uri, $index );

            $resolution = FALSE;



            // Get resolution cookie or resolution as a url parameter for CDNs.
            
            if ( isset( $_GET['resolution'] ) ) {
                
                $cookie_resolution = $_GET['resolution'];

            } else if ( isset( $_COOKIE['resolution'] ) ) { 

                $cookie_resolution = $_COOKIE['resolution'];

            } else {

                $cookie_resolution = null;

            }



            // Default values.

            $client_width  = $resolutions[0];
            $pixel_density = 1;

            if ( ! isset( $cookie_resolution ) || isset( $cookie_resolution ) && ! preg_match( "/^[0-9]+[,]+[0-9]+$/", $cookie_resolution ) ) { 

                // Delete cookie if not valid, so that the default image is used.

                setcookie( 'resolution', '', time() - 100 );

            } else { 

                // If cookie valid then use it.

                $cookie_array = explode( ',', $cookie_resolution );

                // First part of cookie is the client screen width.

                if ( count( $cookie_array ) > 0 ) { 
                    $client_width  = intval( $cookie_array[0] );
                }

                // Second part of cookie is the client screen pixel density.

                if ( $hidpi ) { 

                    if ( count( $cookie_array ) > 1 ) { 
                        $pixel_density = $cookie_array[1];
                    }

                }

            }



            // Scale client screen width according to its pixel density.

            $client_width_scaled = $client_width * $pixel_density;



            // Find the closest available resolution breakpoint for this client width searching upwards.

            $resolution = $resolutions[0];

            foreach ( $resolutions as $breakpoint ) {

                if ( $client_width_scaled <= $breakpoint ) {
                    $resolution = $breakpoint;
                }

            }



            // Check if we are debugging.

            $debug = isset( $_GET['debug'] ) ? $_GET['debug'] : FALSE;



            // Setup script settings and save the in request scope.

            $_REQUEST['adaptive-images-settings'] = array( 
                'debug'          => $debug,
                'resolutions'    => $resolutions,
                'cache_dir'      => $cache_dir,
                'jpg_quality'    => $jpg_quality,
                'png8'           => $png8,
                'sharpen'        => $sharpen,
                'watch_cache'    => $watch_cache,
                'browser_cache'  => $browser_cache,
                'requested_uri'  => $requested_uri,
                'source_file'    => $source_file,
                'wp_content'     => $wp_content,
                'client_width'   => $client_width,
                'hidpi'          => $hidpi,
                'pixel_density'  => $pixel_density,
                'resolution'     => $resolution
            );

        }


        return $_REQUEST['adaptive-images-settings'];

    }



    /**
     * Prints useful debugging information.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_script_do_the_debug () {

        $settings = adaptive_images_script_get_settings();

        if ( $settings['debug'] == 'true' ) {

            // Show debug info instead of resized image.

            $image_size = @GetImageSize( $settings['source_file'] );

            header( 'HTTP/1.1 200 OK' );
            header( 'Content-Type: text/html' ); ?>

            <!DOCTYPE html>

            <html lang = "en">
            
            <head>
                <title>ADAPTIVE IMAGES DEBUG</title>
                <meta name = "viewport" content = "width=device-width, initial-scale=1, user-scalable=1, minimal-ui" />
                <style type = "text/css">
                    body {
                        max-width: 600px;
                        margin: auto;
                        padding: 20px 30px;
                        font-family: "Courier New", monospace;
                        font-size: 14px;
                        line-height: 1.5;
                        white-space: pre-line;
                    }
                    td {
                        padding-right: 20px;
                        vertical-align: top;
                    }
                </style>
            </head>

            <body>

                ADAPTIVE IMAGES DEBUG
                ########################


                Script status
                ==============

                You are viewing this page instead of the image you requested. This is part of the debugging capabilities of the Adaptive Images plugin. Seeing this means the plugin is running alright and that the .htaccess configuration file is setup correctly!

                <table><tbody>
                    <tr>
                        <td>Client width</td>
                        <td><?php echo $settings['client_width']; ?></td>
                    </tr>
                    <tr>
                        <td>Pixel density</td>
                        <td><?php echo $settings['pixel_density']; ?></td>
                    </tr>
                    <tr>
                        <td>HiDPI</td>
                        <td><?php echo $settings['hidpi'] ? 'TRUE' : 'FALSE'; ?></td>
                    </tr>
                    <tr>
                        <td>Resolution</td>
                        <td><?php echo $settings['resolution']; ?></td>
                    </tr>
                    <tr>
                        <td>Cache writable</td>
                        <td><?php echo is_writable( $settings['wp_content'] . '/' . $settings['cache_dir'] ) ? 'YES' : 'NO'; ?></td>
                    </tr>
                </tbody></table>

                User settings
                ==============

                <table><tbody>
                    <tr>
                        <td>$resolutions</td>
                        <td><?php echo implode( ',', $settings['resolutions'] ); ?></td>
                    </tr>
                    <tr>
                        <td>$cache_dir</td>
                        <td><?php echo $settings['cache_dir']; ?></td>
                    </tr>
                    <tr>
                        <td>$jpg_quality</td>
                        <td><?php echo $settings['jpg_quality']; ?></td>
                    </tr>
                    <tr>
                        <td>$sharpen</td>
                        <td><?php echo $settings['sharpen'] ? 'TRUE' : 'FALSE'; ?></td>
                    </tr>
                    <tr>
                        <td>$watch_cache</td>
                        <td><?php echo $settings['watch_cache'] ? 'TRUE' : 'FALSE'; ?></td>
                    </tr>
                    <tr>
                        <td>$browser_cache</td>
                        <td><?php echo $settings['browser_cache']; ?></td>
                    </tr>
                </tbody></table>

                Image requested
                ================

                <table><tbody>
                    <tr>
                        <td>Image</td>
                        <td><?php echo $settings['requested_uri']; ?></td>
                    </tr>
                    <tr>
                        <td>Exists</td>
                        <td><?php echo file_exists( $settings['source_file'] ) ? 'YES' : 'NO' ?></td>
                    </tr>
                    <tr>
                        <td>Mime</td>
                        <td><?php echo file_exists( $settings['source_file'] ) ? $image_size['mime'] : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Dimensions</td>
                        <td><?php echo file_exists( $settings['source_file'] ) ? $image_size[0] . 'x' . $image_size[1] : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                        <td><?php echo file_exists( $settings['source_file'] ) ? filesize( $settings['source_file'] ) : '-'; ?></td>
                    </tr>
                </tbody></table>

                ---

                Remove "?debug=true" in the url to see your image. 

                Add "?debug=original" to see the original, non-resized image. 

                Add "?resolution=xxxx,y" to see the image resized in xxxx pixels and y pixel density. 

            </body>

            </html> <?php 

        } elseif ( $settings['debug'] == 'original' ) {

            // Show original image instead of resized one.

            adaptive_images_script_send_image( $settings['source_file'], 0 );

        } elseif ( intval( $settings['debug'] ) > 1 ) {

            // Show original image instead of resized one.

            adaptive_images_script_send_error_message( 'Debugging images in custom sizes not implemented yet (' . intval( $settings['debug'] ) . 'px requested).' );

        }

    }



    /**
     * Checks whether we are in a mobile browser environment in a simple way.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return bool Whether we are in a mobile browser environment.
     */

    function adaptive_images_script_is_mobile () {

        $userAgent = strtolower( $_SERVER['HTTP_USER_AGENT'] );

        return strpos( $userAgent, 'mobile' ) !== FALSE;

    }



    /**
     * Sends a text error message.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_script_send_error_message ( $message = 'Error' ) {

        header( 'HTTP/1.1 404 Not Found' );
        header( 'Content-Type: text/plain' );
        echo $message;

    }



    /**
     * Gets the extension of a given file.
     * 
     * @param string $file The file whose the extension is requested..
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return string The extension of the given file.
     */

    function adaptive_images_script_get_file_extension ( $file ) {

        return strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );

    }



    /**
     * Sends an image file to the user.
     * 
     * @param string $filename      The filename of the image to send.
     * @param int    $browser_cache The browser cache expires time.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_script_send_image ( $filename, $browser_cache ) {

        // Add the image content type header.

        $extension = adaptive_images_script_get_file_extension( $filename );

        if ( in_array( $extension, array( 'png', 'gif', 'jpeg' ) ) ) {

            header( 'Content-Type: image/' . $extension );

        } else {

            header( 'Content-Type: image/jpeg' );

        }



        // If plugin browser cache is set to zero then do nothing, so that the default settings will take effect.

        if ( $browser_cache > 0 ) {

            // Add the cache control and expires headers

            header( 'Cache-Control: private, max-age=' . $browser_cache );
            header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + $browser_cache ) . ' GMT' );

        }

        // Add last modified cache header.

        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s', filemtime( $filename ) ) . ' GMT' );



        // Send image file to user.

        header( 'Content-Length: ' . filesize( $filename ) );
        readfile( $filename );

    }



    /**
     * Checks if the cache directory exists and creates it if possible.
     * 
     * If the .htaccess file has not been updated correctly then the request for an image will never reach this script
     * and the this code will not even be attempted to be called and the image will appear as "404 not found"/. Recall 
     * the starting slash ("/") issue in the Rewrite of the .htaccess file.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_script_ensure_cache_directory_ready ( $cache_path ) {

        if ( ! is_dir( $cache_path ) && 
             ! is_writable( $cache_path ) && 
             ! @mkdir( $cache_path, 0755, true ) && 
             ! is_dir( $cache_path ) ) { 

            return FALSE;

        } else {

            return TRUE;

        }

    }



    /**
     * Calculates the sharpness transformation factor.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param int $original_width The original width of the image to be sharpened.
     * @param int $final_width    The final width of the image to be sharpened.
     * 
     * @return float The calculated sharpness transformation factor.
     */

    function adaptive_images_script_sharpness_factor ( $original_width, $final_width ) {

        // Normalize width.

        $final_width = $final_width * ( 750.0 / $original_width );

        // Sharpness factors.

        $a = 52;
        $b = -0.27810650887573124;
        $c = 0.00047337278106508946;
        
        // Calculate sharpness factor.

        $result  = $a + $b * $final_width + $c * $final_width * $final_width;
        
        return max( round( $result ), 0 );

    }



    /**
     * Checks if the cached version of an image is stale and deletes it so it is regenerated later on.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param string $source_file The original image.
     * @param string $cache_file  The cached version of the image.
     * @param string $resolution  The resolution which has been selected to send to the user.
     * 
     * @return void
     */
    
    function adaptive_images_delete_stale_cache_image ( $source_file, $cache_file, $resolution ) {

        if ( file_exists( $cache_file ) ) {

            // Check image file timestamp.

            if ( filemtime( $cache_file ) >= filemtime( $source_file ) ) {

                return $cache_file;

            }

            unlink( $cache_file );
        }

    }



    /**
     * Generates a resized version of an image and saves it in the image cache folder.
     * 
     * @param string $source_file The original image to be resized.
     * @param string $cache_file  The target file where the resized version will be cached.
     * @param int    $resolution  The resolution breakpoint at which the given image is to be resized.
     * @param int    $jpg_quality The JPEG quality that will be used for resizing the images.
     * @param bool   $png8        Whether to use PNG8 compression for PNGs or let 32bit PNGs.
     * @param bool   $sharpen     Whether to sharpen the resized images or not.
     * 
     * @return array Associative array( bool: success, string: message) with the result of the image cache generation.
     */
    
    function adaptive_images_script_generate_image ( $source_file, $cache_file, $resolution, $jpg_quality, $png8, $sharpen ) {

        // Get original image dimensions.

        $dimensions = @GetImageSize( $source_file );
        $width      = $dimensions[0];
        $height     = $dimensions[1];



        // Calculate resized image dimensions.

        $ratio      = $height / $width;
        $new_width  = $resolution;
        $new_height = ceil( $new_width * $ratio );



        // Start creating the resized image with a blank true color canvas.

        $destination = @ImageCreateTrueColor( $new_width, $new_height );

        $extension = adaptive_images_script_get_file_extension( $source_file );

        switch ( $extension ) {

            case 'png':

                $source = @ImageCreateFromPng( $source_file );
                break;

            case 'gif':

                $source = @ImageCreateFromGif( $source_file );
                break;

            default:

                // jpg/jpeg
                $source = @ImageCreateFromJpeg( $source_file );
                break;

        }



        // PNG images generation.

        if ( $extension == 'png' ) {
            
            // Create a transparent color and fill the blank canvas with it.

            $rbga_color = @ImageColorAllocateAlpha( $destination, 0, 0, 0, 127 );
            @ImageColorTransparent( $destination, $rbga_color );
            @ImageFill( $destination, 0, 0, $rbga_color );
            


            // Disable blending of destination image to allow for alpha (transparency) above.
            
            $enable_alpha_blending = FALSE;
            @ImageAlphaBlending( $destination, $enable_alpha_blending );

            // Save alpha (transparency) of destination image.
            
            $save_alpha = TRUE;
            @ImageSaveAlpha( $destination, $save_alpha );



            // Copy source image to destination image with interpolation.

            @ImageCopyResampled( $destination, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height );


            

            // Convert true colour image to pallette image to achieve PNG-8 compression.

            if ( $png8 ) {

                $dither = TRUE;
                @ImageTrueColorToPalette( $destination, $dither, 255 );
                
            }

        }


        
        // GIF images generation.
        
        if ( $extension == 'gif' ) {

            // Create a transparent color and fill the blank canvas with it.
            
            $rbga_color = @ImageColorAllocateAlpha( $destination, 0, 0, 0, 127 );
            @ImageColorTransparent( $destination, $rbga_color );
            @ImageFill( $destination, 0, 0, $rbga_color );

            // Copy source image to destination image with interpolation.

            @ImageCopyResampled( $destination, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

            // Convert true colour image to pallette image to achieve PNG8 compression.

            $dither = TRUE;
            @ImageTrueColorToPalette( $destination, $dither, 255 );

            // Enable alpha blending of destination image.
            
            $enable_alpha_blending = TRUE;
            @ImageAlphaBlending( $destination, $enable_alpha_blending );

        }

        

        // JPEG images generation.

        if ( $extension == 'jpg' || $extension == 'jpeg' ) {

            // Enable JPEG interlacing.

            @ImageInterlace( $destination, TRUE );

            // Interpolates source image to destination image to make it more clear for JPGs.

            @ImageCopyResampled( $destination, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

        }

        

        // Cleanup source image from memory.

        @ImageDestroy( $source );



        // Do sharpening if requested (only for JPEGs).

        if ( ( $extension == 'jpg' || $extension == 'jpeg' ) && 
               $sharpen && function_exists( 'imageconvolution' ) ) {
            
            $sharpness_factor = adaptive_images_script_sharpness_factor( $width, $new_width );
            
            $sharpness_transformation_matrix = array(
                array( -1, -2, -1 ),
                array( -2, $sharpness_factor + 12, -2 ),
                array( -1, -2, -1 )
            );

            // OR

            // $sharpenMatrix = array
            // (
            //     array(-1.2, -1, -1.2),
            //     array(-1, 20, -1),
            //     array(-1.2, -1, -1.2)
            // );
            // $divisor = array_sum(array_map('array_sum', $sharpenMatrix));           

            // OR

            // $sharpen = array(
            //     array(0.0, -1.0, 0.0),
            //     array(-1.0, 5.0, -1.0),
            //     array(0.0, -1.0, 0.0)
            // );
            // $divisor = array_sum(array_map('array_sum', $sharpen));

            // OR

            // $matrix = array(
            //     array(-1, -1, -1),
            //     array(-1, 16, -1),
            //     array(-1, -1, -1),
            // );
        
            // $divisor = array_sum(array_map('array_sum', $matrix));

            @ImageConvolution( $destination, $sharpness_transformation_matrix, $sharpness_factor, 0 );

        }



        // Check and ensure that cache directory is setup OK.

        $cache_path = dirname( $cache_file );

        if ( ! adaptive_images_script_ensure_cache_directory_ready( $cache_path ) ) {

            return array( 'success' => false, 'message' => 'Cache directory for image not accessible or writeable.' );

        }



        // Save resized image in cache.

        switch ( $extension ) {

            case 'png':

                $png_compression_level = 6;
                $image_saved = @ImagePng( $destination, $cache_file, $png_compression_level, PNG_FILTER_NONE );
                break;

            case 'gif':

                $image_saved = @ImageGif( $destination, $cache_file );
                break;

            default:

                $image_saved = @ImageJpeg( $destination, $cache_file, $jpg_quality );
                break;
        }

        // Cleanup destination image from memory.

        @ImageDestroy( $destination );



        // Check if all OK.

        if ( ! $image_saved && ! file_exists( $cache_file ) ) {

            return array( 'success' => false, 'message' => 'Resized image could not be created.' );

        }


        
        // Return file of resized and cached image.

        return array( 'success' => true, 'message' => $cache_file );

    }



/**********************************************************************************************************************/



    /****************************************************************************
     *                                                                          *
     *                                                                          *
     *        SCRIPT LOGIC FOLLOWS                                              *
     *        ====================                                              *
     *                                                                          *
     *                                                                          *
     ****************************************************************************/



    // Do nothing for cases of standalone unit tests in the future.
    
    if ( defined( SILENCE ) && SILENCE == TRUE ) {

        return;
        
    }



    // Collect plugin settings.

    $settings = adaptive_images_script_get_settings();



    // Check if we are debugging instead of actually sending what was requested.

    if ( $settings['debug'] ) {

        adaptive_images_script_do_the_debug( $settings['debug'] );
        exit();

    }



    // Check if source image exists or not.
    
    if ( ! file_exists( $settings['source_file'] ) ) {

        adaptive_images_script_send_error_message( 'Original image not found or not available.' );
        exit();
        
    }



    // Special case where no cookie or url parameter is given. 

    if ( ! isset( $_GET['resolution'] ) && ! isset( $_COOKIE['resolution'] ) ) { 

        // Send the original image itself as the best solution.

        adaptive_images_script_send_image( $settings['source_file'], $settings['browser_cache'] );
        exit();

    }




    // Ensure cache directory exists and is accessible.

    if ( ! adaptive_images_script_ensure_cache_directory_ready( $settings['wp_content'] . '/' . $settings['cache_dir'] ) ) {

        adaptive_images_script_send_error_message( 'Main cache directory not accessible or writeable.' );
        exit();

    }



    // Get original image dimensions.
    
    $image_size  = @GetImageSize( $settings['source_file'] );
    $image_width = $image_size[0];



    // Special case where original image and device screen are both bigger than the biggest breakpoint. 

    if ( $image_width > $settings['resolution'] && $settings['client_width'] > $settings['resolution'] ) { 

        // Send the original image itself as the best solution.

        adaptive_images_script_send_image( $settings['source_file'], $settings['browser_cache'] );
        exit();

    }



    // Special case where original image is smaller than the selected (smallest) breakpoint. 
    
    if ( $image_width < $settings['resolution'] ) {

        // Send the original image itself as the best solution.

        adaptive_images_script_send_image( $settings['source_file'], $settings['browser_cache'] );
        exit();

    }



    // Special case where client width scaled by its pixel density is bigger than the selected (biggest) breakpoint. 
    
    if ( $settings['client_width'] * $settings['pixel_density'] > $settings['resolution'] ) {

        // Send the original image itself as the best solution.

        adaptive_images_script_send_image( $settings['source_file'], $settings['browser_cache'] );
        exit();

    }



    // Locate cached image.

    $cache_file = $settings['wp_content'] . '/' . $settings['cache_dir'] . '/' . $settings['resolution'] . $settings['requested_uri'];



    // Check if cached image if stale and relete it if so.

    if ( file_exists( $cache_file ) ) { 
        
        // Check if cached image is stale and delete it if so.

        if ( $settings['watch_cache'] ) { 

            adaptive_images_delete_stale_cache_image( $settings['source_file'], $cache_file, $settings['resolution'] );

        }

    }



    // Cached image is not yet created or has been deleted as stale.

    if ( ! file_exists( $cache_file ) ) { 
        
        // So create cached image now.
        
        $result = adaptive_images_script_generate_image( $settings['source_file'], $cache_file, $settings['resolution'], $settings['jpg_quality'], $settings['png8'], $settings['sharpen'] );

        // If cached image could not be created. 

        if ( ! $result['success'] ) {

            // Send the original image itself as the best solution.

            adaptive_images_script_send_image( $source_file, $settings['browser_cache'] );
            exit();

        }

    }



    // Send the cached image alright.

    adaptive_images_script_send_image( $cache_file, $settings['browser_cache'] );
    exit();

?>