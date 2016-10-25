/**
 * This function:
 *
 * Generates a custom image uploader / selector tied to a post where the click action originated
 * Upon clicking "Use as thumbnail" the image selected is set to be the post thumbnail
 * A thumbnail image is then shown in the All Posts / All Pages / All Custom Post types Admin Dashboard view
 *
 * @since 1.0.0
 *
 * global ajaxurl, fiat_thumb
 */
(function($){
    //uploading files variable
    var thumbnail_upload_frame;

    // inspired from:
    // mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/

    jQuery(document).on('click', '.fiat_thickbox', function(event) {
        event.preventDefault();

        var that    = this.href;
        var thumb_id = this.dataset.thumbnailId;
        // get post id to assign thumbnail to
        var post_id = FIATparseUrl(that).params.post_id;
        var type    = FIATparseUrl(that).params.type;
        // Get our nonce for use later with AJAX post.
        var nonce   = FIATparseUrl(that).params._wpnonce;

        //If the frame already exists, reopen it
        if (typeof(thumbnail_upload_frame)!=="undefined") {
            thumbnail_upload_frame.close();
        }
        // Set the title and expected images to use in the dialog
        thumbnail_upload_frame = wp.media.frames.customHeader = wp.media({
            //Title of media manager frame
            title: "Featured Image Admin Thumb",
            library: {
                type: 'image'
            },
            button: {
                //Button text
                text: fiat_thumb.button_text
            },
            states: [
                new wp.media.controller.Library({
                    library:   wp.media.query({ type: 'image' }),
                    multiple:  false, // do not allow multiple files, if you want multiple, set true
                    filterable: 'all' // turn on filters
                })
            ]
        });
        // Set the post id we would like the thumbnail assigned to
        wp.media.model.settings.post.id = post_id;

        thumbnail_upload_frame.on('open', function() {
            var selection = thumbnail_upload_frame.state().get('selection');
            var selected_thumb = wp.media.attachment(thumb_id);
            selected_thumb.fetch();
            selection.add([selected_thumb]);
        });
        //callback for selected image when the "Use as thumbnail" is clicked
        thumbnail_upload_frame.on('select', function() {
            var attachment = thumbnail_upload_frame.state().get('selection').first().toJSON();

            // Use WP AJAX function to set the selected image as post thumbnail.
            jQuery.post ( ajaxurl, {
                action:         'set-post-thumbnail',
                post_id:        post_id,
                thumbnail_id:   attachment.id,
                _ajax_nonce:    nonce,
                cookie:         encodeURIComponent( document.cookie )
            }).done( function( html ) {
                // Inject thumbnail image onto related post in All Posts/All Pages view
                jQuery.post( ajaxurl, {
                    action:         'fiat_get_thumbnail',
                    thumbnail_id:   attachment.id,
                    post_id:        post_id,
                    _ajax_nonce:    nonce
                }).done ( function( thumb_url )  {
                    // This is the column location to place the img
					var pre_html = '<a title="' + fiat_thumb.change_featured_image + '" href="' + '/wp-admin/media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=1&_wpnonce=' + nonce + '" id="set-post-thumbnail" class="fiat_thickbox" >';
					var post_html = '</a>';
                    $( '.thumb', '#post-' + post_id ).html( pre_html + thumb_url + post_html );
                    $( '.thumb', '#post-' + post_id ).hide().fadeIn();
                })
            });
        });

        //Open custom image modal
        thumbnail_upload_frame.open();
    });

    /**
     * Parse supplied url and return parameters found as object
     *
     * @param url
     * @returns {{params}}
     * @constructor
     */
    function FIATparseUrl( url ) {

        // props: http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
        var a = document.createElement('a');
        a.href = url;
        return {
            params: (function(){
                var ret = {},
                    seg = a.search.replace(/^\?/,'').split('&'),
                    len = seg.length, i = 0, s;
                for (;i<len;i++) {
                    if (!seg[i]) { continue; }
                    s = seg[i].split('=');
                    ret[s[0]] = s[1];
                }
                return ret;
            })()
        }
    }

}(jQuery));