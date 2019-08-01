<?php
/**
 * Plugin
 *
 * @package WPSermonManager
 */
namespace WPSermonManager;

use WPSermonManager\Modules\ModuleInterface;
use WPSermonManager\Modules\PostTypes\PostTypeInterface;
use WPSermonManager\Modules\Taxonomies\TaxonomyInterface;
use WPSermonManager\Util\HasPluginInterface;

if ( ! defined( 'WPINC' ) )  die;

/**
 * The Plugin Class.
 *
 * Handles initializing the plugin.
 *
 * @since 1.0.0
 */
class Plugin implements PluginInterface {

	/** @var ModuleInterface[] */
	private $modules = [ ];

	/** @var PostTypeInterface[] */
	private $postTypes = [ ];

	/** @var TaxonomyInterface[] */
	private $taxonomies = [ ];

	/** @var MenuInterface[] */
	private $menus = [ ];

	/**
	 * Method to setup the plugin's main functionality
	 */
	public function setup() {

		$this->setupL10n();

		/**
		 * Initialize the plugin
		 *
		 * @param Plugin $this
		 */
		do_action( 'wp_sermon_manager_init', $this );
	}

	/**
	 * Method to register a module with the plugin
	 *
	 * @param ModuleInterface $module
	 *
	 * @return $this
	 */
	public function registerModule( ModuleInterface $module ) {

		$this->modules[ $module->getModuleSlug() ] = $module;

		if ( $module instanceof HasPluginInterface ) {
			$module->setPlugin( $this );
		}

		$module->setupModule( $this );

		if ( $module instanceof PostTypeInterface ) {
			$this->registerPostType( $module );
		}

		if ( $module instanceof TaxonomyInterface ) {
			$this->registerTaxonomy( $module );
		}

		if ( $module instanceof MenuInterface ) {
			$this->registerMenu( $module );
		}

		return $this;
	}

	/**
	 * Method to register a post type object
	 *
	 * @param PostTypeInterface $postType
	 *
	 * @return $this
	 */
	public function registerPostType( PostTypeInterface $postType ) {

		$postTypeSlug = $postType->getPostTypeSlug();

		if ( $postTypeSlug ) {
			$this->postTypes[ $postTypeSlug ] = $postType;
		}

		return $this;
	}

	/**
	 * Method to get a post type object
	 *
	 * @param string $name
	 *
	 * @return PostTypeInterface|null
	 */
	public function getPostType( $name ) {
		return isset( $this->postTypes[ $name ] ) ? $this->postTypes[ $name ] : null;
	}

	/**
	 * Method to register a taxonomy object
	 *
	 * @param TaxonomyInterface $taxonomy
	 *
	 * @return $this
	 */
	public function registerTaxonomy( TaxonomyInterface $taxonomy ) {

		$taxonomySlug = $taxonomy->getTaxonomySlug();

		if ( $taxonomySlug ) {
			$this->taxonomies[ $taxonomySlug ] = $taxonomy;
		}

		return $this;
	}

	/**
	 * Method to get a taxonomy object
	 *
	 * @param string $name
	 *
	 * @return TaxonomyInterface|null
	 */
	public function getTaxonomy( $name ) {
		return isset( $this->taxonomies[ $name ] ) ? $this->taxonomies[ $name ] : null;
	}

	/**
	 * Method to get a menu object
	 *
	 * By default it will return the first available menu
	 *
	 * @param string $slug
	 *
	 * @return MenuInterface|null
	 */
	public function getMenu( $slug = '' ) {

		if ( ! $slug ) {
			return reset( $this->menus ) ?: null;
		}

		return isset( $this->menus[ $slug ] ) ? $this->menus[ $slug ] : null;
	}

	/**
	 * Method to add another menu
	 *
	 * @param MenuInterface $menu
	 *
	 * @return $this
	 */
	public function registerMenu( MenuInterface $menu ) {

		$this->menus[ $menu->getMenuSlug() ] = $menu;

		return $this;
	}

	/**
	 * Method to render a template
	 *
	 * @param string $__template_file
	 * @param array $__template_data
	 * @param boolean $__admin_tmpl
	 */
	public function template( $__template_file, array $__template_data = [ ], bool $__admin_tmpl = false ) {

		$tmpl_dir = trailingslashit( ( true === $__admin_tmpl ? 'includes/Admin/Templates' : 'templates' ) );

		$__template_file = apply_filters( 'wpsm-template', WP_SERMON_MANAGER_PATH . $tmpl_dir . '$__template_file.php', $__template_file, $__template_data );

		if ( $__template_file && file_exists( $__template_file ) ) {
			extract( $__template_data, EXTR_SKIP );
			require $__template_file;
		}
	}

	/**
	 * Method to set up the text domain
	 */
	public function setupL10n() {

		$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-sermon-manager' );
		load_textdomain( 'wp-sermon-manager', WP_LANG_DIR . '/wp-sermon-manager/wp-sermon-manager-' . $locale . '.mo' );
		load_plugin_textdomain( 'wp-sermon-manager', false, plugin_basename( WP_SERMON_MANAGER_PATH ) . '/languages/' );
	}
}
