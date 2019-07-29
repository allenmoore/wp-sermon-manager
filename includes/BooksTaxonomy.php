<?php

namespace WPSermonManager;

class BooksTaxonomy {

	/**
	 * The BooksTaxonomy Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	public function get_labels() {

		$labels = array(
			'name'                       => _x( 'Books', 'Taxonomy General Name', 'wp_sermon_manager' ),
			'singular_name'              => _x( 'Book', 'Taxonomy Singular Name', 'wp_sermon_manager' ),
			'menu_name'                  => __( 'Books', 'wp_sermon_manager' ),
			'all_items'                  => __( 'All Books', 'wp_sermon_manager' ),
			'parent_item'                => __( 'Parent Book', 'wp_sermon_manager' ),
			'parent_item_colon'          => __( 'Parent Book:', 'wp_sermon_manager' ),
			'new_item_name'              => __( 'New Book Name', 'wp_sermon_manager' ),
			'add_new_item'               => __( 'Add New Book', 'wp_sermon_manager' ),
			'edit_item'                  => __( 'Edit Book', 'wp_sermon_manager' ),
			'update_item'                => __( 'Update Book', 'wp_sermon_manager' ),
			'view_item'                  => __( 'View Book', 'wp_sermon_manager' ),
			'separate_items_with_commas' => __( 'Separate books with commas', 'wp_sermon_manager' ),
			'add_or_remove_items'        => __( 'Add or remove books', 'wp_sermon_manager' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp_sermon_manager' ),
			'popular_items'              => __( 'Popular Books', 'wp_sermon_manager' ),
			'search_items'               => __( 'Search Books', 'wp_sermon_manager' ),
			'not_found'                  => __( 'Not Found', 'wp_sermon_manager' ),
			'no_terms'                   => __( 'No books', 'wp_sermon_manager' ),
			'items_list'                 => __( 'Books list', 'wp_sermon_manager' ),
			'items_list_navigation'      => __( 'Books list navigation', 'wp_sermon_manager' ),
		);

		return $labels;
	}

	public function get_rewrites() {

		$rewrite = array(
			'slug'                       => 'sermons/bible-books',
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
			'rest_controller_class'      => 'WP_REST_Bible_Books_Controller',
		);

		return $args;
	}

	public function register_taxonomy() {

		$args = $this->get_args();

		register_taxonomy( 'wpsm_bible_book', array( 'wpsm_sermon' ), $args );
	}
}
