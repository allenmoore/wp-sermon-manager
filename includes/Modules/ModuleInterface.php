<?php
/**
 * Module Interface
 *
 * @package WPSM\Modules
 */
namespace WPSM\Modules;

use WPSM\PluginInterface;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Interface ModuleInterface
 *
 * Handles method declaration when registering a module.
 *
 * @package WPSM\Modules
 */
interface ModuleInterface {

	/**
	 * Method to get this module's slug
	 *
	 * Slugs should be unique
	 *
	 * @return string
	 */
	public function getModuleSlug();

	/**
	 * Method to initialize the module. Whatever a module needs to do prior to init should be done here.
	 *
	 * This would include hooking into the glp_lcm_init action (runs on init, but is specific to this plugin.
	 *
	 * @param PluginInterface $plugin
	 */
	public function setupModule( PluginInterface $plugin );

}
