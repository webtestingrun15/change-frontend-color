<?php
/**
 * Save Admin Settings
 *
 * @package Change_Frontend_Color
 */

/**
 *  Save Admin Settings
 *
 * @package Change_Frontend_Color
 */
class CFC_Save_Options {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_post', array( $this, 'cfc_save' ) );
	}

	/**
	 * Save the color option
	 *
	 * @return void
	 */
	public function cfc_save() {
		if ( ! ( $this->has_valid_nonce() && current_user_can( 'manage_options' ) ) ) {
			echo '<div class=""notice notice-error is-dismissible"> <p><strong>How did you get here.</strong></p></div>';
		}

		// If the above are valid, sanitize and save the option.

		if ( null !== wp_unslash( $_POST['cfc-color'] ) ) {

			$value = sanitize_text_field( $_POST['cfc-color'] );
			update_option( 'cfc-custom-data', $value );


		}
		$this->redirect();

	}

	/**
	 * Determines if the nonce variable associated with the options page is set
	 * and is valid.
	 *
	 * @access private
	 *
	 * @return boolean False if the field isn't set or the nonce value is invalid;
	 *                 otherwise, true.
	 */
	private function has_valid_nonce() {

		// If the field isn't even in the $_POST, then it's invalid.
		if ( ! isset( $_POST['cfc-color-field'] ) ) { // Input var okay.
			return false;
		}

		$field  = wp_unslash( $_POST['cfc-color-field'] );
		$action = 'cfc-settings-save';

		return wp_verify_nonce( $field, $action );

	}

	/**
	* Redirect to the page from which we came (which should always be the
	* admin page. If the referred isn't set, then we redirect the user to
	* the login page.
	*
	* @access private
	*/
	private function redirect() {

		// To make the Coding Standards happy, we have to initialize this.
		if ( ! isset( $_POST['_wp_http_referer'] ) ) { // Input var okay.
			$_POST['_wp_http_referer'] = wp_login_url();
		}

		// Sanitize the value of the $_POST collection for the Coding Standards.
		$url = sanitize_text_field(
			wp_unslash( $_POST['_wp_http_referer'] ) // Input var okay.
		);

		// Finally, redirect back to the admin page.
		wp_safe_redirect( urldecode( $url ) );
		exit;

	}


}

