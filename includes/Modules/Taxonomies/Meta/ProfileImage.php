<?php

namespace WPSermonManager\Modules\Taxonomies\Meta;

use WPSermonManager\MetaInterface;
use WPSermonManager\Util\Meta\AbstractRestField;
use WPSermonManager\Util\Meta\ProtectedMetaTrait;
use WPSermonManager\Util\Meta\RestFieldTrait;

class ProfileImage extends AbstractRestField implements MetaInterface {

	const KEY = 'glp-profile-image';

	use RestFieldTrait, ProtectedMetaTrait;

	/**
	 * Set up the post type
	 *
	 * @return $this
	 */
	public function setupMetaObject() {
		$this->addProtectedMetaFilter();
		$this->setupRestField();
		register_meta( 'term', $this->getMetaKey(), [ $this, 'sanitize' ] );
	}

	/**
	 * Get the key for the rest field
	 *
	 * @return string
	 */
	public function getRestFieldKey() {
		return 'profile_image';
	}

	public function getMetaKey() {
		return static::KEY;
	}

	/**
	 * @param int $id
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function getMetaValue( $id, $default = null ) {
		return (int) ( get_term_meta( $id, $this->getMetaKey(), true ) ?: $default );
	}

	public function registerRestField() {
		parent::registerRestField();
		register_rest_field(
			$this->getRestObjectTypes(),
			$this->getRestFieldKey() . '_src',
			[ 'get_callback' => [ $this, 'getSrcForRest' ] ]
		);
	}

	/**
	 * @param $object
	 *
	 * @return bool|array
	 */
	public function getSrcForRest( $object ) {
		$value = $this->getMetaValue( $object['id'], 0 );
		if ( ! wp_attachment_is_image( $value ) ) {
			return false;
		}
		$post          = get_post( $value );
		$meta          = wp_get_attachment_metadata( $post->ID );
		$sizes         = empty( $meta['sizes'] ) ? [ ] : $meta['sizes'];
		$sizes['full'] = [ ];
		array_walk( $sizes, $this->adjustSizeDataCallback( $post ) );

		return array_filter( $sizes );
	}

	protected function adjustSizeDataCallback( $post ) {
		return function ( &$size_data, $size ) use ( $post ) {
			if ( isset( $size_data['mime-type'] ) ) {
				$size_data['mime_type'] = $size_data['mime-type'];
				unset( $size_data['mime-type'] );
			}

			// Use the same method image_downsize() does
			$image_src = wp_get_attachment_image_src( $post->ID, $size );
			if ( ! $image_src ) {
				return;
			}

			$size_data += [
				'file'       => wp_basename( $image_src[0] ),
				'width'      => $image_src[1],
				'height'     => $image_src[2],
				'mime_type'  => $post->post_mime_type,
				'source_url' => $image_src[0],
			];
		};
	}

	/**
	 * @param $value
	 * @param \WP_Term $object
	 */
	public function setMetaFromRest( $value, $object ) {
		if ( current_user_can( 'edit_term', $object->term_id ) ) {
			update_term_meta( $object->term_id, $this->getMetaKey(), absint( $value ) );
		}
	}

	/**
	 * @return string[]
	 */
	public function getRestObjectTypes() {
		return [ 'glp-instructors' ];
	}

	/**
	 * Sanitize the meta value
	 *
	 * @param string $value
	 *
	 * @return string;
	 */
	public function sanitize( $value ) {
		return wp_get_attachment_image_src( $value ) ? $value : 0;
	}

}
