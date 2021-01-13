<?php
$gallery_classes   = '';
$number_of_columns = struktur_select_get_meta_field_intersect( 'portfolio_single_gallery_columns_number' );
if ( ! empty( $number_of_columns ) ) {
	$gallery_classes .= ' qodef-' . $number_of_columns . '-columns';
}
$space_between_items = struktur_select_get_meta_field_intersect( 'portfolio_single_gallery_space_between_items' );
if ( ! empty( $space_between_items ) ) {
	$gallery_classes .= ' qodef-' . $space_between_items . '-space';
}
?>
<div class="qodef-ps-image-holder qodef-ps-gallery-images qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr($gallery_classes); ?>">
	<div class="qodef-ps-image-inner qodef-outer-space">
		<?php
		$media = struktur_core_get_portfolio_single_media();
		
		if(is_array($media) && count($media)) : ?>
			<?php foreach($media as $single_media) : ?>
				<div class="qodef-ps-image qodef-item-space">
					<?php struktur_core_get_portfolio_single_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<div class="qodef-grid-row">
	<div class="qodef-grid-col-8">
		<?php struktur_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
	</div>
	<div class="qodef-grid-col-4">
		<div class="qodef-ps-info-holder">
			<?php
			//get portfolio custom fields section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>