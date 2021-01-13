<div id="qodef-horizontal-layout">
    <div class="qodef-hl-items-wrapper">
        <?php if (!empty($items)) : foreach ($items as $item) : ?>
            <?php $type = $item['media_type'] == 'image' ? 'image' : 'video'; ?>
            <div class="qodef-hl-item" data-type="<?php echo esc_attr($type); ?>">
                <div class="qodef-hli-grid">
                    <div class="qodef-hli-top">
                        <span class="qodef-hli-num">
                            <span><?php echo esc_html($item['number']); ?></span>
                            <span class="qodef-hli-pattern" <?php struktur_select_inline_style($svg_pattern_style); ?>></span>
                        </span>
                    </div>
                    <div class="qodef-hli-mid">
                        <p class="qodef-hli-text"><?php echo esc_html($item['text']); ?></p>
                        <h5 class="qodef-hli-title">
                            <?php if (!empty($item['link'])) { ?> <a href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($item['target']); ?>"> <?php } ?>
                                <?php echo esc_html($item['title']); ?>
                                <?php if (!empty($item['link'])) { ?> </a> <?php } ?>
                        </h5>
                    </div>
                    <div class="qodef-hli-btm">
                        <div class="qodef-hli-btm-inner">
                            <?php if (!empty($item['link'])) { ?> <a href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($item['target']); ?>"> <?php } ?>
                                <?php if ($type == 'image') : ?>
                                    <?php if ( isset( $params['elementor'] ) ) {
                                        $item['image'] = $item['image']['id'];
                                    } ?>
                                    <div class="qodef-hli-btm-item qodef-hli-image">
                                        <img src="<?php echo wp_get_attachment_url($item['image']); ?>" alt="<?php the_title($item['image']); ?>" />
                                    </div>
                                <?php else : ?>
                                    <div class="qodef-hli-btm-item qodef-hli-video">
                                        <video autoplay loop muted>
                                            <source src="<?php echo esc_url($item['video_url']); ?>" type="video/mp4">
                                        </video>
                                    </div>
                                <?php endif; ?>
                            <?php if (!empty($item['link'])) { ?> </a> <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; ?>
        <div class="qodef-hl-cta">
            <h1 class="qodef-hl-cta-title"><?php echo esc_attr($cta_title);?></h1>
            <div class="qodef-hl-cta-btn">
                <?php 
                    echo struktur_select_get_button_html(array(
                        'link' => $cta_link,
                        'target' => $cta_link_target,
                        'text' => $cta_link_text,
                        'type' => 'simple',
                        'size' => 'medium'
                    )); 
                ?>
            </div>
            <?php if ( ! empty( $cta_widget_area ) && is_active_sidebar( $cta_widget_area ) ) : ?>
                <div class="qodef-hl-cta-widget">
                    <?php dynamic_sidebar( $cta_widget_area ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div id="qodef-hl-scroll-area"></div>
</div>