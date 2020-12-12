<?php

if ( ! function_exists( 'struktur_select_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function struktur_select_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$masonry_layout = struktur_select_get_meta_field_intersect( 'blog_masonry_layout' );
		if ( $masonry_layout === 'in-grid' ) {
			$params_list['holder'] = 'qodef-container';
			$params_list['inner']  = 'qodef-container-inner clearfix';
		} else {
			$params_list['holder'] = 'qodef-full-width';
			$params_list['inner']  = 'qodef-full-width-inner';
		}
		
		return $params_list;
	}
	
	add_filter( 'struktur_select_filter_blog_holder_params', 'struktur_select_get_blog_holder_params' );
}

if ( ! function_exists( 'struktur_select_get_blog_list_classes' ) ) {
	/**
	 * Function that generates blog list holder classes for blog list templates
	 */
	function struktur_select_get_blog_list_classes( $classes ) {
		$list_classes   = array();
		$list_classes[] = 'qodef-grid-list qodef-grid-masonry-list';
		
		$number_of_columns = struktur_select_get_meta_field_intersect( 'blog_masonry_number_of_columns' );
		if ( ! empty( $number_of_columns ) ) {
			$list_classes[] = 'qodef-' . $number_of_columns . '-columns';
		}
		
		$list_classes[] = 'qodef-blog-no-space';
		
		$masonry_layout = struktur_select_get_meta_field_intersect( 'blog_masonry_layout' );
		$list_classes[] = 'qodef-blog-masonry-' . $masonry_layout;
		
		$masonry_type = struktur_select_get_meta_field_intersect( 'blog_list_featured_image_proportion' );
		if ( ! empty( $masonry_type ) ) {
			$list_classes[] = 'qodef-'.$masonry_type.'-masonry-items';
		}
		
		$classes = array_merge( $classes, $list_classes );
		
		return $classes;
	}
	
	add_filter( 'struktur_select_filter_blog_list_classes', 'struktur_select_get_blog_list_classes' );
}

if ( ! function_exists( 'struktur_select_blog_part_params' ) ) {
	function struktur_select_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h4';
		$part_params['link_tag']  = 'h4';
		$part_params['quote_tag'] = 'h4';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'struktur_select_filter_blog_part_params', 'struktur_select_blog_part_params' );
}