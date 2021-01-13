<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php struktur_select_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-text-main">
                    <?php struktur_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
	                <div class="qodef-post-info-top">
		                <?php struktur_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
		                <?php struktur_select_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
	                </div>
                    <?php the_content(); ?>
                    <?php do_action('struktur_select_action_single_link_pages'); ?>
                </div>
                <div class="qodef-post-info-bottom clearfix">
                    <div class="qodef-post-info-bottom-left">
                        <?php struktur_select_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>