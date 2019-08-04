<?php
/**
 * Post Type Interface
 *
 * @package WPSM\Modules\PostTypes
 */
namespace WPSM\Modules\PostTypes;

use WPSM\Modules\PostTypes\Meta\MetaInterface;

if ( ! defined( 'ABSPATH' ) ) exit;

interface PostTypeInterface {

	/**
	 * Get the post type slug
	 *
	 * @return string
	 */
	public function getPostTypeSlug();

	/**
	 * Register the post type
	 */
	public function registerPostType();

	/**
	 * Get the labels for this post type
	 *
	 * @return object
	 */
	public function getLabels();

	/**
	 * Get the capabilities for this post type
	 *
	 * @return object
	 */
	public function getCaps();

	/**
	 * Register a post meta with this post type
	 *
	 * @param MetaInterface $meta
	 *
	 * @return $this
	 */
	public function registerPostMeta( MetaInterface $meta );

}
