<div class="qodef-grid-row">
	<div class="qodef-grid-col-6">
        <div class="qodef-ps-image-holder">
            <div class="qodef-ps-image-inner">
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
    </div>
	<div class="qodef-grid-col-6">
        <div class="qodef-ps-info-holder qodef-ps-info-sticky-holder">
	        <div class="qodef-st-title-holder">
		        <h2 class="qodef-ps-title"><?php echo esc_html(get_the_title( get_the_ID())); ?></h2>
	        </div>
            <?php
            //get portfolio content section
            struktur_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
            
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