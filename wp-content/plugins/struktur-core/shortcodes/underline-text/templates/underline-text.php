<<?php echo esc_attr( $text_tag ); ?> class="qodef-underline-text-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo struktur_select_get_inline_style( $holder_styles ); ?>>
<?php echo wp_kses_post( $text ); ?>
</<?php echo esc_attr( $text_tag ); ?> >