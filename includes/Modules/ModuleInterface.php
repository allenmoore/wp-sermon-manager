<?php

namespace WPSermonManager\Modules;

use WPSermonManager\PluginInterface;

interface ModuleInterface {

	/**
	 * Get this module's slug
	 *
	 * Slugs should be unique
	 *
	 * @return string
	 */
	public function getModuleSlug();

	/**
	 * Initialize the module. Whatever a module needs to do prior to init should be done here.
	 *
	 * This would include hooking into the glp_lcm_init action (runs on init, but is specific to this plugin.
	 *
	 * @param PluginInterface $plugin
	 */
	public function setupModule( PluginInterface $plugin );

}
