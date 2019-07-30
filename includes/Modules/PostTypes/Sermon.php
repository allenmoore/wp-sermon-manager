<?php
/**
 * Sermons
 *
 * @package WPSermonManager\Modules\PostTypes
 */
namespace WPSermonManager\Modules\PostTypes;

use WPSermonManager\Modules\ModuleInterface;
use WPSermonManager\PluginInterface;
use WPSermonManager\Util\HasPluginInterface;
use WPSermonManager\Util\HasPluginTrait;

if ( ! defined( 'WPINC' ) )  die;

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
				'name'                  => esc_html_x( 'Sermons', 'Post Type General Name', 'wp-sermon-manager' ),
				'singular_name'         => esc_html_x( 'Sermon', 'Post Type Singular Name', 'wp-sermon-manager' ),
				'menu_name'             => esc_html__( 'Sermons', 'wp-sermon-manager' ),
				'name_admin_bar'        => esc_html__( 'Sermon', 'wp-sermon-manager' ),
				'archives'              => esc_html__( 'Sermon Archives', 'wp-sermon-manager' ),
				'attributes'            => esc_html__( 'Sermon Attributes', 'wp-sermon-manager' ),
				'all_items'             => esc_html__( 'All Sermons', 'wp-sermon-manager' ),
				'add_new_item'          => esc_html__( 'Add New Sermon', 'wp-sermon-manager' ),
				'add_new'               => esc_html__( 'Add New', 'wp-sermon-manager' ),
				'new_item'              => esc_html__( 'New Sermon', 'wp-sermon-manager' ),
				'edit_item'             => esc_html__( 'Edit Sermon', 'wp-sermon-manager' ),
				'update_item'           => esc_html__( 'Update Sermon', 'wp-sermon-manager' ),
				'view_item'             => esc_html__( 'View Sermon', 'wp-sermon-manager' ),
				'view_items'            => esc_html__( 'View Sermons', 'wp-sermon-manager' ),
				'search_items'          => esc_html__( 'Search Sermon', 'wp-sermon-manager' ),
				'not_found'             => esc_html__( 'Not found', 'wp-sermon-manager' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wp-sermon-manager' ),
				'featured_image'        => esc_html__( 'Featured Image', 'wp-sermon-manager' ),
				'set_featured_image'    => esc_html__( 'Set featured image', 'wp-sermon-manager' ),
				'remove_featured_image' => esc_html__( 'Remove featured image', 'wp-sermon-manager' ),
				'use_featured_image'    => esc_html__( 'Use as featured image', 'wp-sermon-manager' ),
				'insert_into_item'      => esc_html__( 'Insert into sermon', 'wp-sermon-manager' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this sermon', 'wp-sermon-manager' ),
				'items_list'            => esc_html__( 'Sermons list', 'wp-sermon-manager' ),
				'items_list_navigation' => esc_html__( 'Sermons list navigation', 'wp-sermon-manager' ),
				'filter_items_list'     => esc_html__( 'Filter Sermons list', 'wp-sermon-manager' ),
			],
			'label'                 => esc_html__( 'Sermon', 'wp-sermon-manager' ),
			'description'           => esc_html__( 'Sermon Post Type from WP Sermon Manager', 'wp-sermon-manager' ),
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
		add_action( 'wp_sermon_manager_init', [ $this, 'registerPostType' ], 1 );
	}
}
