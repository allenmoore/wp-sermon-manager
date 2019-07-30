<?php

namespace WPSermonManager;

use WPSermonManager\Util\OptionsInterface;
use WPSermonManager\Util\OptionsTrait;

/**
 * Class Options
 * @package WPSermonManager
 *
 * @property-read string $experience_rewrite_slug The Experience post type rewrite slug
 */
class Options implements OptionsInterface {

	use OptionsTrait;

	const SLUG = 'glp-lcm-options';

	public function __construct() {
		$this->defaultOptionsData = [
			'experience' => [
				'rewrite_slug' => 'experience',
			]
		];
	}

	/**
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
	 * Get the option name used to look up the option
	 *
	 * @return string
	 */
	public function getOptionKey() {
		return static::SLUG;
	}

}
