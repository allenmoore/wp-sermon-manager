<tr class="form-field term-group-wrap">
	<th scope="row">
		<label for="<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Image', 'wp-sermon-manager' ); ?></label>
	</th>
	<td>
		<input type="hidden" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $imageId ); ?>">
		<div id="wpsm-image-wrapper">
			<?php if ( $imageId ) { ?>
				<?php echo wp_get_attachment_image( $imageId, 'thumbnail' ); ?>
			<?php } ?>
		</div>
		<div>
			<button id="wpsm-add-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Add Image', 'wp-sermon-manager' ); ?></button>
			<button id="wpsm-delete-button" class="button button-secondary" aria-pressed="false"><?php esc_html_e( 'Delete Image', 'wp-sermon-manager' ); ?></button>
		</div>
	</td>
</tr>
