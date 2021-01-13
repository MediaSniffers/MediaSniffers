<article class="qodef-pcl-item qodef-item-space">
	<div class="qodef-pcl-item-inner">
		<?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/image', '', $params); ?>
		
		<div class="qodef-pcli-text-holder">
			<div class="qodef-pcli-text-wrapper">
				<div class="qodef-pcli-text">
					<?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/title', '', $params); ?>
				</div>
			</div>
		</div>
		
		<a itemprop="url" class="qodef-pcl-link" href="<?php echo get_the_permalink(); ?>"></a>
	</div>
</article>