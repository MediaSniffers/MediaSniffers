<?php
$image_proportion       = struktur_select_get_meta_field_intersect( 'blog_list_featured_image_proportion', struktur_select_get_page_id() );
$image_proportion_value = get_post_meta( get_the_ID(), 'qodef_blog_metro_' . $image_proportion . '_dimensions_meta', true );

if ( isset( $image_proportion_value ) && $image_proportion_value !== '' ) {
	$size           = $image_proportion_value !== '' ? $image_proportion_value : 'default';
	$post_classes[] = 'qodef-masonry-size-' . $size;
} else {
	$size           = 'default';
	$post_classes[] = 'qodef-masonry-size-small';
}

if ( $image_proportion == 'original' ) {
	$part_params['image_size'] = 'full';
} else {
	switch ( $size ):
		case 'default':
			$part_params['image_size'] = 'struktur_select_image_square';
			break;
		case 'large-width':
			$part_params['image_size'] = 'struktur_select_image_landscape';
			break;
		case 'large-height':
			$part_params['image_size'] = 'struktur_select_image_portrait';
			break;
		case 'large-width-height':
			$part_params['image_size'] = 'struktur_select_image_huge';
			break;
		default:
			$part_params['image_size'] = 'struktur_select_image_square';
			break;
	endswitch;
}

$post_classes[] = 'qodef-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<?php if(get_post_format() !== 'quote' && get_post_format() !== 'link') : ?>
		<?php struktur_select_get_module_template_part('templates/parts/media', 'blog', '', $part_params); ?>
	<?php endif; ?>
	<?php if(get_post_format() === 'quote') : ?>
		<?php struktur_select_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
	<?php endif; ?>
	<?php if(get_post_format() === 'link') : ?>
		<?php struktur_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
	<?php endif; ?>
	
    <div class="qodef-post-info">
        <?php if((get_post_format() !== 'quote') && (get_post_format() !== 'link')) : ?>
	        <?php struktur_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
        <?php endif; ?>
        <?php struktur_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
    </div>
	
	<?php if(get_post_format() === 'quote') : ?>
		<?php
		$svg = struktur_select_get_svg( 'inverted-pattern', '#090909');
		if( struktur_select_is_plugin_installed('core') ){
			$markStyle = struktur_core_get_svg_mark( $svg );
		} else {
			$markStyle = '';
		}
		?>
		<div class="qodef-post-mark qodef-pattern-holder">
			<div class="qodef-pattern-before"></div>
			<span>”</span>
			<div class="qodef-pattern-after" style="<?php echo esc_attr($markStyle); ?>"></div>
		</div>
	<?php endif; ?>
	
	<?php if(get_post_format() === 'link') : ?>
		<?php
			$svg = struktur_select_get_svg( 'inverted-pattern', '#fafafa');
			if( struktur_select_is_plugin_installed('core') ){
				$markStyle = struktur_core_get_svg_mark( $svg );
			} else {
				$markStyle = '';
			}
		?>
		<div class="qodef-post-mark qodef-pattern-holder">
			<div class="qodef-pattern-before"></div>
			<span class="icon_link_alt"></span>
			<div class="qodef-pattern-after" style="<?php echo esc_attr($markStyle); ?>"></div>
		</div>
	<?php endif; ?>
	
</article>