<?php

if ( ! function_exists( 'struktur_select_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function struktur_select_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'struktur_select_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function struktur_select_get_dropdown_cart_icon_class() {
		$classes = array(
			'qodef-header-cart'
		);
		
		$classes[] = struktur_select_get_icon_sources_class( 'dropdown_cart', 'qodef-header-cart' );
		
		return implode( ' ', $classes );
	}
}