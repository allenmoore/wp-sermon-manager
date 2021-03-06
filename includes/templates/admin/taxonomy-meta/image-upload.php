<div class="form-field term-group">
	<label for="<?php echo esc_attr( $name ); ?>"><?php esc_html_e('Image', 'wpsm'); ?></label>
	<input type="hidden" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="">
	<div id="wpsm-image-wrapper"></div>
	<div>
		<button id="wpsm-add-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Add Image', 'wpsm' ); ?></button>
		<button id="wpsm-delete-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Delete Image', 'wpsm' ); ?></button>
	</div>
</div>
