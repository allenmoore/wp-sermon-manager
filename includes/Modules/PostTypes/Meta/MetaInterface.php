<?php
/**
 * Meta Interface
 *
 * @package WPSM\Modules\PostTypes\Meta
 */
namespace WPSM\Modules\PostTypes\Meta;

use WPSM\Modules\PostTypes\PostTypeInterface;
use WPSM\MetaInterface as BaseMetaInterface;

if ( ! defined( 'ABSPATH' ) ) exit;

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
