<<?php echo esc_attr($title_tag); ?> class="qodef-accordion-title">
    <span class="qodef-accordion-mark">
		<span class="qodef_icon_plus qodef-icon-ion-icon ion-ios-arrow-down"></span>
		<span class="qodef_icon_minus qodef-icon-ion-icon ion-ios-arrow-up"></span>
	</span>
	<span class="qodef-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>