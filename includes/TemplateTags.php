<?php
/**
 * Template Tags
 *
 * @package WPSermonManager
 */

namespace WPSermonManager;

/**
 * Template tag to render a template
 *
 * @param string $__template_file
 * @param array $__template_data
 */
function template( $__template_file, array $__template_data = [] ) {

	$__template_file = apply_filters( 'wpsm-template', WP_SERMON_MANAGER_INC . "templates/$__template_file.php", $__template_file, $__template_data );

	if ( $__template_file && file_exists( $__template_file ) ) {
		extract( $__template_data, EXTR_SKIP );
		require $__template_file;
	}
}
