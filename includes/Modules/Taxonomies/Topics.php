<?php
/**
 * Topics
 *
 * @package WPSermonManager\Modules\Taxonomies
 */
namespace WPSermonManager\Modules\Taxonomies;

if ( ! defined( 'WPINC' ) )  die;

/**
 * The Topics Class.
 *
 * Hanles registering the Topics taxonomy.
 *
 * @since 1.0.0
 */
class Topics {

	/**
	 * The Topics Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	/**
	 * Method to get the Topics taxonomy labels.
	 *
	 * @return array An array of taxonomy labels.
	 */
	public function get_labels() {

		$labels = array(
			'name'                       => _x( 'Topics', 'Taxonomy General Name', 'wp-sermon-manager' ),
			'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'wp-sermon-manager' ),
			'menu_name'                  => __( 'Topics', 'wp-sermon-manager' ),
			'all_items'                  => __( 'All Topics', 'wp-sermon-manager' ),
			'parent_item'                => __( 'Parent Topic', 'wp-sermon-manager' ),
			'parent_item_colon'          => __( 'Parent Topic:', 'wp-sermon-manager' ),
			'new_item_name'              => __( 'New Topic Name', 'wp-sermon-manager' ),
			'add_new_item'               => __( 'Add New Topic', 'wp-sermon-manager' ),
			'edit_item'                  => __( 'Edit Topic', 'wp-sermon-manager' ),
			'update_item'                => __( 'Update Topic', 'wp-sermon-manager' ),
			'view_item'                  => __( 'View Topic', 'wp-sermon-manager' ),
			'separate_items_with_commas' => __( 'Separate topics with commas', 'wp-sermon-manager' ),
			'add_or_remove_items'        => __( 'Add or remove topics', 'wp-sermon-manager' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp-sermon-manager' ),
			'popular_items'              => __( 'Popular Topics', 'wp-sermon-manager' ),
			'search_items'               => __( 'Search Topics', 'wp-sermon-manager' ),
			'not_found'                  => __( 'Not Found', 'wp-sermon-manager' ),
			'no_terms'                   => __( 'No topics', 'wp-sermon-manager' ),
			'items_list'                 => __( 'Topics list', 'wp-sermon-manager' ),
			'items_list_navigation'      => __( 'Topics list navigation', 'wp-sermon-manager' ),
		);

		return $labels;
	}

	/**
	 * Method to get the Topics taxonomy rewrites.
	 *
	 * @return array An array of taxonomy rewrites.
	 */
	public function get_rewrites() {

		$rewrite = array(
			'slug'                       => 'sermons/topics',
			'with_front'                 => true,
			'hierarchical'               => false,
		);

		return $rewrite;
	}

	/**
	 * Method to get the Topics taxonomy arguments.
	 *
	 * @return array An array of taxonomy arguments.
	 */
	public function get_args() {

		$labels = $this->get_labels();
		$rewrite = $this->get_rewrites();
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
			'show_in_rest'               => true,
			'rest_controller_class'      => 'WP_REST_Topic_Controller',
		);

		return $args;
	}

	/**
	 * Method to register the Topics taxonomy.
	 */
	public function register_taxonomy() {

		$args = $this->get_args();

		register_taxonomy( 'wpsm_sermon_topics', array( 'wpsm_sermon' ), $args );
	}
}
