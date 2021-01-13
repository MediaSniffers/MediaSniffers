<div class="qodef-pvli-content-holder">
    <div class="qodef-pvli-background-text">
        <?php echo esc_html__( 'Next', 'struktur-core' ); ?>
    </div>
    <div class="qodef-pvli-image-holder">
        <div class="qodef-pvli-image-inner">
            <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/image', 'standard', $params); ?>
            <div class="qodef-pvli-image-title">
                <div class="qodef-pvli-image-title-inner">
                    <div class="qodef-pvli-info">
                        <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/category', 'standard', $params); ?>
                    </div>
                    <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/title', 'standard', $params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="qodef-pvli-text">
        <div class="qodef-pvli-text-inner">
            <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/title', 'standard', $params); ?>
            <div class="qodef-pvli-info">
                <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/category', 'standard', $params); ?>
            </div>
            <div class="qodef-container">
                <div class="qodef-container-inner clearfix">
                    <div class="qodef-grid-row">
                        <div class="qodef-grid-col-10">
                            <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/excerpt', 'standard', $params); ?>
                            <?php
                            //get portfolio tags section
                            echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/tags', 'standard', $params); ?>
                        </div>
                        <div class="qodef-grid-col-2">
                            <div class="qodef-pvl-info-holder">
                                <?php
                                //get portfolio custom fields section
                                echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/custom-fields', 'standard', $params);

                                //get portfolio categories section
                                echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/content-categories', 'standard', $params);

                                //get portfolio date section
                                echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/date', 'standard', $params);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qodef-full-width">
                <div class="qodef-full-width-inner">
                    <?php the_content();?>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="qodef-pvli-content-link"></a>
</div>