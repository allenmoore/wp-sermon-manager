<?php
/**
 * Roles
 *
 * @package WPSM\Admin\Users
 */
namespace WPSM\Admin\Users;

use WP_Role;

if ( ! defined( 'WPINC' ) )  die;

/**
 * The Roles Class.
 *
 * Handles adding custom user roles for WPSM users.
 *
 * @since 1.0.0
 */
class Roles {

	/**
	 * The UserRoles Constructor.
	 */
	public function __construct() {
		add_action('admin_init', array( $this, 'add_roles' ) );
	}

	/**
	 * Method to add custom user roles for WPSM users.
	 */
	public function add_roles() {

		$role_list = [ 'administrator', 'editor', 'author' ];

		foreach ( $role_list as $role_name ) {

			$role = get_role( $role_name );

			if ( null === $role || ! ( $role instanceof WP_Role ) ) {
				continue;
			}

			// Read sermons.
			$role->add_cap( 'read_wpsm_sermon' );

			// Edit sermons.
			$role->add_cap( 'edit_wpsm_sermon' );
			$role->add_cap( 'edit_wpsm_sermons' );
			$role->add_cap( 'edit_private_wpsm_sermons' );
			$role->add_cap( 'edit_published_wpsm_sermons' );

			// Delete sermons.
			$role->add_cap( 'delete_wpsm_sermon' );
			$role->add_cap( 'delete_wpsm_sermons' );
			$role->add_cap( 'delete_published_wpsm_sermons' );
			$role->add_cap( 'delete_private_wpsm_sermons' );

			// Publish sermons.
			$role->add_cap( 'publish_wpsm_sermons' );

			// Read private sermons.
			$role->add_cap( 'read_private_wpsm_sermons' );

			// Manage categories & tags.
			$role->add_cap( 'manage_wpsm_categories' );

			// Add additional roles for administrator.
			if ( 'administrator' === $role_name ) {
				// Access to Sermon Manager Settings.
				$role->add_cap( 'manage_wpsm_settings' );
			}

			// Add additional roles for administrator and editor.
			if ( 'author' !== $role_name ) {
				$role->add_cap( 'edit_others_wpsm_sermons' );
				$role->add_cap( 'delete_others_wpsm_sermons' );
			}
		}
	}
}
