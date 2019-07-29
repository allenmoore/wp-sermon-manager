<?php
/**
 * Helpers
 *
 * @package WPSM/Helpers
 */
namespace WPSermonManager;

/**
 * The Helpers Class.
 *
 * Handles defining helper methods.
 *
 * @since 1.0.0
 */
class Helpers {

	/**
	 * The Helpers constructor.
	 */
	public function __construct() {
	}

	/**
	 * Method that retrieve the classes for the sermon page as an array.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array An Array of classes.
	 */
	public function get_page_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( !is_array( $class ) )
				$class = preg_split( '#\s+#', $class );
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		/**
		 * Filters the list of CSS sermon page classes.
		 *
		 * @param array $classes An array of sermon page classes.
		 * @param array $class   An array of additional classes added to the sermon page.
		 */
		$classes = apply_filters( 'wpsm_page_class', $classes, $class );

		return array_unique( $classes );
	}

	/**
	 * Method that displays the classes for the sermon page.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	public function page_class( $class = '' ) {
		echo 'class="' . join( ' ', $this->get_page_class( $class ) ) . '"';
	}
}
