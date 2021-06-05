<?php
/**
 * Create Admin submenu page.
 *
 * @package Change_Frontend_Color
 */

/**
 * Create Admin submenu page for plugin.
 *
 * @package Change_Frontend_Color
 */
class CFC_Submenu_Options {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'cfc_color_script' ) );
	}

	/**
	 * Register new settings page
	 */
	public function admin_menu() {
		add_options_page(
			__( 'Change Frontend Color Settings', 'change-frontend-color' ),
			__( 'Change Frontend Color Settings', 'change-frontend-color' ),
			'manage_options',
			'cfc_option_settings',
			array(
				$this,
				'cfc_settings_page',
			)
		);
	}
	/**
	 * Callback function for displaying settings page
	 */
	public function cfc_settings_page() {

		?>
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
		<?php

		$options = get_option( 'cfc-custom-data', 'rgba(255,255,255,0.85)' );

		echo '<input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(255,255,255,0.85)" name="cfc-color" value="' . esc_attr( $options ) . '"/>';

		?>
		<?php
			wp_nonce_field( 'cfc-settings-save', 'cfc-color-field' );
			submit_button();
		?>
		</form>
		<?php
	}

	/**
	 * Load and Swap the default wordpress color picker.
	 *
	 * @param string $hook looks for a hook to return option page.
	 * @return void
	 */
	public function cfc_color_script( $hook ) {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/js/wp-color-picker-alpha.min.js', __FILE__ ), array( 'wp-color-picker' ), '3.0.0', true );
		wp_enqueue_script( 'change-frontend-color-admin', plugins_url( '/js/change-frontend-color-admin.js', __FILE__ ), array( 'wp-color-picker' ), '1.0.0', true );
	}

}

