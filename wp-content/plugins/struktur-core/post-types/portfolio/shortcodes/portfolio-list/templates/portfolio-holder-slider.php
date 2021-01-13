<div class="qodef-portfolio-list-holder qodef-grid-list <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>
	<div class="qodef-pl-inner qodef-outer-space <?php echo esc_attr($holder_inner_classes); ?> clearfix">
		<?php
		if($query_results->have_posts()):
			$number_of_items = $query_results->query['posts_per_page'];
			$i = 0;
			while ( $query_results->have_posts() ) : $query_results->the_post();
				if($two_rows === 'yes') :
					if($i % 2 == 0) : ?>
						<div class="qodef-portfolio-slide-item-holder">
					<?php endif;
				endif;
				echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', $item_type, $params);
				if($two_rows === 'yes') :
					if( $i % 2 == 1 || $i + 1 == $number_of_items): ?>
						</div>
					<?php endif;
				endif;
				$i++;
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