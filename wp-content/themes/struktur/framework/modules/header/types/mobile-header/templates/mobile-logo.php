<?php
$attachment_meta = struktur_select_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

do_action( 'struktur_select_action_before_mobile_logo' ); ?>

<div class="qodef-mobile-logo-wrapper">
	<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php struktur_select_inline_style( $logo_styles ); ?>>
		<img itemprop="image" src="<?php echo esc_url( $logo_image ); ?>" <?php echo wp_kses( $hwstring, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'Mobile Logo', 'struktur' ); ?>"/>
	</a>
</div>

<?php do_action( 'struktur_select_action_after_mobile_logo' ); ?>