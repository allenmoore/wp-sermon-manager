<?php
namespace WPSermonManager\Modules\PostTypes\Meta;

use WPSermonManager\PluginInterface;

trait SimpleMetaTrait {

	protected $__metaBoxTitle = '';
	protected $__postTypeFeature = '';
	protected $__context = '';
	protected $__priority = '';

	/**
	 * Get the meta key for this meta
	 *
	 * @return string
	 */
	abstract public function getMetaKey();

	/**
	 * Set up the simple meta actions, etc.
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
	 * Add the meta box if this post type supports this feature
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
	 * Maybe save the post meta
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
	 * Render the meta box
	 *
	 * @param \WP_Post $post
	 */
	public function renderMetaBox( $post ) {
		$this->getPlugin()->template( 'admin/meta/' . $this->getMetaKey(), [ 'meta' => $this, 'post' => $post ] );
	}

	/**
	 * Sanitize the meta value
	 *
	 * Make sure the value is an approved value
	 *
	 * @param $value
	 *
	 * @return mixed
	 */
	abstract public function sanitize( $value );

	/**
	 * @return PluginInterface
	 */
	abstract public function getPlugin();

}
