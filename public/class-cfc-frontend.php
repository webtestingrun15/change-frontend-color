<?php
/**
 * Change Frontend Colors
 *
 * @package Change_Frontend_Color
 */

/**
 * Change Frontend Colors for plugin.
 *
 * @package Change_Frontend_Color
 */
class CFC_Frontend {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'my_custom_css' ) );
	}


	/**
	 * Load stylesheet.
	 *
	 * @package Change_Frontend_Color
	 */
	public function my_custom_css() {
		include plugin_dir_path( __FILE__ ) . 'cfc-styles.php';
	}

}
