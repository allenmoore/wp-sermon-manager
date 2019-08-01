<?php
/**
 * Post Type Trait Validation
 *
 * @package WPSermonManager\Modules\PostType\Meta
 */
namespace WPSermonManager\Modules\PostTypes\Meta;

use WPSermonManager\Modules\PostTypes\PostTypeInterface;

/**
 * HasPostTypesTrait
 *
 * Handles validating that a module has the post type trait.
 *
 * @since 1.0.0
 */
trait HasPostTypesTrait {

	/** @var PostTypeInterface[] */
	private $registeredPostTypes = [ ];

	/**
	 * Method to get the meta key for this meta
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @return string
	 */
	abstract public function getMetaKey();

	/**
	 * Method to register this meta with a post type
	 *
	 * This can be called multiple times with different post types.
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
	 * Nethod to get a registered post type
	 *
	 * @param string $slug
	 *
	 * @return PostTypeInterface|null
	 */
	public function getPostType( $slug ) {
		return empty( $this->registeredPostTypes[ $slug ] ) ? null : $this->registeredPostTypes[ $slug ];
	}

	/**
	 * Method to get all registered post types
	 *
	 * @return PostTypeInterface[]
	 */
	public function getRegisteredPostTypes() {
		return $this->registeredPostTypes;
	}

	/**
	 * Method to get the feature name
	 *
	 * @return string
	 */
	protected function getFeatureName() {
		return 'meta-feature-' . $this->getMetaKey();
	}
}
