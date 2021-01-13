<?php

struktur_select_get_single_post_format_html( $blog_single_type );

do_action( 'struktur_select_action_after_article_content' );

struktur_select_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

struktur_select_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

struktur_select_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

struktur_select_get_module_template_part( 'templates/parts/single/comments', 'blog' );