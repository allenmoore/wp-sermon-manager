<?php
/**
 * Templates Tags
 *
 * @package WPSM
 */

/**
 * Function that returns the svg path option.
 *
 * @since 1.0.0
 *
 * @return string the svg path option.
 */
function get_svg_path_option() {
	$svg_path_option = get_option( 'svghelpers_path', 'assets/svg/dist/' );

	return $svg_path_option;
}

/**
 * Function that displays an inline SVG.
 *
 * @since 1.0.0
 *
 * @param  string $svg the svg to display inline.
 * @return void
 */
function inline_svg( $svg ) {
	do_action( 'inline_svg', $svg );
}

/**
 * Function that displays a button with an inline SVG.
 *
 * @since 1.0.0
 *
 * @param  string $svg   the svg to display inline.
 * @param  string $title the title of the button.
 * @param  string $loc   the svg display location, either right or left.
 * @param  string $class the css class of the button.
 * @param  string $a11y  the a11y attributes to apply to the button.
 * @return void
 */
function svg_button( $svg, $title, $loc = null, $class = '', $a11y = '' ) {
	do_action( 'svg_button', $svg, $title, $loc, $class, $a11y );
}
