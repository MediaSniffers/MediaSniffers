<div class="qodef-outline-text-holder <?php echo esc_attr( $holder_classes ); ?>">
	<<?php echo esc_attr( $text_tag ); ?> class="qodef-outline-text" <?php struktur_select_inline_style( $text_styles ); ?> <?php echo struktur_select_get_inline_attrs( $text_data ); ?> >
		<?php echo wp_kses_post( $text ); ?>
	</<?php echo esc_attr( $text_tag ); ?>>
</div>