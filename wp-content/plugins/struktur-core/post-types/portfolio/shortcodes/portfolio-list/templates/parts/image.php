<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="qodef-pli-image">
	<?php if ( has_post_thumbnail() ) {
		$image_src = get_the_post_thumbnail_url( get_the_ID() );
		
		$featured_image_meta = get_post_meta( get_the_ID(), 'qodef_featured_image_for_portfolio_list_meta', true );
		
		if ( !empty($featured_image_meta) ) {
			$image_src = $featured_image_meta;
			
			if ( $thumb_size !== 'custom' ) {
				if ( strpos( $image_src, '.gif' ) !== false ) {
					echo struktur_select_generate_thumbnail(null, $featured_image_meta, 'full', 'full');
				} else {
					if ($thumb_size === 'full') { ?>
						<img itemprop="image" class="qodef-pl-hover-image" src="<?php echo esc_url($featured_image_meta); ?>" alt="<?php esc_attr_e('portfolio featured image', 'struktur-core'); ?>" />
					<?php } else {
						$thumb_image_size = struktur_select_get_image_size($thumb_size);
						echo struktur_select_generate_thumbnail(null, $featured_image_meta, $thumb_image_size['width'], $thumb_image_size['height']);
					}
				}
			} elseif ( isset( $custom_image_width ) && ! empty( $custom_image_width ) && isset( $custom_image_height ) && ! empty( $custom_image_height ) ) {
				echo struktur_select_generate_thumbnail( null, $featured_image_meta, intval( $custom_image_width ), intval( $custom_image_height ) );
			}
			
		} else {
			
			if ( $thumb_size !== 'custom' ) {
				if ( strpos( $image_src, '.gif' ) !== false ) {
					echo get_the_post_thumbnail( get_the_ID(), 'full' );
				} else {
					echo get_the_post_thumbnail( get_the_ID(), $thumb_size );
				}
			} elseif ( isset( $custom_image_width ) && ! empty( $custom_image_width ) && isset( $custom_image_height ) && ! empty( $custom_image_height ) ) {
				echo struktur_select_generate_thumbnail( get_post_thumbnail_id( get_the_ID() ), null, intval( $custom_image_width ), intval( $custom_image_height ) );
			}
		}
		
	} else { ?>
		<img itemprop="image" class="qodef-pl-original-image" width="800" height="600" src="<?php echo STRUKTUR_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'struktur-core'); ?>" />
	<?php } ?>
</div>