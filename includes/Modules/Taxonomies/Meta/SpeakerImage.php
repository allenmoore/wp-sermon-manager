<?php
/**
 * Speaker Image
 *
 * @package WPSM\Modules\Taxonomies\Meta
 */
namespace WPSM\Modules\Taxonomies\Meta;

use function WPSM\template;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The SpeakerImage Class.
 *
 * @since 1.0.0
 */
class SpeakerImage {

	/** @var string */
	const TAX_NAME = 'wpsm-sermon-speaker';

	const TERM_NAME = 'wpsm-speaker-image-id';

	/**
	 * The SpeakerImage Constructor
	 */
	public function __construct() {
		add_action( static::TAX_NAME . '_add_form_fields', array ( $this, 'uploadImage' ), 10 );
		add_action( 'created_' . static::TAX_NAME, array ( $this, 'saveImage' ), 10, 2 );
		add_action( static::TAX_NAME . '_edit_form_fields', array ( $this, 'updateImage' ), 10, 2 );
		add_action( 'edited_' . static::TAX_NAME, array ( $this, 'updatedImage' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enququeAdminScripts' ) );
	}

	/**
	 * Method to enqueue JavaScript for the Admin Dashoard
	 */
	public function enququeAdminScripts() {
		global $current_screen;

		if ( 'wpsm-sermon' !== $current_screen->post_type ) return;

		$min = defined( 'SCRIPT_DEBUG' ) && filter_var( SCRIPT_DEBUG, FILTER_VALIDATE_BOOLEAN ) ? '' : '.min';
		$pluginUrl = trailingslashit( WPSM_PLUGIN_URL );

		$data = array(
			'key' => static::TERM_NAME,
		);

		wp_enqueue_media();

		wp_enqueue_script(
			'wpsm-admin-uploader',
			esc_url( $pluginUrl . 'dist/js/build.admin' . $min . '.js' ),
			[],
			WPSM_VERSION,
			true
		);

		wp_localize_script(
			'wpsm-admin-uploader',
			'wpsmImgUploader',
			$data
		);
	}

	/**
	 * Method to handle image uploads
	 *
	 * @param string $tax The taxonomy slug
	 */
	public function uploadImage( $tax ) {

		template( 'admin/taxonomy-meta/image-upload', array(
			'name' => static::TERM_NAME
		) );
	}

	/**
	 * Method to handle saving images
	 *
	 * @param int $termId The ID of the term
	 * @param int $ttId The taxonomy term ID
	 */
	public function saveImage( $termId, $ttId ) {

		if ( isset( $_POST[static::TERM_NAME] ) && '' !== $_POST[static::TERM_NAME] ) {
			$upload = $_POST[static::TERM_NAME];
			add_term_meta( $termId, static::TERM_NAME, $upload, true );
		}
	}

	/**
	 * Method to handle updating images
	 *
	 * @param WP_Term $term The current taxonomy term object.
	 * @param string $taxonomy The current taxonomy slug.
	 */
	public function updateImage( $term, $taxonomy ) {

		$imageId = get_term_meta( $term->term_id, static::TERM_NAME, true );

		template( 'admin/taxonomy-meta/image-update', array(
			'name'    => static::TERM_NAME,
			'imageId' => $imageId,
		) );
	}

	/**
	 * Method to handle an updated image
	 *
	 * @param int $termId The term ID.
	 * @param int $ttId The term taxonomy ID.
	 */
	public function updatedImage( $termId, $ttId ) {

		if ( isset( $_POST[static::TERM_NAME] ) && '' !== $_POST[static::TERM_NAME] ) {
			$upload = $_POST[static::TERM_NAME];
			update_term_meta ( $termId, static::TERM_NAME, $upload );
		} else {
			update_term_meta ( $termId, static::TERM_NAME, '' );
		}
	}
}
