<?php
/**
 * Simple Meta Trait
 *
 * @package WPSM\Modules\PostTypes\Meta
 */
namespace WPSM\Modules\PostTypes\Meta;

use WPSM\PluginInterface;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Trait SimpleMetaTrait
 *
 * Handles method inheritance and reuse for meta objects.
 *
 * @since 1.0.0
 */
trait SimpleMetaTrait {

	protected $__metaBoxTitle = '';
	protected $__postTypeFeature = '';
	protected $__context = '';
	protected $__priority = '';

	/**
	 * Method to get the meta key for this meta
	 *
	 * @return string
	 */
	abstract public function getMetaKey();

	/**
	 * Method to set up the simple meta actions, etc.
	 *
	 * @param string $title The title of the meta box
	 * @param string $postTypeFeature The feature a post type must support to get a meta box
	 * @param string $context The context argument for adding the meta box
	 * @param string $priority The priority for the meta box
	 */
	public function setupSimpleMeta( $title, $postTypeFeature, $context = 'advanced', $priority = 'default' ) {
		$this->__metaBoxTitle    = $title;
		$this->__postTypeFeature = $postTypeFeature;
		$this->__context         = $context;
		$this->__priority        = $priority;
		register_meta( 'post', $this->getMetaKey(), [ $this, 'sanitize' ] );
		add_action( 'add_meta_boxes', [ $this, 'addMetaBox' ], 10, 2 );
		add_action( 'save_post', [ $this, 'savePost' ], 10, 2 );
	}

	/**
	 * Method to add the meta box if this post type supports this feature
	 *
	 * @param string $postType
	 * @param \WP_Post $post
	 */
	public function addMetaBox( $postType, $post ) {
		if ( ! post_type_supports( $postType, $this->__postTypeFeature ) ) {
			return;
		}
		add_meta_box(
			$this->getMetaKey(),
			$this->__metaBoxTitle,
			[ $this, 'renderMetaBox' ],
			$postType,
			$this->__context,
			$this->__priority
		);
	}

	/**
	 * Method to maybe save the post meta
	 *
	 * @param int $postId
	 * @param \WP_Post $post
	 */
	public function savePost( $postId, $post ) {
		if (
			! post_type_supports( $post->post_type, $this->__postTypeFeature ) ||
			empty( $_POST[ $this->getMetaKey() . '_nonce' ] ) ||
			! wp_verify_nonce( $_POST[ $this->getMetaKey() . '_nonce' ], $this->getMetaKey() . $postId )
		) {
			return;
		}
		$newValue = empty( $_POST[ $this->getMetaKey() ] ) ? '' : sanitize_text_field( $_POST[ $this->getMetaKey() ] );
		update_post_meta( $postId, $this->getMetaKey(), $newValue );
	}

	/**
	 * Method to render the meta box
	 *
	 * @param \WP_Post $post
	 */
	public function renderMetaBox( $post ) {
		$this->getPlugin()->template( 'admin/meta/' . $this->getMetaKey(), [ 'meta' => $this, 'post' => $post ] );
	}

	/**
	 * Method to sanitize the meta value
	 *
	 * Make sure the value is an approved value
	 *
	 * @param $value
	 *
	 * @return mixed
	 */
	abstract public function sanitize( $value );

	/**
	 * Method to get the plugin
	 *
	 * @return PluginInterface
	 */
	abstract public function getPlugin();

}
