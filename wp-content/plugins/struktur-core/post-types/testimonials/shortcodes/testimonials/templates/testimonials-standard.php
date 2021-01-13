<div class="qodef-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php struktur_select_inline_style($holder_styles); ?>>
	<?php if (!empty($title)) : ?>
		<div class="qodef-testimonials-title">
			<?php echo struktur_select_execute_shortcode('qodef_section_title', array('title' => $title, 'title_type'=> 'underlined')); ?>
		</div>
	<?php endif; ?>
	<div class="qodef-testimonials-quote">
		<div class="qodef-pattern-holder">
			<div class="qodef-pattern-before"></div>
			<?php
				$quote_svg = struktur_select_get_svg('quote');
				$first_main_color = struktur_select_options()->getOptionValue( 'first_color' );
			
				if( empty($quote_color) ) {
					$quote_color = '#f3a4a2';
				}
				
				if(!empty($quote_svg)) : ?>
					<img src="data:image/svg+xml;base64,<?php echo base64_encode(struktur_select_get_svg('quote-test', $quote_color)); ?>" alt="testimonials quote pattern">
			<?php endif; ?>
			<div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
		</div>
	</div>
    <div class="qodef-testimonials qodef-owl-slider" <?php echo struktur_select_get_inline_attrs( $data_attr ) ?>>
    <?php if ( $query_results->have_posts() ):
        while ( $query_results->have_posts() ) : $query_results->the_post();
	
	        $current_id = get_the_ID();
	        
            $text     = get_post_meta( $current_id, 'qodef_testimonial_text', true );
            $author   = get_post_meta( $current_id, 'qodef_testimonial_author', true );
            $position = get_post_meta( $current_id, 'qodef_testimonial_author_position', true );
    ?>

            <div class="qodef-testimonial-content" id="qodef-testimonials-<?php echo esc_attr( $current_id ) ?>">
                <div class="qodef-testimonial-text-holder">
                    <?php if ( ! empty( $text ) ) { ?>
                        <p class="qodef-testimonial-text"><?php echo esc_html( $text ); ?></p>
                    <?php } ?>
                    <?php if ( ! empty( $author ) ) { ?>
                        <h5 class="qodef-testimonials-author-name"><?php echo esc_html( $author ); ?></h5>
	                    <span class="qodef-testimonials-author-job">
		                    <?php if ( ! empty( $position ) ) {
			                    echo esc_html( $position );
		                    } ?>
	                    </span>
                    <?php } ?>
                </div>
            </div>
    <?php
        endwhile;
    else:
        echo esc_html__( 'Sorry, no posts matched your criteria.', 'struktur-core' );
    endif;

    wp_reset_postdata();
    ?>
    </div>
</div>