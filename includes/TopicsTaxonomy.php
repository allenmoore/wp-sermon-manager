<?php

namespace WPSermonManager;

class TopicsTaxonomy {

	/**
	 * The TopicsTaxonomy Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	public function get_labels() {

		$labels = array(
			'name'                       => _x( 'Topics', 'Taxonomy General Name', 'wp_sermon_manager' ),
			'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'wp_sermon_manager' ),
			'menu_name'                  => __( 'Topics', 'wp_sermon_manager' ),
			'all_items'                  => __( 'All Topics', 'wp_sermon_manager' ),
			'parent_item'                => __( 'Parent Topic', 'wp_sermon_manager' ),
			'parent_item_colon'          => __( 'Parent Topic:', 'wp_sermon_manager' ),
			'new_item_name'              => __( 'New Topic Name', 'wp_sermon_manager' ),
			'add_new_item'               => __( 'Add New Topic', 'wp_sermon_manager' ),
			'edit_item'                  => __( 'Edit Topic', 'wp_sermon_manager' ),
			'update_item'                => __( 'Update Topic', 'wp_sermon_manager' ),
			'view_item'                  => __( 'View Topic', 'wp_sermon_manager' ),
			'separate_items_with_commas' => __( 'Separate topics with commas', 'wp_sermon_manager' ),
			'add_or_remove_items'        => __( 'Add or remove topics', 'wp_sermon_manager' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp_sermon_manager' ),
			'popular_items'              => __( 'Popular Topics', 'wp_sermon_manager' ),
			'search_items'               => __( 'Search Topics', 'wp_sermon_manager' ),
			'not_found'                  => __( 'Not Found', 'wp_sermon_manager' ),
			'no_terms'                   => __( 'No topics', 'wp_sermon_manager' ),
			'items_list'                 => __( 'Topics list', 'wp_sermon_manager' ),
			'items_list_navigation'      => __( 'Topics list navigation', 'wp_sermon_manager' ),
		);

		return $labels;
	}

	public function get_rewrites() {

		$rewrite = array(
			'slug'                       => 'sermons/topics',
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
			'rest_controller_class'      => 'WP_REST_Topic_Controller',
		);

		return $args;
	}

	public function register_taxonomy() {

		$args = $this->get_args();

		register_taxonomy( 'wpsm_sermon_topics', array( 'wpsm_sermon' ), $args );
	}
}
