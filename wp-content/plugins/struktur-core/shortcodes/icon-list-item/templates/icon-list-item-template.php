<?php $icon_html = struktur_select_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="qodef-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo struktur_select_get_inline_style($holder_styles); ?>>
	<div class="qodef-il-icon-holder">
		<?php echo wp_kses_post($icon_html); ?>
	</div>
	<p class="qodef-il-text" <?php echo struktur_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>