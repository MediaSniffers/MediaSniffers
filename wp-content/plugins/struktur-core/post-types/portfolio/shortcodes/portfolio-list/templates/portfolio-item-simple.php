<?php
if ( get_post_meta( get_the_ID(), "qodef_portfolio_featured_image_meta", true ) !== "" && $type === 'simple' ) {
	$additionalClass = 'qodef-pl-has-switch-image';
}
?>
<article class="qodef-pli qodef-pl-simple-holder <?php if(!empty($additionalClass)) echo $additionalClass;?>">
    <div class="qodef-pli-inner">
	    <div class="qodef-pli-text-holder">
	        <div class="qodef-pli-text-holder-inner">
	            <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>
		        
		        <a href="<?php echo esc_url( $this_object->getItemLink() ); ?>">
					<?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>
		        </a>
	        </div>
	    </div>
	    <div class="qodef-pli-image-holder">
		    <a href="<?php echo esc_url( $this_object->getItemLink() ); ?>">
		        <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image-standard-switch-images', $item_style, $params); ?>
		    </a>
	    </div>
    </div>
</article>