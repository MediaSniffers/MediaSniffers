<?php

foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'struktur_select_title_area_typography_style' ) ) {
	function struktur_select_title_area_typography_style() {
		
		// title default/small style
		
		$item_styles = struktur_select_get_typography_styles( 'page_title' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-page-title'
		);
		
		echo struktur_select_dynamic_css( $item_selector, $item_styles );
		
		// subtitle style
		
		$item_styles = struktur_select_get_typography_styles( 'page_subtitle' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-page-subtitle'
		);
		
		echo struktur_select_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'struktur_select_action_style_dynamic', 'struktur_select_title_area_typography_style' );
}


if ( ! function_exists( 'struktur_select_page_title_area_mobile_style' ) ) {
	function struktur_select_page_title_area_mobile_style($style) {

		$current_style = '';
		$page_id       = struktur_select_get_page_id();
		$class_prefix  = struktur_select_get_unique_page_class( $page_id );

		$res_start = '@media only screen and (max-width: 1024px) {';
		$res_end   = '}';
		$item_styles   = array();

		$title_responsive_width = get_post_meta( $page_id, 'qodef_title_area_height_mobile_meta', true );
		
		
		$item_selector = array(
			$class_prefix . ' .qodef-title-holder',
			$class_prefix . ' .qodef-title-holder .qodef-title-wrapper'
		);

		if ( $title_responsive_width !== '' ) {
			$item_styles['height'] = struktur_select_filter_suffix( $title_responsive_width, 'px') . 'px !important' ;
		}

		if(!empty($item_styles)) {
			$current_style .= $res_start . struktur_select_dynamic_css( $item_selector, $item_styles ) . $res_end;
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'struktur_select_filter_add_page_custom_style', 'struktur_select_page_title_area_mobile_style' );
}