<?php
$title_tag    = isset( $title_tag ) ? $title_tag : 'h2';
$title_styles = isset( $this_object ) && isset( $params ) ? $this_object->getTitleStyles( $params ) : array();
?>

<<?php echo esc_attr($title_tag);?> itemprop="name" class="entry-title qodef-post-title" <?php struktur_select_inline_style($title_styles); ?>>
    <?php if(struktur_select_blog_item_has_link()) { ?>
        <a itemprop="url" href="<?php the_permalink(); ?>">
    <?php } ?>
        <?php the_title(); ?>
    <?php if(struktur_select_blog_item_has_link()) { ?>
        </a>
    <?php } ?>
</<?php echo esc_attr($title_tag);?>>