<div class="qodef-call-to-action-holder <?php echo esc_attr($holder_classes); ?>" <?php struktur_select_inline_style($holder_background_color); ?>>
	<div class="qodef-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<?php if($layout === 'simple') { ?>
			<div class="qodef-cta-text-holder qodef-pattern-holder">
				<div class="qodef-pattern-before"></div>
				<div class="qodef-cta-text"><?php echo do_shortcode($content); ?></div>
				<div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
			</div>
		<?php } else { ?>
			<div class="qodef-cta-text-holder">
				<div class="qodef-cta-text"><?php echo do_shortcode($content); ?></div>
			</div>
		<?php } ?>
		<div class="qodef-cta-button-holder" <?php echo struktur_select_get_inline_style($button_holder_styles); ?>>
			<div class="qodef-cta-button"><?php echo struktur_select_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>