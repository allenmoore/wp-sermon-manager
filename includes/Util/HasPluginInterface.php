<?php
/**
 * Plugin Interface validation.
 *
 * @package WPSM\Util
 */
namespace WPSM\Util;

use WPSM\PluginInterface;

if ( ! defined( 'ABSPATH' ) ) exit;

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
