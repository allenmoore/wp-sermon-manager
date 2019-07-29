<?php
/**
 * Sermon Title.
 *
 * @package WPSermonManager\Filters\Fields
 */
namespace WPSermonManager\Filters\Fields;

/**
 * The SermonTitle Class.
 *
 * Handles filtering the Sermon post type title field placeholder text..
 *
 * @since 1.0.0
 */
class SermonTitle {

	/**
	 * The SermonTitle Constructor.
	 */
	public function __construct() {
		add_filter( 'enter_title_here', array( $this, 'title_placeholder' ), 20, 2 );
	}

	/**
	 * Method to filter the Sermon post type's title field placeholder text.
	 *
	 * @param string $title The placeholder text.
	 * @param WP_Post $post Post object.
	 *
	 * @return string The filtered placeholder text.
	 */
	public function title_placeholder( $title , $post ) {

	    if ( 'wpsm_sermon' === $post->post_type ) {
		    $title = 'Sermon Title';

		    return $title;
	    }

	    return $title;
    }
}
