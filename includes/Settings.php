<?php
/**
 * Settings
 *
 * @package WPSM/Settings
 */
namespace WPSermonManager;

/**
 * The Settings class.
 *
 * Handles displaying the settings page and saving data.
 *
 * @since 1.0.0
 */
class Settings {

	/**
	 * The Settings constructor.
	 */
	public function __construct() {
		//add_action( 'admin_init', array( $this, 'init_settings' ) );
		add_action( 'admin_menu', array( $this, 'settings_menu' ), 60 );
	}

	public function settings_menu() {

		add_submenu_page(
			'edit.php?post_type=wpsm_sermon',
			__( 'Sermon Manager Settings', 'wp-sermon-manager' ),
			__( 'Settings', 'wp-sermon-manager' ),
			'manage_wpsm_settings',
			'wpsm-settings',
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Init the settings page.
	 */
	public function settings_page() {
		?>
		<div class="test"></div>
		<?php
	}

	public function output() {
		?>
		<div class="test"></div>
		<?php
	}

	/**
	 * Method that adds Setting Sections and Fields to the WordPress Media Settings screen.
	 */
	public function init_settings() {

		add_settings_section(
			'wpsm_path_section',
			'WP Sermon Manager',
			array( $this, 'setting_section_callback' ),
			'media'
		);

		add_settings_field(
			'wpsm_path',
			'Path to svg files',
			array( $this, 'setting_callback' ),
			'media',
			'wpsm_path_section'
		);

		register_setting( 'media', 'wpsm_path', 'sanitize_text_field' );
	}

	/**
	 * Callback function for the settings section.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function setting_section_callback() {
		?>
		<p><?php esc_html_e( 'Settings for the WP Sermon Manager.', 'wp-sermon-manager' ); ?></p>
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
		<p class="description"><?php esc_html_e( 'The path to the active theme\'s SVG files. The default location is: ', 'wp-sermon-manager' ); ?><code><?php esc_html_e( 'assets/svg/dist/', 'wp-sermon-manager' ); ?></code></p>

		<?php
	}
}
