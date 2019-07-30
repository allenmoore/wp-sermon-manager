<?php

namespace WPSermonManager\Util;

use WP_Query;

trait WpQueryFactoryTrait {

	/**
	 * Get a new WP Query
	 *
	 * @return WP_Query
	 */
	public function getWpQuery() {
		return new WP_Query();
	}

}
