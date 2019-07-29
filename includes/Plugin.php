<?php
/**
 * Plugin
 *
 * @package WPSM/Plugin
 */
namespace WPSermonManager;

use WPSermonManager\Helpers;
use WPSermonManager\SermonsCPT;
use WPSermonManager\UserRoles;
use WPSermonManager\Settings;
use WPSermonManager\SpeakersTaxonomy;
use WPSermonManager\SeriesTaxonomy;
use WPSermonManager\TopicsTaxonomy;
use WPSermonManager\BooksTaxonomy;
use WPSermonManager\ServiceTypeTaxonomy;

/**
 * The Plugin Class.
 *
 * Handles initializing the plugin.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Property representing an instance of the Helpers class.
	 *
	 * @access public
	 * @var \WPSermonManager\Helpers
	 */
	public $helpers;

	/**
	 * Property representing an instance of the SermonsCPT class.
	 *
	 * @access public
	 * @var \WPSermonManager\SermonsCPT
	 */
	public $sermons_cpt;

	/**
	 * Property representing an instance of the UserRoles class.
	 *
	 * @access public
	 * @var \WPSermonManager\UserRoles
	 */
	public $user_roles;

	/**
	 * Property representing an instance of the Settings class.
	 *
	 * @access public
	 * @var \WPSermonManager\Settings
	 */
	public $settings;

	/**
	 * Property representing an instance of the SpeakersTaxonomy class.
	 *
	 * @access public
	 * @var \WPSermonManager\SpeakersTaxonomy
	 */
	public $speakers_tax;

	/**
	 * Property representing an instance of the SeriesTaxonomy class.
	 *
	 * @access public
	 * @var \WPSermonManager\SeriesTaxonomy
	 */
	public $series_tax;

	/**
	 * Property representing an instance of the TopicsTaxonomy class.
	 *
	 * @access public
	 * @var \WPSermonManager\TopicsTaxonomy
	 */
	public $topics_tax;

	/**
	 * Property representing an instance of the BooksTaxonomy class.
	 *
	 * @access public
	 * @var \WPSermonManager\BooksTaxonomy
	 */
	public $books_tax;

	/**
	 * Property representing an instance of the ServiceTypeTaxonomy class.
	 *
	 * @access public
	 * @var \WPSermonManager\ServiceTypeTaxonomy
	 */
	public $service_type_tax;

	/**
	 * The Plugin constructor.
	 */
	public function __construct() {
		$this->helpers = new Helpers();
		$this->sermons_cpt = new SermonsCPT();
		$this->user_roles = new UserRoles();
		$this->settings = new Settings();
		$this->speakers_tax = new SpeakersTaxonomy();
		$this->series_tax = new SeriesTaxonomy();
		$this->topics_tax = new TopicsTaxonomy();
		$this->books_tax = new BooksTaxonomy();
		$this->service_type_tax = new ServiceTypeTaxonomy();

		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'init', array( $this, 'init' ) );
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
