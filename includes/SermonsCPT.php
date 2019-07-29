<?php

namespace WPSermonManager;

class SermonsCPT {

	/**
	 * The SermonsCPT Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ), 0 );
	}

	public function get_labels() {

		$labels = array(
			'name'                  => _x( 'Sermons', 'Post Type General Name', 'wp_sermon_manager' ),
			'singular_name'         => _x( 'Sermon', 'Post Type Singular Name', 'wp_sermon_manager' ),
			'menu_name'             => __( 'Sermons', 'wp_sermon_manager' ),
			'name_admin_bar'        => __( 'Sermon', 'wp_sermon_manager' ),
			'archives'              => __( 'Sermon Archives', 'wp_sermon_manager' ),
			'attributes'            => __( 'Sermon Attributes', 'wp_sermon_manager' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wp_sermon_manager' ),
			'all_items'             => __( 'All Sermons', 'wp_sermon_manager' ),
			'add_new_item'          => __( 'Add New Sermon', 'wp_sermon_manager' ),
			'add_new'               => __( 'Add New', 'wp_sermon_manager' ),
			'new_item'              => __( 'New Sermon', 'wp_sermon_manager' ),
			'edit_item'             => __( 'Edit Sermon', 'wp_sermon_manager' ),
			'update_item'           => __( 'Update Sermon', 'wp_sermon_manager' ),
			'view_item'             => __( 'View Sermon', 'wp_sermon_manager' ),
			'view_items'            => __( 'View Sermons', 'wp_sermon_manager' ),
			'search_items'          => __( 'Search Sermon', 'wp_sermon_manager' ),
			'not_found'             => __( 'Not found', 'wp_sermon_manager' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp_sermon_manager' ),
			'featured_image'        => __( 'Featured Image', 'wp_sermon_manager' ),
			'set_featured_image'    => __( 'Set featured image', 'wp_sermon_manager' ),
			'remove_featured_image' => __( 'Remove featured image', 'wp_sermon_manager' ),
			'use_featured_image'    => __( 'Use as featured image', 'wp_sermon_manager' ),
			'insert_into_item'      => __( 'Insert into sermon', 'wp_sermon_manager' ),
			'uploaded_to_this_item' => __( 'Uploaded to this sermon', 'wp_sermon_manager' ),
			'items_list'            => __( 'Sermons list', 'wp_sermon_manager' ),
			'items_list_navigation' => __( 'Sermons list navigation', 'wp_sermon_manager' ),
			'filter_items_list'     => __( 'Filter Sermons list', 'wp_sermon_manager' ),
		);

		return $labels;
	}

	public function get_rewrites() {

		$rewrite = array(
			'slug'                  => 'sermons',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);

		return $rewrite;
	}

	public function get_args() {

		$labels = $this->get_labels();
		$rewrite = $this->get_rewrites();
		$args = array(
			'label'                 => __( 'Sermon', 'wp_sermon_manager' ),
			'description'           => __( 'Sermon Post Type from WP Sermon Manager', 'wp_sermon_manager' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 25,
			'menu_icon'             => 'dashicons-businessperson',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
			'rest_controller_class' => 'WP_REST_Sermons_Controller',
		);

		return $args;
	}

	public function register_post_type() {

		$args = $this->get_args();

		register_post_type( 'wpsm_sermon', $args );
	}
}
