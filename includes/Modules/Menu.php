<?php

namespace WPSermonManager\Modules;

use WPSermonManager\MenuInterface;
use WPSermonManager\PluginInterface;
use WPSermonManager\Util\HasPluginInterface;
use WPSermonManager\Util\HasPluginTrait;

class Menu implements ModuleInterface, MenuInterface, HasPluginInterface {

	const SLUG = 'wp-sermon-manager';

	use HasPluginTrait;

	/**
	 * Get this module's slug
	 *
	 * Slugs should be unique
	 *
	 * @return string
	 */
	public function getModuleSlug() {
		return static::SLUG . '-menu';
	}

	/**
	 * Initialize the module. Whatever a module needs to do prior to init should be done here.
	 *
	 * This would include hooking into the glp_lcm_init action (runs on init, but is specific to this plugin.
	 *
	 * @param PluginInterface $plugin
	 */
	public function setupModule( PluginInterface $plugin ) {
		add_action( 'admin_menu', [ $this, 'adminMenu' ] );
	}

	/**
	 * Get the menu slug
	 *
	 * @return string
	 */
	public function getMenuSlug() {
		return static::SLUG;
	}

	/**
	 * Add a submenu to this menu
	 *
	 * @param string $title
	 * @param string $menuLabel
	 * @param string $capability
	 * @param string $menuSlug
	 * @param callable $callback
	 *
	 * @return string The menu hook
	 */
	public function addSubmenu( $title, $menuLabel, $capability, $menuSlug, $callback, $priority = -1 ) {

		$parentSlug = $this->getMenuSlug();
		$hook       = add_submenu_page( $parentSlug, $title, $menuLabel, $capability, $menuSlug, $callback );
		$this->prioritizeMenu( $priority );

		return $hook;
	}

	/**
	 * Remove a submenu from this menu
	 *
	 * @param string $menuSlug
	 *
	 * @return array|bool
	 */
	public function removeSubmenu( $menuSlug ) {
		remove_submenu_page( $this->getMenuSlug(), $menuSlug );
	}

	/**
	 * Admin init action
	 */
	public function adminMenu() {

		add_menu_page(
			esc_html__( 'Sermon Test', 'wp-sermon-manager' ),
			esc_html__( 'Sermon Test', 'wp-sermon-manager' ),
			$this->getEditCapability(),
			$this->getMenuSlug(),
			'',
			'dashicons-book-alt',
			21.48376 // Life hack: this makes it very unlikely we'll have a position collision with another plugin
		);
	}

	private function getEditCapability() {

		if ( ! $this->getPlugin()->getPostType( 'wpsm-sermon' ) ) {
			return 'edit_posts';
		}

		return $this->getPlugin()->getPostType( 'wpsm-sermon' )->getCaps()->edit_posts;
	}

	private function prioritizeMenu( $priority ) {

		global $submenu;

		$parentSlug = $this->getMenuSlug();

		if ( $priority > -1 && count( $submenu[ $parentSlug ] ) > $priority ) {

			$current = array_pop( $submenu[ $parentSlug ] );

			if ( 0 === $priority ) {
				array_unshift( $submenu[ $parentSlug ], $current );
			} else {
				$submenu[ $parentSlug ] = array_values( array_merge(
					array_slice( $submenu[ $parentSlug ], 0, $priority ),
					[ $current ],
					array_slice( $submenu[ $parentSlug ], $priority )
				) );
			}
		}
	}
}
