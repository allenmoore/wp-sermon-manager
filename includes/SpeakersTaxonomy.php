<?php

namespace WPSermonManager;

class SpeakersTaxonomy {

	/**
	 * The SpeakersTaxonomy Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	public function get_labels() {

		$labels = array(
			'name'                       => _x( 'Speakers', 'Taxonomy General Name', 'wp_sermon_manager' ),
			'singular_name'              => _x( 'Speaker', 'Taxonomy Singular Name', 'wp_sermon_manager' ),
			'menu_name'                  => __( 'Speakers', 'wp_sermon_manager' ),
			'all_items'                  => __( 'All Speakers', 'wp_sermon_manager' ),
			'parent_item'                => __( 'Parent Speaker', 'wp_sermon_manager' ),
			'parent_item_colon'          => __( 'Parent Speaker:', 'wp_sermon_manager' ),
			'new_item_name'              => __( 'New SpeakerName', 'wp_sermon_manager' ),
			'add_new_item'               => __( 'Add New Speaker', 'wp_sermon_manager' ),
			'edit_item'                  => __( 'Edit Speaker', 'wp_sermon_manager' ),
			'update_item'                => __( 'Update Speaker', 'wp_sermon_manager' ),
			'view_item'                  => __( 'View Speaker', 'wp_sermon_manager' ),
			'separate_items_with_commas' => __( 'Separate speakers with commas', 'wp_sermon_manager' ),
			'add_or_remove_items'        => __( 'Add or remove speakers', 'wp_sermon_manager' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp_sermon_manager' ),
			'popular_items'              => __( 'Popular Speakers', 'wp_sermon_manager' ),
			'search_items'               => __( 'Search Speakers', 'wp_sermon_manager' ),
			'not_found'                  => __( 'Not Found', 'wp_sermon_manager' ),
			'no_terms'                   => __( 'No speakers', 'wp_sermon_manager' ),
			'items_list'                 => __( 'Speakers list', 'wp_sermon_manager' ),
			'items_list_navigation'      => __( 'Speakers list navigation', 'wp_sermon_manager' ),
		);

		return $labels;
	}

	public function get_rewrites() {

		$rewrite = array(
			'slug'                       => 'sermons/speakers',
			'with_front'                 => true,
			'hierarchical'               => false,
		);

		return $rewrite;
	}

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

	public function register_taxonomy() {

		$args = $this->get_args();

		register_taxonomy( 'wpsm_speaker', array( 'wpsm_sermon' ), $args );
	}
}
