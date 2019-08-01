<?php
/**
 * Field Trait
 *
 * @package WPSermonManage\Util\Meta
 */
namespace WPSermonManager\Util\Meta;

/**
 * Trait RestFieldTrait
 *
 * Handles method inheritance and reuse for rest fields.
 *
 * @since 1.0.0
 */
trait RestFieldTrait {

	/**
	 * Method to get the key for the rest field
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @return string
	 */
	abstract public function getRestFieldKey();

	/**
	 * Method to get the meta key for the rest field
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @return string
	 */
	abstract public function getMetaKey();

	/**
	 * Method to get the meta value for the rest field
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @param int $id
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	abstract public function getMetaValue( $id, $default = null );

	/**
	 * Method to set up the rest field action
	 */
	protected function setupRestField() {
		add_action( 'rest_api_init', [ $this, 'registerRestField' ] );
	}

	/**
	 * Method to register the rest field
	 */
	public function registerRestField() {
		foreach ( $this->getRestObjectTypes() as $restObjectType ) {
			register_rest_field( $restObjectType, $this->getRestFieldKey(), [
				'get_callback'    => [ $this, 'getMetaForRest' ],
				'update_callback' => [ $this, 'setMetaFromRest' ],
			] );
		}
	}

	/**
	 * Method to get the meta for the rest field
	 *
	 * @param $object
	 *
	 * @return mixed
	 */
	public function getMetaForRest( $object ) {
		return $this->getMetaValue( $object['id'] );
	}

	/**
	 * Method to get the meta value from the rest field
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 * @param $value
	 * @param $object
	 *
	 * @return mixed
	 */
	abstract public function setMetaFromRest( $value, $object );

	/**
	 * Method to get the rest object types
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @return string[]
	 */
	abstract public function getRestObjectTypes();

}
