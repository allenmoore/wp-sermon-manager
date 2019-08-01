<?php
/**
 * Menu Interface
 *
 * @package WPSermonManager
 */
namespace WPSermonManager;

/**
 * Interface MenuInterface
 *
 * Handles method declaration when registering menu objects.
 *
 * @since 1.0.0
 */
interface MenuInterface {

	/**
	 * Get the menu slug
	 *
	 * @return string
	 */
	public function getMenuSlug();

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
	public function addSubmenu( $title, $menuLabel, $capability, $menuSlug, $callback, $priority = -1 );

	/**
	 * Remove a submenu from this menu
	 *
	 * @param string $menuSlug
	 *
	 * @return array|bool
	 */
	public function removeSubmenu( $menuSlug );

}
