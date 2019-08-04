<?php
/**
 * Settings
 *
 * @package WPSM\Admin
 */
namespace WPSM\Admin\Settings;

/**
 * The General Class.
 *
 * Handles displaying the settings page and saving data.
 *
 * @since 1.0.0
 */
class General {

	/**
	 * The General constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'settings_menu' ), 60 );
	}

	/**
	 * Method to add a General Settings page as a submenu of the Sermons post type.
	 */
	public function settings_menu() {

		add_submenu_page(
			'edit.php?post_type=wpsm_sermon',
			__( 'Sermon Manager Settings', 'wpsm' ),
			__( 'Settings', 'wpsm' ),
			'manage_wpsm_settings',
			'wpsm-settings',
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Method to render the General Settings page.
	 */
	public function settings_page() {
		?>
		<div class="test"></div>
		<?php
	}

	/**
	 * Callback function for the settings section.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function setting_section_callback() {
		?>
		<p><?php esc_html_e( 'Settings for the WP Sermon Manager.', 'wpsm' ); ?></p>
		<?php
	}

	/**
	 * Callback function for the settings field.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function setting_callback() {
		$svg_path_option = '';
		?>

		<input name="wpsm_path" id="wpsm_path" type="text" value="<?php echo esc_attr( $svg_path_option ); ?>" class="regular-text" />
		<p class="description"><?php esc_html_e( 'The path to the active theme\'s SVG files. The default location is: ', 'wpsm' ); ?><code><?php esc_html_e( 'assets/svg/dist/', 'wpsm' ); ?></code></p>

		<?php
	}
}
