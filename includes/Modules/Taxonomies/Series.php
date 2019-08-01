<?php
/**
 * Series
 *
 * @package WPSermonManager\Modules\Taxonomies
 */
namespace WPSermonManager\Modules\Taxonomies;

use WPSermonManager\MenuInterface;
use WPSermonManager\MetaInterface;
use WPSermonManager\Modules\ModuleInterface;
use WPSermonManager\PluginInterface;
use WPSermonManager\Util\HasPluginTrait;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The Series Class
 *
 * Handles registering the Series taxonomy.
 *
 * @since 1.0.0
 */
class Series implements TaxonomyInterface, ModuleInterface {

	use HasPluginTrait, TaxonomyTrait;

	const SLUG = 'wpsm-sermon-series';

	/** @var MenuInterface */
	private $menu;

	/**
	 * The Series Constructor.
	 */
	public function __construct( MenuInterface $menu ) {
		$this->menu = $menu;
	}

	/**
	 * Method to get this module's slug
	 *
	 * Slugs should be unique
	 *
	 * @return string
	 */
	public function getModuleSlug() {
		return 'module-' . static::SLUG;
	}

	/**
	 * Method to initialize the module. Whatever a module needs to do prior to init should be done here.
	 *
	 * This would include hooking into the glp_lcm_init action (runs on init, but is specific to this plugin.
	 *
	 * @param PluginInterface $plugin
	 */
	public function setupModule( PluginInterface $plugin ) {
		$this->setPlugin( $plugin );
		add_action( 'wp_sermon_manager_init', [$this, 'registerTaxonomy'], 15 );
	}

	/**
	 * Method to get the taxonomy slug
	 *
	 * @return string
	 */
	public function getTaxonomySlug() {
		return static::SLUG;
	}

	/**
	 * Method to register the taxonomy
	 */
	public function registerTaxonomy() {
		register_taxonomy( $this->getTaxonomySlug(),
			$this->getPlugin()->getPostType( 'wpsm-sermon' )->getPostTypeSlug(), [
				'labels'            => [
					'name'                       => esc_html_x( 'Series', 'taxonomy general name', 'wp-sermon-manager' ),
					'singular_name'              => esc_html_x( 'Series', 'taxonomy singular name', 'wp-sermon-manager' ),
					'search_items'               => esc_html__( 'Search Series', 'wp-sermon-manager' ),
					'popular_items'              => esc_html__( 'Popular Series', 'wp-sermon-manager' ),
					'all_items'                  => esc_html__( 'All Series', 'wp-sermon-manager' ),
					'edit_item'                  => esc_html__( 'Edit Series', 'wp-sermon-manager' ),
					'view_item'                  => esc_html__( 'View Series', 'wp-sermon-manager' ),
					'update_item'                => esc_html__( 'Update Series', 'wp-sermon-manager' ),
					'add_new_item'               => esc_html__( 'Add New Series', 'wp-sermon-manager' ),
					'new_item_name'              => esc_html__( 'New Series Name', 'wp-sermon-manager' ),
					'separate_items_with_commas' => esc_html__( 'Separate series with commas', 'wp-sermon-manager' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove series', 'wp-sermon-manager' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used series', 'wp-sermon-manager' ),
					'not_found'                  => esc_html__( 'No series found.', 'wp-sermon-manager' ),
					'no_terms'                   => esc_html__( 'No series', 'wp-sermon-manager' ),
					'items_list_navigation'      => esc_html__( 'Series list navigation', 'wp-sermon-manager' ),
					'items_list'                 => esc_html__( 'Series list', 'wp-sermon-manager' ),
				],
				'public'            => true,
				'hierarchical'      => false,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => false,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
				'rewrite'           => [
					'slug'                       => 'sermons/series',
					'with_front'                 => true,
					'hierarchical'               => false,
				],
				'show_in_rest'      => true,
			] );
	}
}
