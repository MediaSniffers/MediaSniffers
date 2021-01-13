<div class="qodef-price-table qodef-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pt-inner" <?php echo struktur_select_get_inline_style($holder_styles); ?>>
		<div class="qodef-pt-cl">
			<div class="qodef-pt-prices qodef-pattern-holder">
				<div class="qodef-pattern-before"></div>
				<div class="qodef-pt-price-holder-inner">
					<span class="qodef-pt-price" <?php echo struktur_select_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
					<sup class="qodef-pt-value" <?php echo struktur_select_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
				</div>
				<div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
				<h6 class="qodef-pt-mark" <?php echo struktur_select_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</div>
		</div>
		<div class="qodef-pt-cr">
			<ul>
				<li class="qodef-pt-title-holder">
					<span class="qodef-pt-title" <?php echo struktur_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
				</li>
				<li class="qodef-pt-description-holder">
					<span class="qodef-pt-description"><?php echo esc_html($description); ?></span>
				</li>
				<li class="qodef-pt-content">
					<?php echo do_shortcode($content); ?>
				</li>
				<?php
				if(!empty($button_text)) { ?>
					<li class="qodef-pt-button">
						<?php echo struktur_select_get_button_html(array(
							'link' => $link,
							'target' => $target,
							'text' => $button_text,
							'type' => $button_type,
							'size' => 'medium'
						)); ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>