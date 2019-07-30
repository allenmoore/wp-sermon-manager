<?php
/**
 * Speakers
 *
 * @package WPSermonManager\Modules\Taxonomies
 */
namespace WPSermonManager\Modules\Taxonomies;

if ( ! defined( 'WPINC' ) )  die;

/**
 * The Speakers Class.
 *
 * Hanles registering the Speakers taxonomy.
 *
 * @since 1.0.0
 */
class Speakers {

	/**
	 * The Speakers Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	/**
	 * Method to get the Speaker taxonomy labels.
	 *
	 * @return array An array of taxonomy labels.
	 */
	public function get_labels() {

		$labels = array(
			'name'                       => _x( 'Speakers', 'Taxonomy General Name', 'wp-sermon-manager' ),
			'singular_name'              => _x( 'Speaker', 'Taxonomy Singular Name', 'wp-sermon-manager' ),
			'menu_name'                  => __( 'Speakers', 'wp-sermon-manager' ),
			'all_items'                  => __( 'All Speakers', 'wp-sermon-manager' ),
			'parent_item'                => __( 'Parent Speaker', 'wp-sermon-manafger' ),
			'parent_item_colon'          => __( 'Parent Speaker:', 'wp-sermon-manafger' ),
			'new_item_name'              => __( 'New SpeakerName', 'wp-sermon-manafger' ),
			'add_new_item'               => __( 'Add New Speaker', 'wp-sermon-manafger' ),
			'edit_item'                  => __( 'Edit Speaker', 'wp-sermon-manafger' ),
			'update_item'                => __( 'Update Speaker', 'wp-sermon-manafger' ),
			'view_item'                  => __( 'View Speaker', 'wp-sermon-manafger' ),
			'separate_items_with_commas' => __( 'Separate speakers with commas', 'wp-sermon-manafger' ),
			'add_or_remove_items'        => __( 'Add or remove speakers', 'wp-sermon-manafger' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp-sermon-manafger' ),
			'popular_items'              => __( 'Popular Speakers', 'wp-sermon-manafger' ),
			'search_items'               => __( 'Search Speakers', 'wp-sermon-manafger' ),
			'not_found'                  => __( 'Not Found', 'wp-sermon-manafger' ),
			'no_terms'                   => __( 'No speakers', 'wp-sermon-manafger' ),
			'items_list'                 => __( 'Speakers list', 'wp-sermon-manafger' ),
			'items_list_navigation'      => __( 'Speakers list navigation', 'wp-sermon-manafger' ),
		);

		return $labels;
	}

	/**
	 * Method to get the Speakers taxonomy rewrites.
	 *
	 * @return array An array of taxonomy rewrites.
	 */
	public function get_rewrites() {

		$rewrite = array(
			'slug'                       => 'sermons/speakers',
			'with_front'                 => true,
			'hierarchical'               => false,
		);

		return $rewrite;
	}

	/**
	 * Method to get the Speakers taxonomy arguments.
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
			'rest_controller_class'      => 'WP_REST_Speakers_Controller',
		);

		return $args;
	}

	/**
	 * Method to register the Speaker taxonomy.
	 */
	public function register_taxonomy() {

		$args = $this->get_args();

		register_taxonomy( 'wpsm_speaker', array( 'wpsm_sermon' ), $args );
	}
}
