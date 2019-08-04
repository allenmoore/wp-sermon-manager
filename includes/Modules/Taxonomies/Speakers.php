<?php
/**
 * Speakers
 *
 * @package WPSM\Modules\Taxonomies
 */
namespace WPSM\Modules\Taxonomies;

use WPSM\MenuInterface;
use WPSM\MetaInterface;
use WPSM\Modules\ModuleInterface;
use WPSM\PluginInterface;
use WPSM\Util\HasPluginTrait;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The Speakers Class
 *
 * Handles registering the Speakers taxonomy.
 *
 * @since 1.0.0
 */
class Speakers implements TaxonomyInterface, ModuleInterface {

	use HasPluginTrait, TaxonomyTrait;

	const SLUG = 'wpsm-sermon-speaker';

	/** @var MenuInterface */
	private $menu;

	/**
	 * The Speakers Constructor.
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
	 * Method to initialize the module. Whatever a module needs to do prior to init should be done here
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
		register_taxonomy( $this->getTaxonomySlug(), $this->getPlugin()->getPostType( 'wpsm-sermon' )->getPostTypeSlug(), [
			'labels'            => [
				'name'                       => esc_html_x( 'Speakers', 'taxonomy general name', 'wpsm' ),
				'singular_name'              => esc_html_x( 'Speaker', 'taxonomy singular name', 'wpsm' ),
				'search_items'               => esc_html__( 'Search Speakers', 'wpsm' ),
				'popular_items'              => esc_html__( 'Popular Speakers', 'wpsm' ),
				'all_items'                  => esc_html__( 'All Speakers', 'wpsm' ),
				'edit_item'                  => esc_html__( 'Edit Speakers', 'wpsm' ),
				'view_item'                  => esc_html__( 'View Speaker', 'wpsm' ),
				'update_item'                => esc_html__( 'Update Speaker', 'wpsm' ),
				'add_new_item'               => esc_html__( 'Add New Speaker', 'wpsm' ),
				'new_item_name'              => esc_html__( 'New Speaker Name', 'wpsm' ),
				'separate_items_with_commas' => esc_html__( 'Separate speakers with commas', 'wpsm' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove speakers', 'wpsm' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used speakers', 'wpsm' ),
				'not_found'                  => esc_html__( 'No speakers found.', 'wpsm' ),
				'no_terms'                   => esc_html__( 'No speakers', 'wpsm' ),
				'items_list_navigation'      => esc_html__( 'Speakers list navigation', 'wpsm' ),
				'items_list'                 => esc_html__( 'Speakers list', 'wpsm' ),
			],
			'public'            => true,
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'meta_box_cb'       => false,
			'rewrite'           => [
				'slug'         => 'sermons/speakers',
				'with_front'   => true,
				'hierarchical' => false,
			],
			'show_in_rest'      => true,
		] );
	}
}
