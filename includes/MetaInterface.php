<?php
/**
 * Meta Interface
 *
 * @package WPSermonManager
 */
namespace WPSermonManage;

/**
 * Interface MetaInterface
 *
 * Handles method declaration when registering meta objects.
 *
 * @since 1.0.0
 */
interface MetaInterface {

	/**
	 * Method to get the meta key for this meta
	 *
	 * @return string
	 */
	public function getMetaKey();

	/**
	 * Method to setup the post type
	 *
	 * @return $this
	 */
	public function setupMetaObject();

	/**
	 * Method to get the meta value for this meta object
	 *
	 * @param int $objectId
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function getMetaValue( $objectId, $default = null );

}
