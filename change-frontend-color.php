<?php
/**
 * Plugin Name:     Change Frontend Color
 * Plugin URI:      https://github.com/webtestingrun15/change-frontend-color/
 * Description:     Plugin that changes the frontend color of with the ability to save color to WordPress options.
 * Author:          Sheldon Francis
 * Author URI:      https://sheldonfweb.com/
 * Text Domain:     change-frontend-color
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Change_Frontend_Color
 */

/* exit if directly accessed */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
	include_once $file;
}

foreach ( glob( plugin_dir_path( __FILE__ ) . 'public/*.php' ) as $file ) {
	include_once $file;
}

add_action( 'plugins_loaded', 'change_frontend_color' );
/**
 * Start Plugin
 */
function change_frontend_color() {

	$cfc_save    = new CFC_Save_Options();
	$cfc_options = new CFC_Submenu_Options( $cfc_save );
	$cfc_style   = new CFC_Frontend();

}

/**
 * Deactivation hook.
 */
function cfc_deactivate() {
		// Unregister the post type, so the rules are no longer in memory.
		delete_option( 'cfc-custom-data' );
		// Clear the permalinks to remove our post type's rules from the database.
		flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'cfc_deactivate' );
