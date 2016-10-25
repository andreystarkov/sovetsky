<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      PLUGIN SETTINGS PAGE FUNCTIONS                                                                            *
     *      ==============================                                                                            *
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
     * Adds some admin related CSS rules for the plugin.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_show_admin_css () { ?>

        <style type = "text/css">

            /* Make our admin notices look like other WordPress settings errors. */

            .adaptive-images-settings-error { font-weight: bold; }

        </style> <?php

    }



    /**
     * Adds a link to the adaptive images settings in the plugins listing page for convenience.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param array $links The plugin links array in the plugins listing page.
     * 
     * @return void
     */

    function adaptive_images_admin_add_plugin_settings_link ( $links ) {
        
        $links[] = '<a href = "options-general.php?page=adaptive-images">' . 'Settings' . '</a>';

        return $links;

    }



    /**
     * Adds a link to the adaptive images settings in the plugins listing page for convenience.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @param array $links The plugin links array in the plugins listing page.
     * 
     * @return void
     */

    function adaptive_images_admin_add_row_meta ( $links, $file ) {

        if ( $file != adaptive_images_plugin_get_name() ) {

            return $links;

        }
        
        $links[] = '<a href = "https://wordpress.org/plugins/adaptive-images/">' . 'Plugin page' . '</a>';
        $links[] = '<a href = "http://wordpress.org/support/plugin/adaptive-images">' . 'Plugin support page' . '</a>';

        return $links;

    }



    /**
     * Adds the plugin settings page to the admin area.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_add_options_page () {

        // Adds the plugin's options page as a submenu of the admin settings.

        $hook_name = add_options_page( 
            'Adaptive Images',                         // page title
            'Adaptive Images',                         // menu title
            'manage_options',                          // capability
            'adaptive-images',                         // menu slug
            'adaptive_images_admin_options_page_print' // print function callback
        );

        // Adds the action which adds the plugin admin actions.

        add_action( 'admin_head-' . $hook_name, 'adaptive_images_admin_settings_actions' ); 

    }



    /**
     * Registers the plugin settings.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_register_settings () {

        // Registers the plugin settings field.

        register_setting( 
            'adaptive-images-settings',               // option group
            'adaptive-images',                        // option name
            'adaptive_images_admin_settings_sanitize' // function validator callback
        );


        
        // Adds the plugin main settings section.

        add_settings_section(
            'adaptive-images-settings', // id
            '',                         // title
            '',                         // print function callback
            'adaptive-images'           // plugin page
        ); 



        // Adds the adaptive images resolutions field.

        add_settings_field( 
           'resolutions',                                   // id
           'Resolutions',                                   // title 
           'adaptive_images_admin_resolutions_field_print', // print function callback
           'adaptive-images',                               // plugin page
           'adaptive-images-settings'                       // section
        );

        // Adds the adaptive images landscape field.

        add_settings_field( 
           'orientation',                                 // id
           'Bigger dimension',                            // title 
           'adaptive_images_admin_landscape_field_print', // print function callback
           'adaptive-images',                             // plugin page
           'adaptive-images-settings'                     // section
        );

        // Adds the adaptive images hidpi field.

        add_settings_field( 
           'hidpi',                                   // id
           'HiDPI support',                           // title 
           'adaptive_images_admin_hidpi_field_print', // print function callback
           'adaptive-images',                         // plugin page
           'adaptive-images-settings'                 // section
        );

        // Adds the adaptive images CDN support field.

        add_settings_field( 
           'cdn-support',                                   // id
           'CDN support',                                   // title 
           'adaptive_images_admin_cdn_support_field_print', // print function callback
           'adaptive-images',                               // plugin page
           'adaptive-images-settings'                       // section
        );

        // Adds the adaptive images cache directory field.

        add_settings_field( 
           'cache-directory',                                   // id
           'Cache directory',                                   // title 
           'adaptive_images_admin_cache_directory_field_print', // print function callback
           'adaptive-images',                                   // plugin page
           'adaptive-images-settings'                           // section
        );

        // Adds the adaptive images watched directories field.

        add_settings_field( 
           'watched-directories',                                   // id
           'Watched directories',                                   // title 
           'adaptive_images_admin_watched_directories_field_print', // print function callback
           'adaptive-images',                                       // plugin page
           'adaptive-images-settings'                               // section
        );

        // Adds the adaptive images JPEG quality field.

        add_settings_field( 
           'jpeg-quality',                                   // id
           'JPEG quality',                                   // title 
           'adaptive_images_admin_jpeg_quality_field_print', // print function callback
           'adaptive-images',                                // plugin page
           'adaptive-images-settings'                        // section
        );

        // Adds the adaptive images sharpen field.

        add_settings_field( 
           'sharpen-images',                                   // id
           'Sharpen images',                                   // title 
           'adaptive_images_admin_sharpen_images_field_print', // print function callback
           'adaptive-images',                                  // plugin page
           'adaptive-images-settings'                          // section
        );

        // Adds the adaptive images watch cache (for stale images) field.

        add_settings_field( 
           'watch-cache',                                   // id
           'Watch cache',                                   // title 
           'adaptive_images_admin_watch_cache_field_print', // print function callback
           'adaptive-images',                               // plugin page
           'adaptive-images-settings'                       // section
        );

        // Adds the adaptive images browser cache duration field.

        add_settings_field( 
           'browser-cache',                                   // id
           'Browser cache',                                   // title 
           'adaptive_images_admin_browser_cache_field_print', // print function callback
           'adaptive-images',                                 // plugin page
           'adaptive-images-settings'                         // section
        );

    }



    /**
     * Prints the resolutions settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_resolutions_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'resolutions' ); ?>

        <input type = "text" id = "adaptive-images[resolutions]" name = "adaptive-images[resolutions]" value = "<?php echo implode( ', ', $options['resolutions'] ); ?>" size = "25" /> 

        A comma separated list of device widths. <?php

    }



    /**
     * Prints the landscape settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_landscape_field_print ()   {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'landscape' ); ?>

        <label for = "adaptive-images[landscape]">
            
            <input type = "checkbox" id = "adaptive-images[landscape]" name = "adaptive-images[landscape]" <?php echo $options['landscape'] ? 'checked = "checked"' : ''; ?> /> 

            Check if plugin should resize images according to the landscape device orientation.

        </label> <?php

    }



    /**
     * Prints the hidpi settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_hidpi_field_print ()   {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'hidpi' ); ?>

        <label for = "adaptive-images[hidpi]">
            
            <input type = "checkbox" id = "adaptive-images[hidpi]" name = "adaptive-images[hidpi]" <?php echo $options['hidpi'] ? 'checked = "checked"' : ''; ?> /> 

            Check if plugin should try to show higher resolution images to HiDPI (retina) screens.
            
            <br />
            
            <small>
                Provides better image quality for HiDPI (retina) screen devices, but sends them bigger file sizes. 
            </small>

        </label> <?php

    }



    /**
     * Prints the CDN support settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_cdn_support_field_print ()   {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'cdn-support' ); ?>

        <label for = "adaptive-images[cdn-support]">
            
            <input type = "checkbox" id = "adaptive-images[cdn-support]" name = "adaptive-images[cdn-support]" <?php echo $options['cdn-support'] ? 'checked = "checked"' : ''; ?> /> 

            Check to make plugin cooperate with a CDN, Varnish or other external caching solution.
            
            <br />
            
            <small>
                *** Experimental feature, that adds a special url at the end of each image source url.  Not dangerous, just experimental! 
            </small>

        </label> <?php

    }



    /**
     * Prints the cache directory settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_cache_directory_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'cache-directory' ); ?>

        <input type = "text" id = "adaptive-images[cache-directory]" name = "adaptive-images[cache-directory]" value = "<?php echo $options['cache-directory']; ?>" size = "25" /> 
        
        Directory inside /wp-content to store the image cache. 

        <br />

        <small>
            Current path on server: 
            <?php 
                $file = trailingslashit( WP_CONTENT_DIR ) . $options['cache-directory'];
                echo $file;
            ?>.
        </small> <?php

    }



    /**
     * Prints the watched directories settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_watched_directories_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'watched-directories' ); ?>

        <textarea id = "adaptive-images[watched-directories]" name = "adaptive-images[watched-directories]" cols = "60" rows = "5"><?php echo implode( "\n", $options['watched-directories'] ); ?></textarea>

        <br />

        <small>
            Directories to watch for images to resize for mobile devices. Has to be relative paths inside your WordPress installation.
        </small> <?php

    }



    /**
     * Prints the cache JPEG quality settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_jpeg_quality_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'jpeg-quality' ); ?>

        <select type = "text" id = "adaptive-images[jpeg-quality]" name = "adaptive-images[jpeg-quality]">
            <?php for ( $quality = 100; $quality >= 5; $quality -= 5 ) : ?> 
                <option value = "<?php echo $quality; ?>" <?php echo $options['jpeg-quality'] == $quality ? 'selected = "selected"' : ''; ?>><?php echo $quality; ?></option>
            <?php endfor; ?>
        </select> 

        Compression level of JPEG images, 100 means best quality but biggest file size. 
        <br />
        <small>Usuallly a 60 to 70 JPEG compression level works fine for the human eye and achieves very small file sizes.</small> <?php

    }



    /**
     * Prints the sharpen settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_sharpen_images_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'sharpen-images' ); ?>

        <label for = "adaptive-images[sharpen-images]">
            
            <input type = "checkbox" id = "adaptive-images[sharpen-images]" name = "adaptive-images[sharpen-images]" <?php echo $options['sharpen-images'] ? 'checked = "checked"' : ''; ?> /> 

            Yes, sharpen JPEG images after compressing and resizing, in order to reduce blur.

        </label> <?php

    }



    /**
     * Prints the watch cache settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_watch_cache_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'watch-cache' ); ?>

        <label for = "adaptive-images[watch-cache]">
            
            <input type = "checkbox" id = "adaptive-images[watch-cache]" name = "adaptive-images[watch-cache]" <?php echo $options['watch-cache'] ? 'checked = "checked"' : ''; ?> /> 

            Yes, check if an image has been updated in the meantime, in order to generate it again.

        </label> <?php

    }



    /**
     * Prints the browser cache settings field.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_browser_cache_field_print () {

        $options = get_option( 'adaptive-images' ); 

        adaptive_images_plugin_check_empty_setting( $options, 'browser-cache' ); ?>

        <select type = "text" id = "adaptive-images[browser-cache]" name = "adaptive-images[browser-cache]">
            <option value = "0" <?php echo $options['browser-cache'] == '0' ? 'selected = "selected"' : ''; ?>> Default </option>
            <option value = "0.125" <?php echo $options['browser-cache'] == '0.125' ? 'selected = "selected"' : ''; ?>> 3  hours </option>
            <option value = "0.25"  <?php echo $options['browser-cache'] == '0.25'  ? 'selected = "selected"' : ''; ?>> 6  hours </option>
            <option value = "0.5"   <?php echo $options['browser-cache'] == '0.5'   ? 'selected = "selected"' : ''; ?>> 12 hours </option>
            <option value = "1"     <?php echo $options['browser-cache'] == '1'     ? 'selected = "selected"' : ''; ?>> 1  day   </option>
            <option value = "7"     <?php echo $options['browser-cache'] == '7'     ? 'selected = "selected"' : ''; ?>> 1  week  </option>
            <option value = "15"    <?php echo $options['browser-cache'] == '15'    ? 'selected = "selected"' : ''; ?>> 2  weeks </option>
            <option value = "30"    <?php echo $options['browser-cache'] == '30'    ? 'selected = "selected"' : ''; ?>> 1  month </option>
            <option value = "60"    <?php echo $options['browser-cache'] == '60'    ? 'selected = "selected"' : ''; ?>> 2  months</option>
            <option value = "90"    <?php echo $options['browser-cache'] == '90'    ? 'selected = "selected"' : ''; ?>> 3  months</option>
            <option value = "180"   <?php echo $options['browser-cache'] == '180'   ? 'selected = "selected"' : ''; ?>> 6  months</option>
            <option value = "365"   <?php echo $options['browser-cache'] == '365'   ? 'selected = "selected"' : ''; ?>> 1  year  </option>
            <option value = "730"   <?php echo $options['browser-cache'] == '730'   ? 'selected = "selected"' : ''; ?>> 2  years </option>
        </select> 

        How long should browsers be instructed to cache images. 
        <br />
        <small>Unless you have a very special need and/or you know what you are doing, set this to as high a value as you can.</small> <?php

    }



    /**
     * Prints the contents of the plugin options page.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void
     */

    function adaptive_images_admin_options_page_print () {  ?>

        <div class = "wrap">

            <h2>Adaptive Images Settings</h2>

            <form method = "post" action = "options.php">

                <?php 
                    // Print plugin settings form.

                    settings_fields( 'adaptive-images-settings' ); 
                    do_settings_sections( 'adaptive-images' ); 
                    submit_button( 'Save settings' ); 
                ?>

                <?php // Override default referer because it might contain other GET data on it. ?>

                <input type = "hidden" name = "_wp_http_referer" value = "options-general.php?page=adaptive-images" />

            </form>

            <hr />

            <h3>Image Cache Tools</h3>

            <style type = "text/css">

                .adaptive-images-admin-table { margin: 0; padding: 0; border: none; }

                    .adaptive-images-admin-table td { margin: 0; padding: 0 0 20px 0; min-width: 200px; vertical-align: top; border: none; white-space: nowrap; }

                        .button-primary { min-width: 150px; text-align: center; }

                #TB_window,
                #TB_ajaxContent { height: auto !important; }

            </style>

            <table class = "adaptive-images-admin-table">
                <tbody>
                   <tr>
                        <td>
                            Calculate total cache size. 
                            <br /><br />
                            <a class = "button-primary" href = "options-general.php?page=adaptive-images&action=calculate-cache-size&_wpnonce=<?php echo wp_create_nonce( 'adaptive-images-calculate-cache-size' ); ?>">Calculate size</a> 
                            <br />
                            <small>(might take some time)</small>
                        </td>
                        <td>
                            Cleanup the image cache. 
                            <br /><br />
                            <a class = "button-primary thickbox" href = "#TB_inline?height=300&amp;width=400&amp;inlineId=cleanup-image-cache-modal" title = "Adaptive Images Message">Cleanup cache</a> 
                            <br />
                            <small>(might take some time)</small>
                        </td>
                   </tr> 
                </tbody>
            </table>

            <?php add_thickbox(); ?>

            <script type = "text/javascript">
                jQuery( function () {
                    // Confirmation window close handler.
                    jQuery( '.tb-confirm' ).on( 'click', function () {
                        // Does not return false.
                        tb_remove();
                    });
                    jQuery( '.tb-remove' ).on( 'click', function () {
                        // Returns false.
                        tb_remove();
                        return false;
                    });
                });
            </script>

            <div id = "cleanup-image-cache-modal" style = "display:none;">
                <h3>Please confirm</h3>
                <hr />
                <p>
                    Are you sure you want to delete all images in the cache? This means that all cached images will be lost and that they will be created anew once they are accessed again.
                </p>
                <p style = "text-align: right;">
                    <a class = "button-primary tb-confirm" href = "options-general.php?page=adaptive-images&action=cleanup-image-cache&_wpnonce=<?php echo wp_create_nonce( 'adaptive-images-cleanup-image-cache' ); ?>">Yes, cleanup cache</a> 
                    <a class = "button-secondary tb-remove" href = "#">No, leave it be</a> 
                </p>
            </div>

            <hr />

            <h3>Debugging Tools</h3>

            <table class = "adaptive-images-admin-table">
                <tbody>
                   <tr>
                        <td>
                            Print debug information. 
                            <br /><br />
                            <a class = "button-primary" href = "options-general.php?page=adaptive-images&action=print-debug-info&_wpnonce=<?php echo wp_create_nonce( 'adaptive-images-print-debug-info' ); ?>">Print debug info</a> 
                            <br />
                            <small>(this is quite quick)</small>
                        </td>
                        <td>
                            Print diagnostic information. 
                            <br /><br />
                            <a class = "button-primary" href = "options-general.php?page=adaptive-images&action=print-diagnostic-info&_wpnonce=<?php echo wp_create_nonce( 'adaptive-images-print-diagnostic-info' ); ?>">Print diagnostics</a> 
                            <br />
                            <small>(this is quite quick)</small>
                        </td>
                   </tr>
                </tbody>
            </table>

            <hr />

            <h3>Contact the developers</h3>

            <p>
                Thank you so much for trying out the &quot;Adaptive Images for WordPress&quot; plugin. <br />
                Please, do not hesitate to report any <strong><a href = "https://wordpress.org/support/plugin/adaptive-images">problems</a></strong> and send us your <strong><a href = "https://wordpress.org/support/plugin/adaptive-images">suggestions</a></strong> at the plugin support page. <br />
                We will really appreciate it!
                <br />
                <br />
                Many-many thanks, 
                <br />
                <strong><a href = "http://www.nevma.gr">Nevma</a></strong>, the development team!
            </p>

            <hr />

            <h4>Show us your love</h4>

            <p>
                &#127775;&#127775;&#127775;&#127775;&#127775;
                <br />
                We do appreciate an honest review and <strong><a href = "https://wordpress.org/support/view/plugin-reviews/adaptive-images">rating</a></strong>!
            </p>

            <?php $options = adaptive_images_plugin_get_options(); ?>
            
            <?php global $wp_version; ?>

            <p>
                &#128077;&#128077;&#128077;&#128077;&#128077;
                <br />
                State that the plugin actually works by clicking <strong><a href = "https://wordpress.org/plugins/adaptive-images/?compatibility[version]=<?php echo $wp_version; ?>&compatibility[topic_version]=<?php echo $options['version']; ?>&compatibility[compatible]=1">here</a></strong>!
            </p>

            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <style type="text/css" media="screen">
                    input[type="image"] { 
                        vertical-align: middle; 
                        padding: 0;
                        height: 20px !important;
                        width: auto;
                    }
                </style>
                <p>
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="WCES7V9D45HDS">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    <br />
                    Should you wish to buy us a beer, we prefer weiss! 
                </p>
            </form>

            <hr />

            <p style = "font-style: italic;">Adaptive Images v.<?php echo $options['version']; ?></p>

        </div> <?php

    }



    /**
     * Takes care of the plugin settings page actions.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void Nothing really!.
     */

    function adaptive_images_admin_settings_actions () {

        if ( ! isset( $_GET['action'] ) ) {

            return;

        }



        // Cleanup image cache action.

        if ( $_GET['action'] == 'cleanup-image-cache' && 
             wp_verify_nonce( $_GET['_wpnonce'], 'adaptive-images-cleanup-image-cache' ) ) {

            $cache_path = adaptive_images_plugin_get_cahe_directory_path();

            $result = adaptive_images_actions_rmdir_recursive( $cache_path ); 

            add_settings_error( 
                'adaptive-images-settings', 
                'adaptive-images-settings-error', 
                'Cleanup image cache <hr />' . 
                '<p>Total files deleted from the adaptive images cache: ' . $result['files'] . '</p>' .  
                '<p>Total directories deleted from the adaptive images cache: ' . $result['dirs'] . '</p>' .  
                '<p>' . 
                    'Total size deleted from the adaptive images cache: ' . 
                    adaptive_images_plugin_file_size_human( $result['size'] ) . 
                '</p>', 
                'updated' 
            ); 

        } 



        // Calculate image cache size action.

        if ( $_GET['action'] == 'calculate-cache-size' && 
             wp_verify_nonce( $_GET['_wpnonce'], 'adaptive-images-calculate-cache-size' ) ) {

            $cache_path = adaptive_images_plugin_get_cahe_directory_path();
            $cache_size = adaptive_images_plugin_dir_size( $cache_path ); 

            add_settings_error( 
                'adaptive-images-settings', 
                'adaptive-images-settings-error', 
                'Calculate cache size <hr />' . 
                '<p>Total files in the adaptive images cache: ' . $cache_size['files'] . '</p>' .  
                '<p>Total directories in the adaptive images cache: ' . $cache_size['dirs'] . '</p>' .  
                '<p>' . 
                    'Total size of the adaptive images cache: ' . 
                    adaptive_images_plugin_file_size_human( $cache_size['size'] ) . 
                '</p>', 
                'updated' 
            ); 

        } 



        // Print plugin info action.

         if ( $_GET['action'] == 'print-debug-info' && 
              wp_verify_nonce( $_GET['_wpnonce'], 'adaptive-images-print-debug-info' ) ) {

            add_settings_error( 
                'adaptive-images-settings', 
                'adaptive-images-settings-error', 
                'Debug info <hr />' . 
                adaptive_images_debug_general_info( FALSE ), 
                'updated' 
            ); 

        }



        // Print system info action.

         if ( $_GET['action'] == 'print-diagnostic-info' && 
              wp_verify_nonce( $_GET['_wpnonce'], 'adaptive-images-print-diagnostic-info' ) ) {

            add_settings_error( 
                'adaptive-images-settings', 
                'adaptive-images-settings-error', 
                'System information <hr />' . 
                adaptive_images_debug_diagnostic_info( FALSE ), 
                'updated' 
            ); 

        }

    }



    /**
     * Validates the adaptive images submitted settings.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return The sanitized and validated data.
     */

    function adaptive_images_admin_settings_sanitize ( $data ) {

        // To avoid the bug of sanitizing twice the first time the option is created.

        if ( isset( $data['sanitized'] ) && $data['sanitized'] ) {

            return $data;

        }



        // Get the defaults just in case.

        $defaults = adaptive_images_plugin_get_default_settings();



        // Resolutions field array validation.

        $resolutions = trim( $data['resolutions'] );
        $resolutions_array = explode( ',', $resolutions );
        $resolutions_array_sanitized = array();

        for ( $k = 0, $length = count( $resolutions_array ); $k < $length; $k++ ) {

            $resolution = trim( $resolutions_array[$k] );
            $resolution = intval( $resolution );

            if ( $resolution > 0  ) {

                $resolutions_array_sanitized[] = $resolution;

            }

        }

        rsort( $resolutions_array_sanitized );

        if ( count( $resolutions_array_sanitized ) == 0 )  {

            $resolutions_array_sanitized = $defaults['resolutions'];

        }

        $data['resolutions'] = $resolutions_array_sanitized;

        adaptive_images_plugin_check_empty_setting( $data, 'resolutions' );



        // Landscape field validation.

        $landscape = isset( $data['landscape'] ) && $data['landscape'] == 'on' ? TRUE : FALSE;

        $data['landscape'] = $landscape;

        adaptive_images_plugin_check_empty_setting( $data, 'landscape' );



        // Hidpi field validation.

        $hidpi = isset( $data['hidpi'] ) && $data['hidpi'] == 'on' ? TRUE : FALSE;

        $data['hidpi'] = $hidpi;

        adaptive_images_plugin_check_empty_setting( $data, 'hidpi' );



        // CDN support field validation.

        $cdn_support = isset( $data['cdn-support'] ) && $data['cdn-support'] == 'on' ? TRUE : FALSE;

        $data['cdn-support'] = $cdn_support;

        adaptive_images_plugin_check_empty_setting( $data, 'cdn-support' );



        // Cache field directory validation.

        $cache_directory = trim( $data['cache-directory'] );
        $cache_directory = preg_replace( '/[^a-zA-Z\d-_\/]+/i', '', $cache_directory );
        $cache_directory = wp_normalize_path( $cache_directory );
        $cache_directory = untrailingslashit( $cache_directory );

        if ( ! adaptive_images_plugin_is_file_in_wp_content( $cache_directory ) ) {

            $cache_directory == $defaults['cache-directory'];

        }

        $data['cache-directory'] = $cache_directory;

        adaptive_images_plugin_check_empty_setting( $data, 'cache-directory' );



        // Watched field directories validation.

        $watched_directories_string = trim( $data['watched-directories'] );
        $watched_directories_array = explode( "\n", $watched_directories_string );
        $watched_directories_array_sanitized = array();

        foreach ( $watched_directories_array as $directory ) {
            
            $directory = preg_replace( '/[^a-zA-Z\d-_\/]+/i', '', $directory );
            $directory = wp_normalize_path( $directory );
            $directory = untrailingslashit( $directory );

            if ( $directory ) {

                $watched_directories_array_sanitized[] = $directory;
                
            }

        }

        $data['watched-directories'] = $watched_directories_array_sanitized;

        adaptive_images_plugin_check_empty_setting( $data, 'watched-directories' );



        // JPEG quality field validation.

        $jpeg_quality = intval( $data['jpeg-quality'] );

        if ( $jpeg_quality == 0 ) {
            
            $jpeg_quality = $defaults['jpeg-quality'];
        }

        $data['jpeg-quality'] = $jpeg_quality;

        adaptive_images_plugin_check_empty_setting( $data, 'jpeg-quality' );



        // Sharpen field validation.

        $sharpen_images = isset( $data['sharpen-images'] ) && $data['sharpen-images'] == 'on' ? TRUE : FALSE;

        $data['sharpen-images'] = $sharpen_images;

        adaptive_images_plugin_check_empty_setting( $data, 'sharpen-images' );




        // Watch cache field validation.

        $watch_cache = isset( $data['watch-cache'] ) && $data['watch-cache'] == 'on' ? TRUE : FALSE;

        $data['watch-cache'] = $watch_cache;

        adaptive_images_plugin_check_empty_setting( $data, 'watch-cache' );



        // Browser cache field validation.

        $browser_cache = floatval( $data['browser-cache'] );

        if ( $browser_cache < 0  ) {

            $browser_cache = $defaults['browser-cache'];

        }

        $data['browser-cache'] = $browser_cache;

        adaptive_images_plugin_check_empty_setting( $data, 'browser-cache' );



        // Save plugin version.

        $data['version'] = adaptive_images_plugin_get_version();

        // To avoid the bug of sanitizing twice the first time the option is created.

        $data['sanitized'] = TRUE;



        // Notify user appropriately.

        $message = 'Adaptive Images &mdash; Settings updated. <hr /> <p>The settings have been saved in the database.</p>';



        // Add the adaptive images .htaccess rewrite block.

        $result = adaptive_images_actions_update_htaccess( $data );

        if ( is_wp_error( $result ) ) {

            $error_data = $result->get_error_data();
            $htaccess = $error_data['htaccess'];
            $permissions = adaptive_images_plugin_file_permissions( $htaccess );

            $message .= 
                '<p>' . 
                    $result->get_error_message() . ' ' .
                    'This probably means a filesystem error or a permissions problem: ' . 
                    '<code>' . $htaccess . ' => ' . $permissions . '</code>.' . 
                '</p>' .
                '<p>' .
                    'Consider adding this code to your .htaccess file manually: ' . 
                    '<blockquote><pre>' . htmlspecialchars( trim( $error_data['rewrite'] ) ) . '</pre></blockquote>' .
                '</p>';

        } else {

            $message .=
                '<p>' . 
                    'The .htaccess file was successfully updated: ' . 
                    '<code>' . adaptive_images_plugin_get_htaccess_file_path() . '</code>.' .
                '</p>';

        }



        // Save user settings PHP file.

        $result = adaptive_images_actions_save_user_settings( $data );

        if ( is_wp_error( $result ) ) {

            $file = adaptive_images_plugin_get_user_settings_file_path();
            $permissions = adaptive_images_plugin_file_permissions( $file );
            
            $message .= 
                '<p>' . 
                    $result->get_error_message() . ' ' . 
                    'This probably means a filesystem error or a permissions problem.' . 
                    '<code>' . $file . ' => ' . $permissions . '</code>. <br/>'. 
                '</p>' . 
                '<p>' . 
                    'The plugin will still be able to function but with its default settings until this problem is resolved.' .
                '</p>';

        } else {

            $message .= 
                '<p>' . 
                    'The user settings PHP file  was successfully updated: ' . '<code>' . adaptive_images_plugin_get_user_settings_file_path() . '</code>.' .
                '</p>';

        }



        // Inform user accordingly. 
        
        add_settings_error( 
           'adaptive-images-settings', 
           'adaptive-images-settings-error', 
           $message,
           'updated' 
        );



        return $data;

    }

?>