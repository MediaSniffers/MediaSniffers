<?php

if ( ! function_exists( 'struktur_select_woocommerce_body_class' ) ) {
	function struktur_select_woocommerce_body_class( $classes ) {
		if ( struktur_select_is_woocommerce_page() ) {
			$classes[] = 'qodef-woocommerce-page';
			
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$classes[] = 'qodef-woo-main-page';
			}
			
			if ( is_singular( 'product' ) ) {
				$classes[] = 'qodef-woo-single-page';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woocommerce_body_class' );
}

if ( ! function_exists( 'struktur_select_woocommerce_columns_class' ) ) {
	function struktur_select_woocommerce_columns_class( $classes ) {
		
		if ( is_singular( 'product' ) ) {
			$classes[] = struktur_select_options()->getOptionValue( 'qodef_woo_related_products_columns' );
		} else {
			$classes[] = struktur_select_options()->getOptionValue( 'qodef_woo_product_list_columns' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woocommerce_columns_class' );
}

if ( ! function_exists( 'struktur_select_woocommerce_columns_space_class' ) ) {
	function struktur_select_woocommerce_columns_space_class( $classes ) {
		$woo_space_between_items = struktur_select_options()->getOptionValue( 'qodef_woo_product_list_columns_space' );
		
		if ( ! empty( $woo_space_between_items ) ) {
			$classes[] = 'qodef-woo-' . $woo_space_between_items . '-space';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woocommerce_columns_space_class' );
}

if ( ! function_exists( 'struktur_select_woocommerce_pl_info_position_class' ) ) {
	function struktur_select_woocommerce_pl_info_position_class( $classes ) {
		$info_position       = struktur_select_options()->getOptionValue( 'qodef_woo_product_list_info_position' );
		$info_position_class = '';
		
		if ( $info_position === 'info_below_image' ) {
			$info_position_class = 'qodef-woo-pl-info-below-image';
		} else if ( $info_position === 'info_on_image_hover' ) {
			$info_position_class = 'qodef-woo-pl-info-on-image-hover';
		}
		
		$classes[] = $info_position_class;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woocommerce_pl_info_position_class' );
}

if ( ! function_exists( 'struktur_select_add_woocommerce_shortcode_class' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function struktur_select_add_woocommerce_shortcode_class( $classes ) {
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);
		
		foreach ( $woocommerce_shortcodes as $woocommerce_shortcode ) {
			$has_shortcode = struktur_select_has_shortcode( $woocommerce_shortcode );
			
			if ( $has_shortcode ) {
				$classes[] = 'qodef-woocommerce-page woocommerce-account qodef-' . str_replace( '_', '-', $woocommerce_shortcode );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_add_woocommerce_shortcode_class' );
}

if ( ! function_exists( 'struktur_select_woo_single_product_thumb_position_class' ) ) {
	function struktur_select_woo_single_product_thumb_position_class( $classes ) {
		$product_thumbnail_position = struktur_select_get_meta_field_intersect( 'woo_set_thumb_images_position' );
		
		if ( ! empty( $product_thumbnail_position ) ) {
			$classes[] = 'qodef-woo-single-thumb-' . $product_thumbnail_position;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woo_single_product_thumb_position_class' );
}

if ( ! function_exists( 'struktur_select_woo_single_product_has_zoom_class' ) ) {
	function struktur_select_woo_single_product_has_zoom_class( $classes ) {
		$zoom_maginifier = struktur_select_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );
		
		if ( $zoom_maginifier === 'yes' ) {
			$classes[] = 'qodef-woo-single-has-zoom';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woo_single_product_has_zoom_class' );
}

if ( ! function_exists( 'struktur_select_woo_single_product_has_zoom_support' ) ) {
	function struktur_select_woo_single_product_has_zoom_support() {
		$zoom_maginifier = struktur_select_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );
		
		if ( $zoom_maginifier === 'yes' ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
	}
	
	add_action( 'init', 'struktur_select_woo_single_product_has_zoom_support' );
}

if ( ! function_exists( 'struktur_select_woo_single_product_image_behavior_class' ) ) {
	function struktur_select_woo_single_product_image_behavior_class( $classes ) {
		$image_behavior = struktur_select_get_meta_field_intersect( 'woo_set_single_images_behavior' );
		
		if ( ! empty( $image_behavior ) ) {
			$classes[] = 'qodef-woo-single-has-' . $image_behavior;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_woo_single_product_image_behavior_class' );
}

if ( ! function_exists( 'struktur_select_woo_single_product_photo_swipe_support' ) ) {
	function struktur_select_woo_single_product_photo_swipe_support() {
		$image_behavior = struktur_select_get_meta_field_intersect( 'woo_set_single_images_behavior' );
		
		if ( $image_behavior === 'photo-swipe' ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
	
	add_action( 'init', 'struktur_select_woo_single_product_photo_swipe_support' );
}

if ( ! function_exists( 'struktur_select_woocommerce_products_per_page' ) ) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function struktur_select_woocommerce_products_per_page() {
		$products_per_page_meta = struktur_select_options()->getOptionValue( 'qodef_woo_products_per_page' );
		$products_per_page      = ! empty( $products_per_page_meta ) ? intval( $products_per_page_meta ) : 12;
		
		return $products_per_page;
	}
	
	add_filter('loop_shop_per_page', 'struktur_select_woocommerce_products_per_page', 20);
}

if ( ! function_exists( 'struktur_select_woocommerce_related_products_args' ) ) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 *
	 * @param $args array array of args for the query
	 *
	 * @return mixed array of changed args
	 */
	function struktur_select_woocommerce_related_products_args( $args ) {
		$related = struktur_select_options()->getOptionValue( 'qodef_woo_related_products_columns' );
		
		if ( ! empty( $related ) ) {
			switch ( $related ) {
				case 'qodef-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'qodef-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 4;
		}
		
		return $args;
	}
	
	add_filter('woocommerce_output_related_products_args', 'struktur_select_woocommerce_related_products_args');
}

if ( ! function_exists( 'struktur_select_woocommerce_product_thumbnail_column_size' ) ) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function struktur_select_woocommerce_product_thumbnail_column_size() {
		$thumbs_number_meta = struktur_select_options()->getOptionValue( 'woo_number_of_thumb_images' );
		$thumbs_number      = ! empty ( $thumbs_number_meta ) ? intval( $thumbs_number_meta ) : 4;
		
		return apply_filters( 'struktur_select_filter_number_of_thumbnails_per_row_single_product', $thumbs_number );
	}
	
	add_filter( 'woocommerce_product_thumbnails_columns', 'struktur_select_woocommerce_product_thumbnail_column_size', 10 );
}

if ( ! function_exists( 'struktur_select_set_single_product_thumbnails_size' ) ) {
	function struktur_select_set_single_product_thumbnails_size( $size ) {
		return apply_filters( 'struktur_select_filter_woocommerce_gallery_thumbnail_size', 'woocommerce_thumbnail' );
	}
	
	add_filter( 'woocommerce_gallery_thumbnail_size', 'struktur_select_set_single_product_thumbnails_size' );
}

if ( ! function_exists( 'struktur_select_woocommerce_template_loop_product_title' ) ) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function struktur_select_woocommerce_template_loop_product_title() {
		$tag = struktur_select_options()->getOptionValue( 'qodef_products_list_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h5';
		}
		
		the_title( '<' . $tag . ' class="qodef-product-list-title"><a href="' . get_the_permalink() . '">', '</a></' . $tag . '>' );
	}
}

if ( ! function_exists( 'struktur_select_woocommerce_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function struktur_select_woocommerce_template_single_title() {
		$tag = struktur_select_options()->getOptionValue( 'qodef_single_product_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h1';
		}
		
		the_title( '<' . $tag . '  itemprop="name" class="qodef-single-product-title">', '</' . $tag . '>' );
	}
}

if ( ! function_exists( 'struktur_select_woocommerce_sale_flash' ) ) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function struktur_select_woocommerce_sale_flash() {
		global $product;
		
		if ( ! empty( $product ) ) {
			return '<span class="qodef-onsale">' . struktur_select_get_woocommerce_sale( $product ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_sale_flash', 'struktur_select_woocommerce_sale_flash' );
}

if ( ! function_exists( 'struktur_select_woocommerce_product_out_of_stock' ) ) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function struktur_select_woocommerce_product_out_of_stock() {
		global $product;
		
		if ( ! $product->is_in_stock() ) {
			print '<span class="qodef-sold">' . esc_html__( 'Sold', 'struktur' ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_product_thumbnails', 'struktur_select_woocommerce_product_out_of_stock', 20 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'struktur_select_woocommerce_product_out_of_stock', 10 );
}

if ( ! function_exists( 'struktur_select_woocommerce_new_flash' ) ) {
	/**
	 * Function for adding new flash template
	 *
	 * @return string
	 */
	function struktur_select_woocommerce_new_flash() {
		$new = get_post_meta( get_the_ID(), 'qodef_show_new_sign_woo_meta', true );
		
		if ( $new === 'yes' ) {
			print '<span class="qodef-new-product">' . esc_html__( 'New', 'struktur' ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_product_thumbnails', 'struktur_select_woocommerce_new_flash', 21 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'struktur_select_woocommerce_new_flash', 11 );
}

if ( ! function_exists( 'struktur_select_single_product_content_additional_tag_before' ) ) {
	function struktur_select_single_product_content_additional_tag_before() {
		
		print '<div class="qodef-single-product-content">';
	}
}

if ( ! function_exists( 'struktur_select_single_product_content_additional_tag_after' ) ) {
	function struktur_select_single_product_content_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'struktur_select_single_product_summary_additional_tag_before' ) ) {
	function struktur_select_single_product_summary_additional_tag_before() {
		
		print '<div class="qodef-single-product-summary">';
	}
}

if ( ! function_exists( 'struktur_select_single_product_summary_additional_tag_after' ) ) {
	function struktur_select_single_product_summary_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'struktur_select_pl_holder_additional_tag_before' ) ) {
	function struktur_select_pl_holder_additional_tag_before() {
		
		print '<div class="qodef-pl-main-holder">';
	}
}

if ( ! function_exists( 'struktur_select_pl_holder_additional_tag_after' ) ) {
	function struktur_select_pl_holder_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'struktur_select_pl_inner_additional_tag_before' ) ) {
	function struktur_select_pl_inner_additional_tag_before() {
		
		print '<div class="qodef-pl-inner">';
	}
}

if ( ! function_exists( 'struktur_select_pl_inner_additional_tag_after' ) ) {
	function struktur_select_pl_inner_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'struktur_select_pl_image_additional_tag_before' ) ) {
	function struktur_select_pl_image_additional_tag_before() {
		
		print '<div class="qodef-pl-image">';
	}
}

if ( ! function_exists( 'struktur_select_pl_image_additional_tag_after' ) ) {
	function struktur_select_pl_image_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'struktur_select_pl_inner_text_additional_tag_before' ) ) {
	function struktur_select_pl_inner_text_additional_tag_before() {
		
		print '<div class="qodef-pl-text"><div class="qodef-pl-text-outer"><div class="qodef-pl-text-inner">';
	}
}

if ( ! function_exists( 'struktur_select_pl_inner_text_additional_tag_after' ) ) {
	function struktur_select_pl_inner_text_additional_tag_after() {
		
		print '</div></div></div>';
	}
}

if ( ! function_exists( 'struktur_select_pl_text_wrapper_additional_tag_before' ) ) {
	function struktur_select_pl_text_wrapper_additional_tag_before() {
		
		print '<div class="qodef-pl-text-wrapper">';
	}
}

if ( ! function_exists( 'struktur_select_pl_text_wrapper_additional_tag_after' ) ) {
	function struktur_select_pl_text_wrapper_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'struktur_select_pl_rating_additional_tag_before' ) ) {
	function struktur_select_pl_rating_additional_tag_before() {
		global $product;
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
			
			if ( $rating_html !== '' ) {
				print '<div class="qodef-pl-rating-holder">';
			}
		}
	}
}

if ( ! function_exists( 'struktur_select_pl_rating_additional_tag_after' ) ) {
	function struktur_select_pl_rating_additional_tag_after() {
		global $product;
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
			
			if ( $rating_html !== '' ) {
				print '</div>';
			}
		}
	}
}

if ( ! function_exists( 'struktur_select_woocommerce_share' ) ) {
	/**
	 * Function that social share for product page
	 *
	 * @see struktur_select_get_social_share_html - available params type, icon_type and title
	 *
	 * Return social share html
	 */
	function struktur_select_woocommerce_share() {
		if ( struktur_select_is_plugin_installed( 'core' ) && struktur_select_options()->getOptionValue( 'enable_social_share' ) == 'yes' && struktur_select_options()->getOptionValue( 'enable_social_share_on_product' ) == 'yes' ) :
			echo '<div class="qodef-woo-social-share-holder">';
			echo struktur_select_get_social_share_html( array( 'type' => 'list', 'title' => esc_attr__('Share:', 'struktur') ) );
			echo '</div>';
		endif;
	}
}

if ( ! function_exists( 'struktur_select_woocommerce_single_product_title' ) ) {
	/**
	 * Function that checks option for single product title and overrides it with filter
	 */
	function struktur_select_woocommerce_single_product_title( $show_title_area ) {
		if ( is_singular( 'product' ) ) {
			$woo_title_meta = get_post_meta( get_the_ID(), 'qodef_show_title_area_woo_meta', true );
			
			if ( empty( $woo_title_meta ) ) {
				$woo_title_main = struktur_select_options()->getOptionValue( 'show_title_area_woo' );
				
				if ( ! empty( $woo_title_main ) ) {
					$show_title_area = $woo_title_main == 'yes';
				}
			} else {
				$show_title_area = $woo_title_meta == 'yes';
			}
		}
		
		return $show_title_area;
	}
	
	add_filter( 'struktur_select_filter_show_title_area', 'struktur_select_woocommerce_single_product_title' );
}

if ( ! function_exists( 'struktur_select_set_title_text_output_for_woocommerce' ) ) {
	function struktur_select_set_title_text_output_for_woocommerce( $title ) {
		
		if ( struktur_select_is_woo_archive_page() ) {
			global $wp_query;
			
			$tax            = $wp_query->get_queried_object();
			$category_title = $tax->name;
			$title          = $category_title;
		} elseif ( struktur_select_is_woocommerce_shop() ) {
			$shop_id = struktur_select_get_woo_shop_page_id();
			$title   = $shop_id !== -1 ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'struktur' );
		}
		
		return $title;
	}
	
	add_filter( 'struktur_select_filter_title_text', 'struktur_select_set_title_text_output_for_woocommerce' );
}

if ( ! function_exists( 'struktur_select_set_breadcrumbs_output_for_woocommerce' ) ) {
	function struktur_select_set_breadcrumbs_output_for_woocommerce( $childContent, $delimiter, $before, $after ) {
		$shop_id = struktur_select_get_woo_shop_page_id();
		
		if ( struktur_select_is_woo_archive_page() ) {
			$childContent = '';
			
			if ( ! empty( $shop_id ) && $shop_id !== -1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}
			
			$qodef_taxonomy_id        = get_queried_object_id();
			$qodef_taxonomy_type      = is_tax( 'product_tag' ) ? 'product_tag' : 'product_cat';
			$qodef_taxonomy           = ! empty( $qodef_taxonomy_id ) ? get_term_by( 'id', $qodef_taxonomy_id, $qodef_taxonomy_type ) : '';
			$qodef_taxonomy_parent_id = isset( $qodef_taxonomy->parent ) && $qodef_taxonomy->parent !== 0 ? $qodef_taxonomy->parent : '';
			$qodef_taxonomy_parent    = $qodef_taxonomy_parent_id !== '' ? get_term_by( 'id', $qodef_taxonomy_parent_id, $qodef_taxonomy_type ) : '';
			
			if ( ! empty( $qodef_taxonomy_parent ) ) {
				$childContent .= '<a itemprop="url" href="' . get_term_link( $qodef_taxonomy_parent->term_id ) . '">' . $qodef_taxonomy_parent->name . '</a>' . $delimiter;
			}
			
			if ( ! empty( $qodef_taxonomy ) ) {
				$childContent .= $before . esc_attr( $qodef_taxonomy->name ) . $after;
			}
			
		} elseif ( is_singular( 'product' ) ) {
			$childContent = '';
			$product      = wc_get_product( get_the_ID() );
			$categories   = ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), ', ' ) : '';
			
			if ( ! empty( $shop_id ) && $shop_id !== -1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}
			
			if ( ! empty( $categories ) ) {
				$childContent .= $categories . $delimiter;
			}
			
			$childContent .= $before . get_the_title() . $after;
			
		} elseif ( struktur_select_is_woocommerce_shop() ) {
			$childContent = $before . get_the_title( $shop_id ) . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'struktur_select_filter_breadcrumbs_title_child_output', 'struktur_select_set_breadcrumbs_output_for_woocommerce', 10, 4 );
}

if ( ! function_exists( 'struktur_select_set_sidebar_layout_for_woocommerce' ) ) {
	function struktur_select_set_sidebar_layout_for_woocommerce( $sidebar_layout ) {
		
		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_layout = struktur_select_get_meta_field_intersect( 'sidebar_layout', struktur_select_get_woo_shop_page_id() );
		}
		
		return $sidebar_layout;
	}
	
	add_filter( 'struktur_select_filter_sidebar_layout', 'struktur_select_set_sidebar_layout_for_woocommerce' );
}

if ( ! function_exists( 'struktur_select_set_sidebar_name_for_woocommerce' ) ) {
	function struktur_select_set_sidebar_name_for_woocommerce( $sidebar_name ) {
		
		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_name = struktur_select_get_meta_field_intersect( 'custom_sidebar_area', struktur_select_get_woo_shop_page_id() );
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'struktur_select_filter_sidebar_name', 'struktur_select_set_sidebar_name_for_woocommerce' );
}