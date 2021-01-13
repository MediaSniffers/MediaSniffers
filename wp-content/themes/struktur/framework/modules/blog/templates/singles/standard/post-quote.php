<?php
$svg = struktur_select_get_svg( 'inverted-pattern', '#000');
if( struktur_select_is_plugin_installed('core') ){
	$markStyle = struktur_core_get_svg_mark( $svg );
} else {
	$markStyle = '';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-text-main">
	                <div class="qodef-post-mark qodef-pattern-holder">
		                <div class="qodef-pattern-before"></div>
		                <span>”</span>
		                <div class="qodef-pattern-after" style="<?php echo esc_attr($markStyle); ?>"></div>
	                </div>
                    <?php struktur_select_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-info-bottom clearfix">
                    <?php struktur_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php struktur_select_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="qodef-post-additional-content">
        <?php the_content(); ?>
    </div>
	<div class="qodef-post-info-below-content">
		<?php struktur_select_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
	</div>
</article>