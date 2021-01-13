<?php

if ( ! function_exists( 'struktur_core_add_portfolio_category_list_shortcode' ) ) {
	function struktur_core_add_portfolio_category_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'StrukturCore\CPT\Shortcodes\PortfolioCategoryList\PortfolioCategoryList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'struktur_core_filter_add_vc_shortcode', 'struktur_core_add_portfolio_category_list_shortcode' );
}

if ( ! function_exists( 'struktur_core_set_portfolio_category_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio category list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function struktur_core_set_portfolio_category_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-category-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'struktur_core_filter_add_vc_shortcodes_custom_icon_class', 'struktur_core_set_portfolio_category_list_icon_class_name_for_vc_shortcodes' );
}