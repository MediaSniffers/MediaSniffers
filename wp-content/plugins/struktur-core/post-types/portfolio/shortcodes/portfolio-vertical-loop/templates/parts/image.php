<div class="qodef-pvli-image">
	<?php if ( has_post_thumbnail() ) {
		$image_src = get_the_post_thumbnail_url( get_the_ID() );

        echo get_the_post_thumbnail( get_the_ID(), 'full' );

	} else { ?>
		<img itemprop="image" class="qodef-pvl-original-image" width="800" height="600" src="<?php echo STRUKTUR_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'struktur-core'); ?>" />
	<?php } ?>
</div>