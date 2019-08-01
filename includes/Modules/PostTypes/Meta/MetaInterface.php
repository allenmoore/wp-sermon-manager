<?php
/**
 * Meta Interface
 *
 * @package WPSermonManager\Modules\PostTypes\Meta
 */
namespace WPSermonManager\Modules\PostTypes\Meta;

use WPSermonManager\Modules\PostTypes\PostTypeInterface;
use WPSermonManager\MetaInterface as BaseMetaInterface;

/**
 * Interface MetaInterface
 *
 * Handles method declaration when registering meta objects.
 *
 * @since 1.0.0
 */
interface MetaInterface extends BaseMetaInterface {

	/**
	 * Method to register this meta with a post type
	 *
	 * This can be called multiple times with different post types
	 *
	 * @param PostTypeInterface $postType
	 */
	public function registerPostType( PostTypeInterface $postType );

}
