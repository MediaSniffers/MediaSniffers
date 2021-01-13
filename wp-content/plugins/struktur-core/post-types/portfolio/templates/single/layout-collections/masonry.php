<?php
$masonry_classes   = '';
$number_of_columns = struktur_select_get_meta_field_intersect( 'portfolio_single_masonry_columns_number' );
if ( ! empty( $number_of_columns ) ) {
	$masonry_classes .= ' qodef-' . $number_of_columns . '-columns';
}
$space_between_items = struktur_select_get_meta_field_intersect( 'portfolio_single_masonry_space_between_items' );
if ( ! empty( $space_between_items ) ) {
	$masonry_classes .= ' qodef-' . $space_between_items . '-space';
}
?>
<div class="qodef-grid-row">
	<div class="qodef-grid-col-9">
		<?php struktur_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
		<?php
			$tags = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
			if(is_array($tags) && count($tags)) : ?>
			<div class="qodef-ps-tags">
				<?php foreach($tags as $tag) { ?>
					<a itemprop="url" class="qodef-ps-info-tag" href="<?php echo esc_url(get_term_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
				<?php } ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="qodef-grid-col-3">
		<div class="qodef-ps-info-holder">
			<?php
			//get portfolio custom fields section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio share section
			struktur_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>
<div class="qodef-ps-image-holder qodef-grid-list qodef-grid-masonry-list qodef-fixed-masonry-items qodef-disable-bottom-space <?php echo esc_attr( $masonry_classes ); ?>">
	<div class="qodef-ps-image-inner qodef-outer-space qodef-masonry-list-wrapper">
		<div class="qodef-masonry-grid-sizer"></div>
		<div class="qodef-masonry-grid-gutter"></div>
		<?php
		$media = struktur_core_get_portfolio_single_media(true);
		
		if ( is_array( $media ) && count( $media ) ) : ?>
			<?php foreach ( $media as $single_media ) : ?>
				<div class="qodef-ps-image qodef-item-space <?php echo esc_attr( $single_media['holder_classes'] ); ?>">
					<?php struktur_core_get_portfolio_single_media_html( $single_media ); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>