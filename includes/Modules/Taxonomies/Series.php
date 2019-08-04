<?php
/**
 * Series
 *
 * @package WPSM\Modules\Taxonomies
 */
namespace WPSM\Modules\Taxonomies;

use WPSM\MenuInterface;
use WPSM\MetaInterface;
use WPSM\Modules\ModuleInterface;
use WPSM\PluginInterface;
use WPSM\Util\HasPluginTrait;

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
		add_action( 'wpsm_init', [$this, 'registerTaxonomy'], 15 );
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
					'name'                       => esc_html_x( 'Series', 'taxonomy general name', 'wpsm' ),
					'singular_name'              => esc_html_x( 'Series', 'taxonomy singular name', 'wpsm' ),
					'search_items'               => esc_html__( 'Search Series', 'wpsm' ),
					'popular_items'              => esc_html__( 'Popular Series', 'wpsm' ),
					'all_items'                  => esc_html__( 'All Series', 'wpsm' ),
					'edit_item'                  => esc_html__( 'Edit Series', 'wpsm' ),
					'view_item'                  => esc_html__( 'View Series', 'wpsm' ),
					'update_item'                => esc_html__( 'Update Series', 'wpsm' ),
					'add_new_item'               => esc_html__( 'Add New Series', 'wpsm' ),
					'new_item_name'              => esc_html__( 'New Series Name', 'wpsm' ),
					'separate_items_with_commas' => esc_html__( 'Separate series with commas', 'wpsm' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove series', 'wpsm' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used series', 'wpsm' ),
					'not_found'                  => esc_html__( 'No series found.', 'wpsm' ),
					'no_terms'                   => esc_html__( 'No series', 'wpsm' ),
					'items_list_navigation'      => esc_html__( 'Series list navigation', 'wpsm' ),
					'items_list'                 => esc_html__( 'Series list', 'wpsm' ),
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
