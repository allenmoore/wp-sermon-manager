<?php

namespace WPSermonManage;

interface MetaInterface {

	/**
	 * Get the meta key for this meta
	 *
	 * @return string
	 */
	public function getMetaKey();

	/**
	 * Set up the post type
	 *
	 * @return $this
	 */
	public function setupMetaObject();

	/**
	 * Get the meta value for this meta object
	 *
	 * @param int $objectId
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function getMetaValue( $objectId, $default = null );

}
