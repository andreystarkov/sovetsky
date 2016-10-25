jQuery( function ( $ ) {
    $( "#tabs" ).tabs();
    
    $( '.if-js-closed' ).removeClass( 'if-js-closed' ).addClass( 'closed' );
    postboxes.add_postbox_toggles( 'post_list_featured_image_dashboard_main');

    $( '#plugin-admin-page' ).on( 'click', '.save-plfi-settings-btn, .ms-save-plfi-settings-btn', function ( event ) {
        event.preventDefault();

        var forms = $( 'form.settings-form', '.ui-tabs-panel' ),
            ms_btn = $( this ).attr( 'class' ),
            is_ms = (ms_btn.search( 'ms-save-plfi-settings-btn' ) > -1),
            notice = $( '#setting-error-settings_updated' ),
            data = '';

        forms.each( function ( i, el ) {
            if ( data === '' ) {
                data = $( el ).serialize();
            } else {
                data = data + '&' + $( el ).serialize();
            }
        } );
        data = data + '&' + $.param( {
            action  : 'do_save_plfi_plugin_settings',
            _wpnonce: plfi.nonces.save_plfi_settings,
            is_ms   : is_ms
        } );

        notice.fadeOut();
        $.ajax( {
            url     : ajaxurl,
            type    : 'POST',
            data    : data,
            dataType: 'json'
        } ).done(function ( response, textStatus, jqXHR ) {
            if ( response.success ) {
                notice.removeClass( 'error' ).addClass( 'updated' )
                    .html( '<p><strong>' + response.data.message + '</strong> <em>' + '</em></p>' ).show();
                setTimeout( function () {
                    document.location.reload( true );
                }, 1000 );
            } else {
                notice.removeClass( 'updated' ).addClass( 'error' )
                    .html( '<p><strong>' + response.data.message + '</strong></p>' ).show();
            }
        } ).fail( function ( jqXHR, textStatus, errorThrown ) {
            console.log( errorThrown );
            notice.removeClass( 'updated' ).addClass( 'error' )
                .html( '<p><strong>' + errorThrown + '</strong></p>' ).show();
        } );
    } );
} );
