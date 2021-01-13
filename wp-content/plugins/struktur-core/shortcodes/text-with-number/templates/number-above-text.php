<div class="qodef-text-with-number-holder qodef-twn-number-above-text <?php echo esc_attr( $holder_classes ); ?>" <?php echo struktur_select_get_inline_style( $holder_styles ); ?>>
	<div class="qodef-twn-inner">
		<?php if( ! empty($number) ) : ?>
			<div class="qodef-twn-number-holder qodef-pattern-holder">
				<div class="qodef-pattern-before"></div>
				<span <?php struktur_select_inline_style($number_styles); ?>><?php echo esc_html($number); ?></span>
				<div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
			</div>
		<?php endif; ?>
		
		<?php if ( ! empty( $title ) ) { ?>
			<div class="qodef-twn-text-holder">
				<<?php echo esc_attr( $title_tag ); ?> class="qodef-twn-title" <?php echo struktur_select_get_inline_style( $title_styles ); ?>>
					<?php echo wp_kses( $title, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
				</<?php echo esc_attr( $title_tag ); ?>>
				<?php if ( ! empty( $text ) ) { ?>
					<?php echo wp_kses( $text, array( 'br' => true ) ); ?>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>