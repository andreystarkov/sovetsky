<?php
if ( !defined( 'ABSPATH' ) || preg_match(
        '#' . basename( __FILE__ ) . '#',
        $_SERVER['PHP_SELF']
    )
) {
    die( "You are not allowed to call this page directly." );
}
?>
<form id="plugin-settings-form" class="settings-form" method="post" action="">
    <div id="plugin-settings">
        <?php \PostListFeaturedImage\Lib\Helper::do_settings_sections( $plugin_settings_section ); ?>
    </div>
    <?php submit_button( null, 'primary save-plfi-settings-btn' ); ?>
</form>
