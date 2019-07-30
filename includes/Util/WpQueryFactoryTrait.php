<?php
/**
 * WP_Query Factory Trait
 *
 * @package WPSermonManager\Util
 */
namespace WPSermonManager\Util;

use WP_Query;

/**
 * Trait WpQueryFactoryTrait
 *
 * Handles method inheritance and reuse for WP_Query objects.
 *
 * @since 1.0.0
 */
trait WpQueryFactoryTrait {

	/**
	 * Method to get a new WP Query
	 *
	 * @return WP_Query
	 */
	public function getWpQuery() {
		return new WP_Query();
	}

}
