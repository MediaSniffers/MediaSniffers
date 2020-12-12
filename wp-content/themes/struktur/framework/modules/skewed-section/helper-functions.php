<?php

if ( ! function_exists( 'struktur_select_skewed_section_additional_class' ) ) {
	/**
	 * Loads html for skew section additional class
	 *
	 * @param $classes
	 * @param $atts
	 *
	 * @return mixed
	 */
	function struktur_select_skewed_section_additional_class( $classes, $atts ) {
		if ( isSet( $atts['enable_skewed_section_effect'] ) && $atts['enable_skewed_section_effect'] === 'yes' ) {
			$classes[] = 'qodef-has-skewed-section-effect';
		}
		
		return $classes;
	}
	
	add_filter( 'struktur_select_filter_vc_css_classes', 'struktur_select_skewed_section_additional_class', 10, 2 );
}

if ( ! function_exists( 'struktur_select_disable_skewed_section_on_mobile_class' ) ) {
	/**
	 * Insert class into body tag to disable skewed section on mobile
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function struktur_select_disable_skewed_section_on_mobile_class( $classes ) {
		$disable_skew_section_on_mobile = struktur_select_options()->getOptionValue( 'disable_skewed_section_on_mobile' );
		
		if ( $disable_skew_section_on_mobile === 'yes' ) {
			$classes[] = 'qodef-disable-ss-on-mobile';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_disable_skewed_section_on_mobile_class' );
}

if ( ! function_exists( 'struktur_select_disable_title_skewed_section_on_mobile_class' ) ) {
	/**
	 * Insert class into body tag to disable title skewed section on mobile
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function struktur_select_disable_title_skewed_section_on_mobile_class( $classes ) {
		$disable_skew_section_on_mobile = struktur_select_options()->getOptionValue( 'disable_title_skewed_section_on_mobile' );
		
		if ( $disable_skew_section_on_mobile === 'yes' ) {
			$classes[] = 'qodef-disable-title-ss-on-mobile';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_disable_title_skewed_section_on_mobile_class' );
}

if ( ! function_exists( 'struktur_select_disable_header_skewed_section_on_mobile_class' ) ) {
	/**
	 * Insert class into body tag to disable header skewed section on mobile
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function struktur_select_disable_header_skewed_section_on_mobile_class( $classes ) {
		$disable_skew_section_on_mobile = struktur_select_options()->getOptionValue( 'disable_header_skewed_section_on_mobile' );
		
		if ( $disable_skew_section_on_mobile === 'yes' ) {
			$classes[] = 'qodef-disable-header-ss-on-mobile';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'struktur_select_disable_header_skewed_section_on_mobile_class' );
}

if ( ! function_exists( 'struktur_select_skewed_section_default_svg' ) ) {
	/**
	 * Loads default svg
	 *
	 * @return mixed
	 */
	function struktur_select_skewed_section_default_svg() {
		$svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 120 120" enable-background="new 0 0 120 120" width="100%" height="120" xml:space="preserve">
				<polygon points="0,0 0,120 120,0"></polygon></svg>';
		
		if ( struktur_select_options()->getOptionValue( 'skewed_section_general_svg_path' ) !== '' ) {
			$svg = struktur_select_options()->getOptionValue( 'skewed_section_general_svg_path' );
		}
		
		return $svg;
	}
}