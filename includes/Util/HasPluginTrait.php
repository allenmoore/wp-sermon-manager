<?php
/**
 * Plugin Trait Validation
 *
 * @package WPSermonManager\Util
 */
namespace WPSermonManager\Util;

use WPSermonManager\PluginInterface;

/**
 * HasPluginTrait
 *
 * Handles validating that a module has the plugin trait.
 *
 * @since 1.0.0
 */
trait HasPluginTrait {

	/** @var PluginInterface */
	private $plugin;

	/**
	 * Method to get the plugin
	 *
	 * @return PluginInterface
	 */
	public function getPlugin() {
		return $this->plugin;
	}

	/**
	 * Method to set the plugin
	 *
	 * @param PluginInterface $plugin
	 */
	public function setPlugin( PluginInterface $plugin ) {
		$this->plugin = $plugin;
	}

}
