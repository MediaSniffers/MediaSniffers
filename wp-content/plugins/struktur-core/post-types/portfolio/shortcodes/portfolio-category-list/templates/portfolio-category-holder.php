<div class="qodef-portfolio-category-list-holder qodef-grid-list <?php echo esc_attr( $holder_classes ); ?>">
	<div class="qodef-pcl-inner qodef-outer-space clearfix">
		<?php
			if ( ! empty( $query_results ) ) {
				foreach ( $query_results as $query ) {
					$termID            = $query->term_id;
					$params['image']   = get_term_meta( $termID, 'qodef_portfolio_category_image_meta', true );
					$params['title']   = $query->name;
					$params['excerpt'] = $query->description;
					?>
					<article class="qodef-pcl-item qodef-item-space">
						<div class="qodef-pcl-item-inner">
							<?php echo struktur_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/image', '', $params ); ?>
							<div class="qodef-pcli-text-holder">
								<div class="qodef-pcli-text-wrapper">
									<div class="qodef-pcli-text">
										<?php echo struktur_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/title', '', $params ); ?>
										<?php echo struktur_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/excerpt', '', $params ); ?>
									</div>
								</div>
							</div>
							<a itemprop="url" class="qodef-pcli-link" href="<?php echo get_term_link( $termID ); ?>"></a>
						</div>
					</article>
				<?php }
			} else {
				echo struktur_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/posts-not-found', '', $params );
			}
		?>
	</div>
</div>