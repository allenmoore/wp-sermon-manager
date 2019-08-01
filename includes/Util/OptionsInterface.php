<?php
/**
 * Options Interface
 *
 * @package WPSermonManager\Util
 */
namespace WPSermonManager\Util;

/**
 * Interface OptionsInterface
 *
 * Handles method declaration when registering an option object.
 *
 * @package WPSermonManager\Util
 */
interface OptionsInterface {

	/**
	 * Method to get an option item
	 *
	 * $key should permit separating keys with a period, so that, for example, 'foo.bar' would map to 5 here:
	 * [
	 *   'foo' => [
	 *     'bar' => 5
	 *   ]
	 * ]
	 *
	 * @param string $key
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function get( $key, $default = null );

	/**
	 * Method to set an option item
	 *
	 * $key should permit separating keys with a period, so that, for example, 'foo.bar' would map to 5 here:
	 * [
	 *   'foo' => [
	 *     'bar' => 5
	 *   ]
	 * ]
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function set( $key, $value );

	/**
	 * Method to delete an option item
	 *
	 * $key should permit separating keys with a period, so that, for example, 'foo.bar' would map to 5 here:
	 * [
	 *   'foo' => [
	 *     'bar' => 5
	 *   ]
	 * ]
	 *
	 * @param string $key
	 */
	public function delete( $key );

	/**
	 * Method to get the option name used to look up the option
	 *
	 * @return string
	 */
	public function getOptionKey();

}
