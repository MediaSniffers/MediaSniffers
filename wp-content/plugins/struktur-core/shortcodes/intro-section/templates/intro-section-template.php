<div id="qodef-intro-section">
    <section id="qodef-is-1">
        <div class="qodef-is-loading-bg"></div>
        <div class="qodef-is-loading-center">
            <div class="qodef-is-loading-pattern" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
            <div class="qodef-is-loading-label"><?php echo struktur_select_get_split_text('Loading') ?></div>
            <h2 class="qodef-is-loading-title"><?php echo esc_attr($loading_title); ?><span class="qodef-is-loading-progress"></span></h2>
        </div>
        <div class="qodef-is-loading-bottom">
            <h4 class="qodef-is-loading-subtitle"><?php echo esc_attr($loading_subtitle); ?></h4>
            <h5 class="qodef-is-loading-tagline">(<?php echo esc_attr($loading_tagline); ?>)</h5>
        </div>
    </section>
    <div id="qodef-is-cover"></div>
    <video id="qodef-is-video" loop muted playsinline src="<?php echo esc_url($video_url) ?>"></video>
    <div id="qodef-is-first-title">
        <h1><?php echo wp_kses($first_title, array('br' => true, 'span' => array('class' => true))); ?></h1>
    </div>
    <div id="qodef-is-second-title">
        <h1><?php echo wp_kses($second_title, array('br' => true, 'span' => array('class' => true))); ?></h1>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="qodef-is-arrow" x="0px" y="0px" width="219.374px" height="244.391px" viewBox="0 0 219.374 244.391" enable-background="new 0 0 219.374 244.391" xml:space="preserve">
        <polygon fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" points="217.96,134.411 195.5,111.951   125.619,181.834 125.618,1 93.656,1 93.656,181.756 24.155,112.256 1.414,134.997 86.935,220.518 109.393,242.976 " />
    </svg>
    <div id="qodef-is-link">
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
<div id="qodef-is-height"></div>