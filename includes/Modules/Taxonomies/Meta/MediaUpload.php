<?php
/**
 * Media Upload
 *
 * @package WPSermonManager\Modules\Taxonomies\Meta
 */
namespace WPSermonManager\Modules\Taxonomies\Meta;

/**
 * The MediaUpload Class.
 *
 * @since 1.0.0
 */
class MediaUpload {

	/**
	 * The MediaUpload Constructor
	 */
	public function __construct() {
		add_action( 'wpsm-sermon-speaker_add_form_fields', array ( $this, 'uploadImage' ), 10 );
		add_action( 'created_wpsm-sermon-speaker', array ( $this, 'saveImage' ), 10, 2 );
		add_action( 'wpsm-sermon-speaker_edit_form_fields', array ( $this, 'updateImage' ), 10, 2 );
		add_action( 'edited_wpsm-sermon-speaker', array ( $this, 'updatedImage' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enququeAdminScripts' ) );
	}

	/**
	 * Method to enqueue JavaScript for the Admin Dashoard
	 */
	public function enququeAdminScripts() {

		$min = defined( 'SCRIPT_DEBUG' ) && filter_var( SCRIPT_DEBUG, FILTER_VALIDATE_BOOLEAN ) ? '' : '.min';
		$pluginUrl = trailingslashit( WP_SERMON_MANAGER_URL );

		wp_enqueue_media();

		wp_enqueue_script(
			'wpsm-admin-uploader',
			esc_url( $pluginUrl . 'dist/js/build.admin' . $min . '.js' ),
			[],
			WP_SERMON_MANAGER_VERSION,
			true
		);
	}

	/**
	 * Method to handle image uploads
	 *
	 * @param string $tax The taxonomy slug
	 */
	public function uploadImage( $tax ) {

		?>
		<div class="form-field term-group">
			<label for="wpsm-upload-id"><?php esc_html_e('Image', 'wp-sermon-manager'); ?></label>
			<input type="hidden" id="wpsm-upload-id" name="wpsm-upload-id" class="custom_media_url" value="">
			<div id="wpsm-upload-wrapper"></div>
			<div>
				<button id="wpsm-add-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Add Image', 'wp-sermon-manager' ); ?></button>
				<button id="wpsm-delete-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Delete Image', 'wp-sermon-manager' ); ?></button>
			</div>
		</div>
		<?php
	}

	/**
	 * Method to handle saving images
	 *
	 * @param int $termId The ID of the term
	 * @param int $ttId The taxonomy term ID
	 */
	public function saveImage( $termId, $ttId ) {

		if ( isset( $_POST['wpsm-upload-id'] ) && '' !== $_POST['wpsm-upload-id'] ) {
			$upload = $_POST['wpsm-upload-id'];
			add_term_meta( $termId, 'wpsm-upload-id', $upload, true );
		}
	}

	/**
	 * Method to handle updating images
	 *
	 * @param WP_Term $term The current taxonomy term object.
	 * @param string $taxonomy The current taxonomy slug.
	 */
	public function updateImage( $term, $taxonomy ) {
		?>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="wpsm-upload-id"><?php esc_html_e( 'Image', 'wp-sermon-manager' ); ?></label>
			</th>
			<td>
				<?php $uploadId = get_term_meta( $term->term_id, 'wpsm-upload-id', true ); ?>
				<input type="hidden" id="wpsm-upload-id" name="wpsm-upload-id" value="<?php echo $uploadId; ?>">
				<div id="wpsm-upload-wrapper">
					<?php if ( $uploadId ) { ?>
						<?php echo wp_get_attachment_image( $uploadId, 'thumbnail' ); ?>
					<?php } ?>
				</div>
				<div>
					<button id="wpsm-add-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Add Image', 'wp-sermon-manager' ); ?></button>
					<button id="wpsm-delete-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Delete Image', 'wp-sermon-manager' ); ?></button>
				</div>
			</td>
		</tr>
		<?php
	}

	/**
	 * Method to handle an updated image
	 *
	 * @param int $termId The term ID.
	 * @param int $ttId The term taxonomy ID.
	 */
	public function updatedImage( $termId, $ttId ) {

		if ( isset( $_POST['wpsm-upload-id'] ) && '' !== $_POST['wpsm-upload-id'] ) {
			$upload = $_POST['wpsm-upload-id'];
			update_term_meta ( $termId, 'wpsm-upload-id', $upload );
		} else {
			update_term_meta ( $termId, 'wpsm-upload-id', '' );
		}
	}
}
