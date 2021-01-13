<?php

if ( ! function_exists( 'struktur_select_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function struktur_select_dropdown_cart_icon_styles() {
		$icon_color       = struktur_select_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = struktur_select_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo struktur_select_dynamic_css( '.qodef-shopping-cart-holder .qodef-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo struktur_select_dynamic_css( '.qodef-shopping-cart-holder .qodef-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'struktur_select_action_style_dynamic', 'struktur_select_dropdown_cart_icon_styles' );
}