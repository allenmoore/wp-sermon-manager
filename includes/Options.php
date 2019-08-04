<?php
/**
 * Options
 *
 * @package WPSM
 */
namespace WPSM;

use WPSM\Util\OptionsInterface;
use WPSM\Util\OptionsTrait;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The Options Class
 *
 * @since 1.0.0
 *
 * @property-read string $experience_rewrite_slug The Experience post type rewrite slug
 */
class Options implements OptionsInterface {

	use OptionsTrait;

	/** @var string */
	const SLUG = 'wpsm-options';

	/**
	 * The Options Constructor
	 */
	public function __construct() {
		$this->defaultOptionsData = [
			'experience' => [
				'rewrite_slug' => 'experience',
			]
		];
	}

	/**
	 * Method to get the options
	 *
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function __get( $name ) {
		switch ( $name ) {
			case 'experience_rewrite_slug':
				$name = 'experience.rewrite_slug';
				break;
			default:
				$name = (string) $name;
				break;
		}

		return $this->get( $name );
	}

	/**
	 * Method to get the option name used to look up the option
	 *
	 * @return string
	 */
	public function getOptionKey() {
		return static::SLUG;
	}

}
