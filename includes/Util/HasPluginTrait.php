<?php

namespace WPSermonManager\Util;

use WPSermonManager\PluginInterface;

trait HasPluginTrait {

	/** @var PluginInterface */
	private $plugin;

	/**
	 * Get the plugin
	 *
	 * @return PluginInterface
	 */
	public function getPlugin() {
		return $this->plugin;
	}

	/**
	 * Set the plugin
	 *
	 * @param PluginInterface $plugin
	 */
	public function setPlugin( PluginInterface $plugin ) {
		$this->plugin = $plugin;
	}

}
