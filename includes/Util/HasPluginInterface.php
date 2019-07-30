<?php

namespace WPSermonManager\Util;

use WPSermonManager\PluginInterface;

interface HasPluginInterface {

	/**
	 * Get the plugin
	 *
	 * @return PluginInterface
	 */
	public function getPlugin();

	/**
	 * Set the plugin
	 *
	 * @param PluginInterface $plugin
	 */
	public function setPlugin( PluginInterface $plugin );

}
