<div class="qodef-pvl-info-item qodef-pvl-date">
    <?php echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/info-title', 'standard', array( 'title' => esc_attr__('Date:', 'struktur-core') )); ?>
    <p itemprop="dateCreated" class="qodef-pvl-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
    <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(struktur_select_get_page_id()); ?>"/>
</div>
