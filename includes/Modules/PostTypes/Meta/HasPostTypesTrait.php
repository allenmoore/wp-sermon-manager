<?php

namespace WPSermonManager\Modules\PostTypes\Meta;

use WPSermonManager\Modules\PostTypes\PostTypeInterface;

trait HasPostTypesTrait {

	/** @var PostTypeInterface[] */
	private $registeredPostTypes = [ ];

	/**
	 * Get the meta key for this meta
	 *
	 * @return string
	 */
	abstract public function getMetaKey();

	/**
	 * Register this meta with a post type
	 *
	 * This can be called multiple times with different post types
	 *
	 * @param PostTypeInterface $postType
	 *
	 * @return mixed
	 */
	public function registerPostType( PostTypeInterface $postType ) {
		$this->registeredPostTypes[ $postType->getPostTypeSlug() ] = $postType;
		add_post_type_support( $postType->getPostTypeSlug(), $this->getFeatureName() );
	}

	/**
	 * Get a registered post type
	 *
	 * @param string $slug
	 *
	 * @return PostTypeInterface|null
	 */
	public function getPostType( $slug ) {
		return empty( $this->registeredPostTypes[ $slug ] ) ? null : $this->registeredPostTypes[ $slug ];
	}

	/**
	 * Get all registered post types
	 *
	 * @return PostTypeInterface[]
	 */
	public function getRegisteredPostTypes() {
		return $this->registeredPostTypes;
	}

	/**
	 * Get the feature name
	 *
	 * @return string
	 */
	protected function getFeatureName() {
		return 'meta-feature-' . $this->getMetaKey();
	}

}
