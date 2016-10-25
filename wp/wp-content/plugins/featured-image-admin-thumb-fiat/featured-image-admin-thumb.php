<?php
/**
 *
 * @package   Featured_Image_Admin_Thumb
 * @author    Sean Hayes <sean@seanhayes.biz>
 * @license   GPL-2.0+
 * @link      http://www.seanhayes.biz
 * @copyright 2014 Sean Hayes
 *
 * @wordpress-plugin
 * Plugin Name:       Featured Image Admin Thumb
 * Plugin URI:        http://www.seanhayes.biz
 * Description:       Adds inline thumbnail image to admin columns for All Post/post types view (where supported). Click to easily set/change the featured image for that content.
 * Version:           1.4.1
 * Author:            Sean Hayes
 * Author URI:        http://www.seanhayes.biz
 * Text Domain:       featured-image-admin-thumb-fiat
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/


require_once( plugin_dir_path( __FILE__ ) . 'public/class-featured-image-admin-thumb.php' );

register_activation_hook( __FILE__,     array( 'Featured_Image_Admin_Thumb', 'activate' ) );
register_deactivation_hook( __FILE__,   array( 'Featured_Image_Admin_Thumb', 'deactivate' ) );

add_action( 'plugins_loaded',           array( 'Featured_Image_Admin_Thumb', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
//if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
if ( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-featured-image-admin-thumb-admin.php' );
	add_action( 'plugins_loaded', array( 'Featured_Image_Admin_Thumb_Admin', 'get_instance' ) );

}
