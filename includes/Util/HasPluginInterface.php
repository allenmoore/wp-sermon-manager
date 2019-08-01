<?php
/**
 * Plugin Interface validation.
 *
 * @package WPSermonManager\Util
 */
namespace WPSermonManager\Util;

use WPSermonManager\PluginInterface;

/**
 * Interface HasPluginInterface
 *
 * Handles validating that a module has the plugin interface.
 *
 * @since 1.0.0
 */
interface HasPluginInterface {

	/**
	 * Method to get the plugin
	 *
	 * @return PluginInterface
	 */
	public function getPlugin();

	/**
	 * Method to set the plugin
	 *
	 * @param PluginInterface $plugin
	 */
	public function setPlugin( PluginInterface $plugin );

}
