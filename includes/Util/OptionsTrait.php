<?php
/**
 * Options Trait
 *
 * @package WPSM\Util
 */
namespace WPSM\Util;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Trait OptionsTrait
 *
 * Handles method inheritance and reuse for option objects.
 *
 * @since 1.0.0
 */
trait OptionsTrait {

	/** @var bool */
	private $optionsInitialized = false;

	/** @var array */
	private $optionsData;

	/** @var array */
	protected $defaultOptionsData = [ ];

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
	public function get( $key, $default = null ) {
		$this->initializeOptionsData();
		$keyParts = explode( '.', (string) $key );
		$set      = $this->optionsData;
		foreach ( $keyParts as $part ) {
			if ( ! is_array( $set ) || ! array_key_exists( $part, $set ) ) {
				return $default;
			}
			$set = $set[ $part ];
		}

		return $set;
	}

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
	public function set( $key, $value ) {
		$this->initializeOptionsData();
		$keyParts = explode( '.', $key );
		$tail     = array_pop( $keyParts );
		$bucket   = &$this->optionsData;
		while ( ! empty( $keyParts ) ) {
			$next = array_shift( $keyParts );
			if ( empty( $bucket[ $next ] ) ) {
				$bucket[ $next ] = [ ];
			} elseif ( ! is_array( $bucket[ $next ] ) ) {
				$bucket[ $next ] = (array) $bucket[ $next ];
			}
			$bucket = &$bucket[ $next ];
		}
		$bucket[ $tail ] = $value;
		update_option( $this->getOptionKey(), $this->optionsData );
	}

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
	public function delete( $key ) {
		$this->initializeOptionsData();
		if ( null === $key ) {
			$this->optionsData = [ ];
			delete_option( $this->getOptionKey() );

			return;
		}
		$keyParts = explode( '.', $key );
		$tail     = array_pop( $keyParts );
		$bucket   = &$this->optionsData;
		while ( ! empty( $keyParts ) ) {
			$next = array_shift( $keyParts );
			if ( ! is_array( $bucket ) || ! array_key_exists( $next, $bucket ) ) {
				return;
			}
			$bucket = &$bucket[ $next ];
		}
		if ( is_array( $bucket ) && array_key_exists( $tail, $bucket ) ) {
			unset( $bucket[ $tail ] );
			update_option( $this->getOptionKey(), $this->optionsData );
		}
	}

	/**
	 * Method to get the option name used to look up the option
	 *
	 * @return string
	 */
	abstract public function getOptionKey();

	/**
	 * Method to initialize the options object if necessary
	 */
	private function initializeOptionsData() {
		if ( ! $this->optionsInitialized ) {
			$this->optionsData        = get_option( $this->getOptionKey(), $this->defaultOptionsData );
			$this->optionsInitialized = true;
		}
	}

}
