<div class="qodef-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-iwt-image">
        <?php if ($image_behavior === 'lightbox') { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
	            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
        <?php } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo struktur_select_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
            </a>
        <?php } ?>

        <?php if ($image_behavior === 'links-over-image' ) { ?>
            <div class="qodef-iwt-links-holder">
                <div class="qodef-iwt-links-holder-inner">
                    <?php if (!empty($custom_link_one) && !empty($link_text_one)) : ?>
                        <a itemprop="url" href="<?php echo esc_url($custom_link_one); ?>" target="<?php echo esc_attr($custom_link_target); ?>"><span><?php echo esc_html($link_text_one); ?></span></a>
                    <?php endif; ?>
                    <?php if (!empty($custom_link_two) && !empty($link_text_two)) : ?>
                        <a itemprop="url" href="<?php echo esc_url($custom_link_two); ?>" target="<?php echo esc_attr($custom_link_target); ?>"><span><?php echo esc_html($link_text_two); ?></span></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="qodef-iwt-text-holder">
	    <?php if(!empty($number)) { ?>
		    <span class="qodef-iwt-number"><?php echo esc_html($number); ?></span>
		<?php } ?>
        <?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="qodef-iwt-title" <?php echo struktur_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
            <p class="qodef-iwt-text" <?php echo struktur_select_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        <?php } ?>
    </div>
</div>