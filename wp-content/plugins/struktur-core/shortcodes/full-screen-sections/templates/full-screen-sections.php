<div class="qodef-full-screen-sections <?php echo esc_attr( $holder_classes ); ?>" <?php echo struktur_select_get_inline_attrs( $holder_data ); ?>>
	<div class="qodef-fss-wrapper">
		<?php echo do_shortcode( $content ); ?>
	</div>
	<?php if ( $enable_navigation === 'yes' ) { ?>
		<div class="qodef-fss-nav-holder">
			<a id="qodef-fss-nav-up" href="#"><span class='icon-arrows-up'></span></a>
			<a id="qodef-fss-nav-down" href="#"><span class='icon-arrows-down'></span></a>
		</div>
	<?php } ?>
</div>