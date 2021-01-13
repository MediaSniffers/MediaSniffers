<div class="qodef-vertical-showcase qodef-vs-ready-animation <?php echo esc_attr($holder_classes); ?> q-odd-visible">
    <div class="qodef-vs-holder">
        <div class="qodef-vs-frame-holder">
            <div class="qodef-vs-frame-mobile-holder">
                <img src="../wp-content/plugins/struktur-core/assets/img/mobile-frame.png" alt="<?php esc_attr_e('Mobile frame image', 'struktur-core'); ?>">
                <div class="qodef-vs-inner-frame"></div>
            </div>
        </div>
        <?php if (!empty($dotted_text)) : ?>
            <div class="qodef-vs-dotted-text-holder">
                <div class="qodef-sc-1">
                    <div class="qodef-sc-clip-1">
                        <div class="qodef-sc-clip-2">
                            <div class="qodef-p-1">
                                <div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style_left); ?>></div>
                            </div>
                            <span class="qodef-vs-dotted-text"><?php echo esc_html__($dotted_text, 'struktur-core') ?></span>
                            <div class="qodef-b-1"></div>
                        </div>
                    </div>
                </div>
                <div class="qodef-sc-2">
                    <div class="qodef-p-2">
                        <div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style_right); ?>></div>
                    </div>
                    <span class="qodef-vs-dotted-text"><?php echo esc_html__($dotted_text, 'struktur-core') ?></span>
                    <div class="qodef-b-2">
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="qodef-vs-frame-info qodef-vs-frame-animate-out">
            <div class="qodef-vs-frame-info-top">
	            <div class="qodef-vs-frame-info-text-with-number">
		            <span class="qodef-vs-frame-slide-number">01</span>
		            <h3 class="qodef-vs-frame-title-after-number"></h3>
		            <span class="qodef-vs-frame-slide-text"></span>
	            </div>
            </div>
            <div class="qodef-vs-frame-info-bottom">
	            <h4 class="qodef-vs-frame-title"></h4>
	            <div class="qodef-vs-frame-subtitle"></div>
            </div>
            <div class="qodef-vs-frame-info-other">
                <?php if ($enable_app_store_link == "yes") { ?>
                    <a itemprop="url" class="qodef-vs-item-app-store-link" href="<?php echo esc_url($app_store_link); ?>" target="_blank">
                        <img src="../wp-content/plugins/struktur-core/assets/img/logo-app-store.png" alt="<?php esc_attr_e('Apple store logo', 'struktur-core'); ?>">
                    </a>
                <?php } ?>
                <?php if ($enable_play_store_link == "yes") { ?>
                    <a itemprop="url" class="qodef-vs-item-play-store-link" href="<?php echo esc_url($play_store_link); ?>" target="_blank">
                        <img src="../wp-content/plugins/struktur-core/assets/img/logo-play-store.png" alt="<?php esc_attr_e('Play store logo', 'struktur-core'); ?>">
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if (!empty($link_items)) { ?>
                    <?php foreach ($link_items as $link_item) : ?>
                        <div class="swiper-slide">
                            <div class="qodef-vs-item">
                                <?php if ( isset( $params['elementor'] ) ) {
                                    $link_item['image'] = $link_item['image']['id'];
                                } ?>
                                <?php if (isset($link_item['image'])) { ?>
                                    <?php echo wp_get_attachment_image($link_item['image'], 'full'); ?>
                                <?php } ?>
                                <div class="qodef-vs-item-info">
                                    <?php if (isset($link_item['title_after_number'])) { ?>
                                        <span class="qodef-vs-item-slide-title-after-number"><?php echo esc_html($link_item['title_after_number']); ?></span>
                                    <?php } ?>
	                                <?php if (isset($link_item['slide_text'])) { ?>
                                        <span class="qodef-vs-item-slide-text"><?php echo esc_html($link_item['slide_text']); ?></span>
                                    <?php } ?>
                                    <?php if (isset($link_item['title'])) { ?>
                                        <span class="qodef-vs-item-title"><?php echo esc_html($link_item['title']); ?></span>
                                    <?php } ?>
                                    <?php if (isset($link_item['subtitle'])) { ?>
                                        <span class="qodef-vs-item-subtitle"><?php echo esc_html($link_item['subtitle']); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="swiper-slide">
                        <div class="qodef-vs-contact-form">
                            <div class="qodef-vs-contact-form-info">
                                <?php if (!empty($contact_form_title)) { ?>
                                    <div class="qodef-vs-contact-form-title qodef-pattern-holder">
	                                    <div class="qodef-pattern-before"></div>
                                        <h1><?php echo esc_html($contact_form_title); ?></h1>
	                                    <div class="qodef-pattern-after" <?php struktur_select_inline_style($svg_pattern_style_left); ?>></div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($contact_form_subtitle)) { ?>
                                    <div class="qodef-vs-contact-form-subtitle">
                                        <p><?php echo esc_html($contact_form_subtitle); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if (!empty($contact_form)) {
                                echo do_shortcode('[contact-form-7 id="' . esc_attr($contact_form) . '"]');
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>