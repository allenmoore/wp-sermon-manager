<?php
namespace WPSermonManager\Modules\PostTypes;

use WPSermonManager\Modules\PostTypes\Meta\MetaInterface;

trait PostTypeTrait {

	public function getPostTypeSlug() {
		if ( ! defined( get_class( $this ) . '::SLUG' ) ) {
			return '';
		}

		return static::SLUG;
	}

	/**
	 * Get the labels for this post type
	 *
	 * @return object
	 */
	public function getLabels() {
		return get_post_type_object( $this->getPostTypeSlug() )->labels;
	}

	/**
	 * Get the capabilities for this post type
	 *
	 * @return object
	 */
	public function getCaps() {
		return get_post_type_object( $this->getPostTypeSlug() )->cap;
	}

	/**
	 * Register a post meta with this post type
	 *
	 * @param MetaInterface $meta
	 *
	 * @return $this
	 */
	public function registerPostMeta( MetaInterface $meta ) {
		$meta->registerPostType( $this );
		$this->meta[ $meta->getMetaKey() ] = $meta;

		return $this;
	}

}
