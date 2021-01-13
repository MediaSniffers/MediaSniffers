<div id="qodef-outro-section">
    <section id="qodef-os-main">
        <a class="qodef-abs-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
        <div class="qodef-os-bg"></div>
        <div class="qodef-os-center">
            <div class="qodef-os-pattern" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
            <div class="qodef-os-label"><?php echo struktur_select_get_split_text($title); ?></div>
        </div>
        <div class="qodef-os-bottom">
            <h4 class="qodef-os-subtitle"><?php echo esc_attr($subtitle); ?></h4>
            <h5 class="qodef-os-tagline">(<?php echo esc_attr($tagline); ?>)</h5>
        </div>
    </section>
    <div id="qodef-os-link">
        <?php
        echo struktur_select_get_button_html(array(
            'link' => $link,
            'target' => $link_target,
            'text' => $link_text,
            'type' => 'simple',
            'size' => 'medium'
        ));
        ?>
    </div>
</div>
<svg id="qodef-os-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 251 253" width="230" height="230" stroke="#fff" fill="transparent" stroke-width="1.5px">
    <path d="M38.389,0V40.276H169.9L0,210.179,28.482,238.66l169.9-169.9V200.271H238.66V0Z" transform="translate(5.88 7)" />
</svg>