<?php
/**
 * Sermons
 *
 * @package WPSM\Modules\PostTypes
 */
namespace WPSM\Modules\PostTypes;

use WPSM\Modules\ModuleInterface;
use WPSM\PluginInterface;
use WPSM\Util\HasPluginInterface;
use WPSM\Util\HasPluginTrait;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The Sermon Class.
 *
 * Handles registering the Sermon post type.
 *
 * @since 1.0.0
 */
class Sermon implements ModuleInterface, PostTypeInterface, HasPluginInterface {

	const SLUG = 'wpsm-sermon';

	use PostTypeTrait, HasPluginTrait;

	/**
	 * The Sermons Constructor.
	 */
	public function __construct() {
	}

	/**
	 * Register the post type
	 */
	public function registerPostType() {
		register_post_type( $this->getPostTypeSlug(), [
			'labels'                => [
				'name'                  => esc_html_x( 'Sermons', 'Post Type General Name', 'wpsm' ),
				'singular_name'         => esc_html_x( 'Sermon', 'Post Type Singular Name', 'wpsm' ),
				'menu_name'             => esc_html__( 'Sermons', 'wpsm' ),
				'name_admin_bar'        => esc_html__( 'Sermon', 'wpsm' ),
				'archives'              => esc_html__( 'Sermon Archives', 'wpsm' ),
				'attributes'            => esc_html__( 'Sermon Attributes', 'wpsm' ),
				'all_items'             => esc_html__( 'All Sermons', 'wpsm' ),
				'add_new_item'          => esc_html__( 'Add New Sermon', 'wpsm' ),
				'add_new'               => esc_html__( 'Add New', 'wpsm' ),
				'new_item'              => esc_html__( 'New Sermon', 'wpsm' ),
				'edit_item'             => esc_html__( 'Edit Sermon', 'wpsm' ),
				'update_item'           => esc_html__( 'Update Sermon', 'wpsm' ),
				'view_item'             => esc_html__( 'View Sermon', 'wpsm' ),
				'view_items'            => esc_html__( 'View Sermons', 'wpsm' ),
				'search_items'          => esc_html__( 'Search Sermon', 'wpsm' ),
				'not_found'             => esc_html__( 'Not found', 'wpsm' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wpsm' ),
				'featured_image'        => esc_html__( 'Featured Image', 'wpsm' ),
				'set_featured_image'    => esc_html__( 'Set featured image', 'wpsm' ),
				'remove_featured_image' => esc_html__( 'Remove featured image', 'wpsm' ),
				'use_featured_image'    => esc_html__( 'Use as featured image', 'wpsm' ),
				'insert_into_item'      => esc_html__( 'Insert into sermon', 'wpsm' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this sermon', 'wpsm' ),
				'items_list'            => esc_html__( 'Sermons list', 'wpsm' ),
				'items_list_navigation' => esc_html__( 'Sermons list navigation', 'wpsm' ),
				'filter_items_list'     => esc_html__( 'Filter Sermons list', 'wpsm' ),
			],
			'label'                 => esc_html__( 'Sermon', 'wpsm' ),
			'description'           => esc_html__( 'Sermon Post Type from WP Sermon Manager', 'wpsm' ),
			'supports'              => array( 'title', 'thumbnail', 'trackbacks', 'revisions' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'map_meta_cap'          => false,
			'menu_position'         => 25,
			'menu_icon'             => 'dashicons-book-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite'               => [
				'slug'       => 'sermon',
				'with_front' => false,
				'feeds'      => false,
				'pages'      => true,
			],
			'show_in_rest'          => true,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		] );
	}

	/**
	 * Get this module's slug
	 *
	 * Slugs should be unique
	 *
	 * @return string
	 */
	public function getModuleSlug() {
		return static::SLUG . '-post-type';
	}

	/**
	 * Initialize the module. Whatever a module needs to do prior to init should be done here.
	 *
	 * This would include hooking into the glp_lcm_init action (runs on init, but is specific to this plugin.
	 *
	 * @param PluginInterface $plugin
	 */
	public function setupModule( PluginInterface $plugin ) {
		$this->plugin = $plugin;
		add_action( 'wpsm_init', [ $this, 'registerPostType' ], 1 );
	}
}
