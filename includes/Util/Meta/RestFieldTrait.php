<?php

namespace WPSermonManager\Util\Meta;

trait RestFieldTrait {

	/**
	 * Get the key for the rest field
	 *
	 * @return string
	 */
	abstract public function getRestFieldKey();

	abstract public function getMetaKey();

	/**
	 * @param int $id
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	abstract public function getMetaValue( $id, $default = null );

	/**
	 * Set up the rest field action
	 */
	protected function setupRestField() {
		add_action( 'rest_api_init', [ $this, 'registerRestField' ] );
	}

	public function registerRestField() {
		foreach ( $this->getRestObjectTypes() as $restObjectType ) {
			register_rest_field( $restObjectType, $this->getRestFieldKey(), [
				'get_callback'    => [ $this, 'getMetaForRest' ],
				'update_callback' => [ $this, 'setMetaFromRest' ],
			] );
		}
	}

	public function getMetaForRest( $object ) {
		return $this->getMetaValue( $object['id'] );
	}

	abstract public function setMetaFromRest( $value, $object );

	/**
	 * @return string[]
	 */
	abstract public function getRestObjectTypes();

}
