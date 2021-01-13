<?php if(struktur_select_get_meta_field_intersect('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = struktur_select_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
	
	$svg = struktur_select_get_svg( 'inverted-pattern');
	$svg_pattern_style = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";
	
	$navigation_html = '
		<div class="qodef-ps-navigation-text-holder qodef-pattern-holder">
			<div class="qodef-pattern-before"></div>
			<span class="qodef-ps-navigation-text">'. esc_html( "Next project") .'</span>
			<div class="qodef-pattern-after" style="'. esc_attr($svg_pattern_style) .'"></div>
		</div>
		<div class="qodef-ps-nav-mark">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="182.671px" height="163.806px" viewBox="0 0 182.671 163.806" enable-background="new 0 0 182.671 163.806"
				 xml:space="preserve">
			<g>
				<path d="M100.987,163.806l-17.761-17.761l51.62-51.62H0l0-24.97h134.904L82.998,17.55L100.548,0l82.123,82.123L100.987,163.806z
					 M84.641,146.045l16.347,16.347l80.27-80.269L100.548,1.414L84.412,17.55l52.907,52.905H1l0,22.97h136.26L84.641,146.045z"/>
			</g>
			</svg>
		</div>';
    ?>

    <div class="qodef-ps-navigation">
        <?php if(get_next_post() !== '') : ?>
            <div class="qodef-ps-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', $navigation_html, true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', $navigation_html);
                } ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>