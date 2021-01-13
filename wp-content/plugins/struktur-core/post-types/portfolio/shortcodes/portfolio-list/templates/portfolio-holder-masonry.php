<div class="qodef-portfolio-list-holder qodef-grid-list qodef-grid-masonry-list <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>
	<div class="qodef-pl-inner qodef-outer-space qodef-masonry-list-wrapper clearfix">
		<div class="qodef-masonry-grid-sizer"></div>
		<div class="qodef-masonry-grid-gutter"></div>
		<?php 
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', $item_type, $params);
				endwhile;
			else:
				echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	
	<?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
	
	<?php if($item_style === 'gallery-overlay') : ?>
		<div class="qodef-pl-custom-cursor"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 251 253" width="230" height="230"><defs><clipPath id="b"><rect width="251" height="253"></rect></clipPath></defs><g id="a" class="a"><path d="M38.389,0V40.276H169.9L0,210.179,28.482,238.66l169.9-169.9V200.271H238.66V0Z" transform="translate(5.88 7)"></path></g></svg></div>
	<?php endif; ?>
</div>