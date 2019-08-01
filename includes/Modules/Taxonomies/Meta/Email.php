<?php

namespace WPSermonManager\Modules\Taxonomies\Meta;

use WPSermonManager\MetaInterface;
use WPSermonManager\Util\HasPluginTrait;
use WPSermonManager\Util\Meta\ProtectedMetaTrait;
use WPSermonManager\Util\Meta\RestFieldTrait;

class Email implements MetaInterface {

	use RestFieldTrait, HasPluginTrait, ProtectedMetaTrait;

	const KEY = 'glp-email';

	/**
	 * Get the meta key for this meta
	 *
	 * @return string
	 */
	public function getMetaKey() {
		return static::KEY;
	}

	/**
	 * Set up the post type
	 *
	 * @return $this
	 */
	public function setupMetaObject() {
		$this->setMetaType( 'term' );
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
		return 'email';
	}

	/**
	 * @param int $id
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function getMetaValue( $id, $default = null ) {
		return (string) ( get_term_meta( $id, $this->getMetaKey(), true ) ?: $default );
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
	public function sanitize( $value ) {
		return sanitize_text_field( is_email( $value ) ? $value : '' );
	}

	/**
	 * @param $value
	 * @param \WP_Term $object
	 */
	public function setMetaFromRest( $value, $object ) {
		if ( current_user_can( 'edit_term', $object->term_id ) ) {
			update_term_meta( $object->term_id, $this->getMetaKey(), sanitize_text_field( $value ) );
		}
	}

	/**
	 * @return string[]
	 */
	public function getRestObjectTypes() {
		return [ 'glp-instructors' ];
	}

}
