<?php
$shader_styles          = $this_object->getShaderStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="qodef-plc-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="qodef-plc-outer qodef-owl-slider" <?php echo struktur_select_get_inline_attrs( $holder_data ); ?>>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post(); ?>
			<div class="qodef-plc-item">
				<div class="qodef-plc-image-outer">
					<div class="qodef-plc-image">
						<?php struktur_select_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
					</div>
					<div class="qodef-plc-text" <?php echo struktur_select_get_inline_style( $shader_styles ); ?>>
						<div class="qodef-plc-text-outer">
							<div class="qodef-plc-text-inner">
								<?php struktur_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
								
								<?php struktur_select_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
								
								<?php struktur_select_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
								
								<?php struktur_select_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
								
								<?php struktur_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
								
								<?php struktur_select_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
							</div>
						</div>
					</div>
					<a class="qodef-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
			</div>
		<?php endwhile;
		else:
			struktur_select_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>