<?php

    /******************************************************************************************************************
     *                                                                                                                *
     *                                                                                                                *
     *      ALL FUNCTIONS THAT REFER TO THE USER FRONTEND/THEME                                                       *
     *      ===================================================                                                       *
     *                                                                                                                *
     *      Nevma (info@nevma.gr)                                                                                     *
     *                                                                                                                *
     *                                                                                                                *
     ******************************************************************************************************************/



    // 
    // Exit, if file is accessed directly.
    // 
    if ( ! defined( 'ABSPATH' ) ) {

        exit; 

    }



    /**
     * Prints out the Javascript code in the beginning of the head element, which sets the cookie with the user device 
     * width/resolution. This cookie is necessary from there and on so that the plugin can know which image sizes to 
     * serve to this client.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void Nothing really!
     */

    function adaptive_images_front_head_cookie_javascript () { 

        $options = get_option( 'adaptive-images' ); ?>

        <!--noptimize-->
        <script type = "text/javascript">

            // 
            // Get screen dimensions, device pixel ration and set in a cookie.
            // 
            
            <?php if ( $options['landscape'] ) : ?>
                var screen_width = Math.max( screen.width, screen.height );
            <?php else : ?>
                var screen_width = screen.width;
            <?php endif; ?>

            var devicePixelRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;

            document.cookie = 'resolution=' + screen_width + ',' + devicePixelRatio + '; path=/';

        </script> 
        <!--/noptimize--> <?php

    }



    /**
     * Prints out the Javascript code in the beginning of the head element, which adds a special url parameter to each
     * page's images, relevant to the device's resolution, so that CDNs can understand which cached version of an image 
     * to send to the browser.
     * 
     * @author Nevma (info@nevma.gr)
     * 
     * @return void Nothing really!
     */

    function adaptive_images_front_head_image_cdn_javascript () { 

        $options = get_option( 'adaptive-images' ); 

        if ( ! $options['cdn-support'] ) {

            return;

        } ?>

        <!--noptimize-->
        <script type = "text/javascript">

            //
            // Anonymous self calling Javascript function to avoid polluting the global namespace.
            //

            (function () {

                //
                // Get the resolution cookie.
                //

                var resolution = null;

                var cookies = document.cookie.split( ';' );

                for ( var k in cookies ) {

                    var cookie = cookies[k].trim();

                    if ( cookie.indexOf( 'resolution' ) === 0 ) {

                        resolution = cookie;

                    }

                }



                //
                // Adds the resolution information to image src attributes.
                //

                function handle_images () {

                    var imgs = document.querySelectorAll( 'img' );

                    for ( var k = 0; k < imgs.length; k++ ) {

                        var img = imgs[k];

                        if ( img.complete || img.getAttribute( 'data-adaptive-images' ) ) {

                            continue;

                        }

                        var src = img.getAttribute( 'src' );
                        var new_src = src.indexOf( '?' ) >=0 ? src + '&' + resolution : src + '?' + resolution;

                        img.removeAttribute( 'src' );
                        img.setAttribute( 'src', new_src );
                        img.setAttribute( 'data-adaptive-images', true );

                    }

                }



                // 
                // Start running periodically, as images are available in the DOM.
                // 

                var handler = window.setInterval( handle_images, 10 );

                document.addEventListener( 'DOMContentLoaded', function ( event ) {

                    window.clearInterval( handler );
                    handle_images();

                });

            })();

        </script> 
        <!--/noptimize--> <?php

    }

?>