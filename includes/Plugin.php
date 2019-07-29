<?php
/**
 * Plugin
 *
 * @package WPSM/Plugin
 */
namespace WPSermonManager;

use WPSermonManager\Admin\UserRoles;
use WPSermonManager\Admin\Settings;
use WPSermonManager\Filters\Fields\SermonTitle;
use WPSermonManager\PostTypes\Sermons;
use WPSermonManager\Taxonomies\Books;
use WPSermonManager\Taxonomies\Series;
use WPSermonManager\Taxonomies\Speakers;
use WPSermonManager\Taxonomies\Topics;

/**
 * The Plugin Class.
 *
 * Handles initializing the plugin.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Property representing an instance of the UserRoles class.
	 *
	 * @access public
	 * @var \WPSermonManager\Admin\UserRoles
	 */
	public $user_roles;

	/**
	 * Property representing an instance of the Settings class.
	 *
	 * @access public
	 * @var \WPSermonManager\Admin\Settings
	 */
	public $settings;

	/**
	 * Property representing an instance of the SermonTitle class.
	 *
	 * @access public
	 * @var \WPSermonManager\Filters\Fields\SermonTitle
	 */
	public $sermon_title_filter;

	/**
	 * Property representing an instance of the Sermons class.
	 *
	 * @access public
	 * @var \WPSermonManager\PostTypes\Sermons
	 */
	public $sermons_cpt;

	/**
	 * Property representing an instance of the Books class.
	 *
	 * @access public
	 * @var \WPSermonManager\Taxonomies\Books
	 */
	public $books_tax;

	/**
	 * Property representing an instance of the Series class.
	 *
	 * @access public
	 * @var \WPSermonManager\Taxonomies\Series
	 */
	public $series_tax;

	/**
	 * Property representing an instance of the Speakers class.
	 *
	 * @access public
	 * @var \WPSermonManager\Taxonomies\Speakers
	 */
	public $speakers_tax;

	/**
	 * Property representing an instance of the Topics class.
	 *
	 * @access public
	 * @var \WPSermonManager\Taxonomies\Topics
	 */
	public $topics_tax;

	/**
	 * The Plugin constructor.
	 */
	public function __construct() {
		$this->user_roles = new UserRoles();
		$this->settings = new Settings();
		$this->sermon_title_filter = new SermonTitle();
		$this->sermons_cpt = new Sermons();
		$this->speakers_tax = new Speakers();
		$this->series_tax = new Series();
		$this->topics_tax = new Topics();
		$this->books_tax = new Books();

		add_action( 'admin_enqueue_scripts', array( $this, 'enquque_admin_styles' ) );
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Method that enqueues admin styles.
	 */
	public function enquque_admin_styles() {

		$min = defined( 'SCRIPT_DEBUG' ) && filter_var( SCRIPT_DEBUG, FILTER_VALIDATE_BOOLEAN ) ? '' : '.min';
		$plugin_url = trailingslashit( WP_SERMON_MANAGER_URL );

		wp_register_style(
			'wpsm_admin_css',
			esc_url( $plugin_url . '/dist/css/admin' . $min . '.css' ),
			false,
			'1.0.0'
		);

		wp_enqueue_style( 'wpsm_admin_css' );
	}

	/**
	 * Method that initializes the plugin and fires an action other plugins can hook into.
	 *
	 * @return void
	 */
	public function init() {
		do_action( 'wpsm_init' );
	}

	/**
	 * Method that sets up the text domain.
	 *
	 * @return void
	 */
	public function i18n() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-sermon-manager' );
		load_textdomain( 'wp-sermon-manager', WP_LANG_DIR . '/wp-sermon-manager/wp-sermon-manager-' . $locale . '.mo' );
		load_plugin_textdomain( 'wp-sermon-manager', false, plugin_basename( WP_SERMON_MANAGER_PATH ) . '/languages/' );
	}
}
