<?php

namespace WPSermonManager\Util;

interface OptionsInterface {

	/**
	 * Get an option item
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
	 * Set an option item
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
	 * Delete an option item
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
	 * Get the option name used to look up the option
	 *
	 * @return string
	 */
	public function getOptionKey();

}
