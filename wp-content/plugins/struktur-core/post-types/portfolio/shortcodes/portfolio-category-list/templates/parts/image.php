<?php if ( ! empty( $image ) ) { ?>
	<div class="qodef-pcli-image">
		<?php if ( $image_size !== 'custom' ) {
			echo wp_get_attachment_image( $image, $image_size );
		} elseif ( isset( $custom_image_width ) && ! empty( $custom_image_width ) && isset( $custom_image_height ) && ! empty( $custom_image_height ) ) {
			echo struktur_select_generate_thumbnail( $image, null, intval( $custom_image_width ), intval( $custom_image_height ) );
		} ?>
	</div>
<?php } ?>