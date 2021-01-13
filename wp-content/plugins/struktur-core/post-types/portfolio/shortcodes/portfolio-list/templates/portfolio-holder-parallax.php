<div class="qodef-portfolio-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
    <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>

    <div class="qodef-pl-inner <?php echo esc_attr($holder_inner_classes); ?> clearfix">
        <?php
        if ($query_results->have_posts()) :
            while ($query_results->have_posts()) : $query_results->the_post();
                echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item-parallax', $item_type, $params);
            endwhile;
        else :
            echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
        endif;

        wp_reset_postdata();
        ?>
    </div>
    <?php $pagination_type = 'no-pagination'; ?>
    <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'pagination/' . $pagination_type, '', $params, $additional_params); ?>


    <div class="qodef-portfolio-list-texts">
        <?php
        if ($query_results->have_posts()) :
            while ($query_results->have_posts()) : $query_results->the_post();
                echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item-parallax-text', $item_type, $params);
            endwhile;
        else :
            echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
        endif;

        wp_reset_postdata();
        ?>
    </div>
</div>