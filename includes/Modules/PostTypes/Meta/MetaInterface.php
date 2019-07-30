<?php

namespace WPSermonManager\Modules\PostTypes\Meta;

use WPSermonManager\Modules\PostTypes\PostTypeInterface;
use WPSermonManager\MetaInterface as BaseMetaInterface;

interface MetaInterface extends BaseMetaInterface {

	/**
	 * Register this meta with a post type
	 *
	 * This can be called multiple times with different post types
	 *
	 * @param PostTypeInterface $postType
	 */
	public function registerPostType( PostTypeInterface $postType );

}
