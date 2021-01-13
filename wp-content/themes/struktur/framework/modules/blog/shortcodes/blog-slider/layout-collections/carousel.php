<?php
$image_meta = get_post_meta( get_the_ID(), 'qodef_blog_list_featured_image_meta', true );
if (!empty(!$image_meta) || $image_meta === '') {
	$image_meta = get_the_post_thumbnail_url();
}
?>
<li class="qodef-blog-slider-item">
	<div class="qodef-blog-slider-item-inner">
		<div class="qodef-item-image">
			<a itemprop="url" href="<?php echo get_permalink(); ?>">
				<?php if( !empty($image_meta)) : ?>
					<img src="<?php echo esc_url($image_meta); ?>" alt="blog corousel image">
				<?php endif; ?>
			</a>
		</div>
		<div class="qodef-bli-content">
			<div class="qodef-bli-content-inner">
				<?php struktur_select_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
				<?php struktur_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
			</div>
			<div class="qodef-bli-excerpt qodef-hidden">
				<?php struktur_select_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
			</div>
		</div>
	</div>
</li>