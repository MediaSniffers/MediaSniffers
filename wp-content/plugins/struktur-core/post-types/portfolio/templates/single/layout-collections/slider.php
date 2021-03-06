<div class="qodef-ps-image-holder qodef-small-space">
	<div class="qodef-ps-image-inner qodef-owl-slider" data-enable-navigation="no" data-enable-pagination="yes">
		<?php
		$media = struktur_core_get_portfolio_single_media();
		
		if(is_array($media) && count($media)) : ?>
			<?php foreach($media as $single_media) : ?>
				<div class="qodef-ps-image">
					<?php struktur_core_get_portfolio_single_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<div class="qodef-st-title-holder">
	<h2 class="qodef-ps-title"><?php echo esc_html(get_the_title( get_the_ID())); ?></h2>
</div>

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