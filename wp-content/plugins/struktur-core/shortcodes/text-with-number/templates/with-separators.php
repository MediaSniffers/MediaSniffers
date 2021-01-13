<div class="qodef-text-with-number-holder qodef-twn-with-separators">
<?php for ($i = 0; $i < intval($number_of_columns); $i++) { ?>
	<div class="qodef-text-with-number-item <?php echo esc_attr( $holder_classes ); ?>" <?php echo struktur_select_get_inline_style( $holder_styles ); ?>>
		<div class="qodef-twn-inner">
			<?php if( ! empty($items[$i]['number']) ) : ?>
				<div class="qodef-twn-number-holder qodef-pattern-holder">
					<div class="qodef-pattern-before"></div>
					<span class="qodef-num" <?php struktur_select_inline_style($number_styles); ?>><?php echo esc_html($items[$i]['number']); ?></span>
					<div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
				</div>
			<?php endif; ?>
			
			<?php if ( ! empty( $items[$i]['title'] ) ) { ?>
			<div class="qodef-twn-text-holder">
				<<?php echo esc_attr( $title_tag ); ?> class="qodef-twn-title" <?php echo struktur_select_get_inline_style( $title_styles ); ?>>
					<?php echo wp_kses( $items[$i]['title'], array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
				</<?php echo esc_attr( $title_tag ); ?>>
			</div>
			<?php } ?>
		</div>
		<?php if ($i !== intval($number_of_columns)-1) : ?>
			<div class="qodef-twn-separator" <?php struktur_select_inline_style($separator_styles); ?>></div>
		<?php endif; ?>
	</div>
<?php } ?>
</div>