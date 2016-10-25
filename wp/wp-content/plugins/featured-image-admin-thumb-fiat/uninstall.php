<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Featured_Image_Admin_Thumb
 * @author    Sean Hayes <sean@seanhayes.biz>
 * @license   GPL-2.0+
 * @link      http://www.seanhayes.biz
 * @copyright 2014 Sean Hayes
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// @TODO: Define uninstall functionality here