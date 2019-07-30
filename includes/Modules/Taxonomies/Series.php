<?php
/**
 * Series
 *
 * @package WPSermonManager\Modules\Taxonomies
 */
namespace WPSermonManager\Modules\Taxonomies;

if ( ! defined( 'WPINC' ) )  die;

/**
 * The Series Class.
 *
 * Hanles registering the Series taxonomy.
 *
 * @since 1.0.0
 */
class Series {

	/**
	 * The Series Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	/**
	 * Method to get the Series taxonomy labels.
	 *
	 * @return array An array of taxonomy labels.
	 */
	public function get_labels() {

		$labels = array(
			'name'                       => _x( 'Series', 'Taxonomy General Name', 'wp-sermon-manager' ),
			'singular_name'              => _x( 'Series', 'Taxonomy Singular Name', 'wp-sermon-manager' ),
			'menu_name'                  => __( 'Series', 'wp-sermon-manager' ),
			'all_items'                  => __( 'All Series', 'wp-sermon-manager' ),
			'parent_item'                => __( 'Parent Series', 'wp-sermon-manager' ),
			'parent_item_colon'          => __( 'Parent Series:', 'wp-sermon-manager' ),
			'new_item_name'              => __( 'New SeriesName', 'wp-sermon-manager' ),
			'add_new_item'               => __( 'Add New Series', 'wp-sermon-manager' ),
			'edit_item'                  => __( 'Edit Series', 'wp-sermon-manager' ),
			'update_item'                => __( 'Update Series', 'wp-sermon-manager' ),
			'view_item'                  => __( 'View Series', 'wp-sermon-manager' ),
			'separate_items_with_commas' => __( 'Separate series with commas', 'wp-sermon-manager' ),
			'add_or_remove_items'        => __( 'Add or remove series', 'wp-sermon-manager' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp-sermon-manager' ),
			'popular_items'              => __( 'Popular Series', 'wp-sermon-manager' ),
			'search_items'               => __( 'Search Series', 'wp-sermon-manager' ),
			'not_found'                  => __( 'Not Found', 'wp-sermon-manager' ),
			'no_terms'                   => __( 'No series', 'wp-sermon-manager' ),
			'items_list'                 => __( 'Series list', 'wp-sermon-manager' ),
			'items_list_navigation'      => __( 'Series list navigation', 'wp-sermon-manager' ),
		);

		return $labels;
	}

	/**
	 * Method to get the Series taxonomy rewrites.
	 *
	 * @return array An array of taxonomy rewrites.
	 */
	public function get_rewrites() {

		$rewrite = array(
			'slug'                       => 'sermons/series',
			'with_front'                 => true,
			'hierarchical'               => false,
		);

		return $rewrite;
	}

	/**
	 * Method to get the Series taxonomy arguments.
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
			'rest_controller_class'      => 'WP_REST_Series_Controller',
		);

		return $args;
	}

	/**
	 * Method to register the Series taxonomy.
	 */
	public function register_taxonomy() {

		$args = $this->get_args();

		register_taxonomy( 'wpsm_sermon_series', array( 'wpsm_sermon' ), $args );
	}
}
