<div class="qodef-post-info-author">
    <span class="qodef-post-info-author-text">
        <?php esc_html_e('By', 'struktur'); ?>
    </span>
    <a itemprop="author" class="qodef-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
        <?php the_author_meta('display_name'); ?>
    </a>
</div>