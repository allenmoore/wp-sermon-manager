<?php
/**
 * Taxonomy Meta Abstract
 *
 * @package WPSermonManager\Admin
 */
namespace WPSermonManager\Admin;

/**
 * The TaxonomyMetaAbstract Abstract Class.
 *
 * @since 1.0.0
 */
abstract class TaxonomyMetaAbstract {

	/**
	 * The TaxonomyMetaAbstract Constructor.
	 */
	public function __construct() {
		$this->register();
	}

	public function register() {

		$termName = $this->getTermName();

		add_action( $termName . '_add_form_fields', array ( $this, 'uploadImage' ), 10 );
		add_action( 'created_' . $termName, array ( $this, 'saveImage' ), 10, 2 );
		add_action( $termName . '_edit_form_fields', array ( $this, 'updateImage' ), 10, 2 );
		add_action( 'edited_' . $termName, array ( $this, 'updatedImage' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enququeAdminScripts' ) );
	}

	/**
	 * Get metabox name
	 *
	 * We use a static property $name as a result of the limitation that we can't have
	 * abstract properties. This way when $name is not defined,
	 * an error will be generated.
	 *
	 * @return string $name.
	 */
	public static final function getName() {
		return static::$name;
	}

	/**
	 * Method to get the taxonomy term name
	 *
	 * @return string The taxonomy term name.
	 */
	public function getTermName() {
		return static::get_name() . '-image-id';
	}

	/**
	 * Method to enqueue JavaScript for the Admin Dashoard
	 */
	public function enququeAdminScripts() {
		global $current_screen;

		if ( 'wpsm-sermon' !== $current_screen->post_type ) return;

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

		$termName = $this->getTermName();
		?>
		<div class="form-field term-group">
			<label for="<?php echo esc_attr( $termName ); ?>"><?php esc_html_e('Image', 'wp-sermon-manager'); ?></label>
			<input type="hidden" id="<?php echo esc_attr( $termName ); ?>" name="<?php echo esc_attr( $termName ); ?>" class="custom_media_url" value="">
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

		$termName = $this->getTermName();

		if ( isset( $_POST[$termName] ) && '' !== $_POST[$termName] ) {
			$upload = $_POST[$termName];
			add_term_meta( $termId, $termName, $upload, true );
		}
	}

	/**
	 * Method to handle updating images
	 *
	 * @param WP_Term $term The current taxonomy term object.
	 * @param string $taxonomy The current taxonomy slug.
	 */
	public function updateImage( $term, $taxonomy ) {

		$termName = $this->getTermName();
		?>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="<?php echo esc_attr( $termName ); ?>"><?php esc_html_e( 'Image', 'wp-sermon-manager' ); ?></label>
			</th>
			<td>
				<?php $uploadId = get_term_meta( $term->term_id, $termName, true ); ?>
				<input type="hidden" id="<?php echo esc_attr( $termName ); ?>" name="<?php echo esc_attr( $termName ); ?>" value="<?php echo esc_attr( $uploadId ); ?>">
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

		$termName = $this->getTermName();

		if ( isset( $_POST[$termName] ) && '' !== $_POST[$termName] ) {
			$upload = $_POST[$termName];
			update_term_meta ( $termId, $termName, $upload );
		} else {
			update_term_meta ( $termId, $termName, '' );
		}
	}
}
