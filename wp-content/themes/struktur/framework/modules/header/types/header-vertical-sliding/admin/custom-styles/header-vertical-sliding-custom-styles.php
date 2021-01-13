<?php

if ( ! function_exists( 'struktur_select_vertical_sliding_menu_styles' ) ) {
	function struktur_select_vertical_sliding_menu_styles() {
		$vertical_header_styles = array();
		
		$vertical_header_selectors = array(
			'.qodef-header-vertical-sliding .qodef-vertical-menu-area .qodef-vertical-area-background'
		);
		
		$vertical_background_color = struktur_select_options()->getOptionValue( 'vertical_header_background_color' );
		$vertical_background_image = struktur_select_options()->getOptionValue( 'vertical_header_background_image' );
		$vertical_shadow_enabled   = struktur_select_options()->getOptionValue( 'vertical_header_shadow' );
		$vertical_border_enabled   = struktur_select_options()->getOptionValue( 'vertical_header_border' );
		
		if ( ! empty( $vertical_background_color ) ) {
			$vertical_header_styles['background-color'] = $vertical_background_color;
		}
		
		if ( ! empty( $vertical_background_image ) ) {
			$vertical_header_styles['background-image'] = 'url(' . esc_url( $vertical_background_image ) . ')';
		}
		
		if ( $vertical_shadow_enabled === 'yes' ) {
			$vertical_header_styles['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}
		
		if ( $vertical_border_enabled === 'yes' ) {
			$header_border_color = struktur_select_options()->getOptionValue( 'vertical_header_border_color' );
			
			if ( ! empty( $header_border_color ) ) {
				$vertical_header_styles['border-right'] = '1px solid ' . $header_border_color;
			}
		}
		
		echo struktur_select_dynamic_css( $vertical_header_selectors, $vertical_header_styles );
	}
	
	add_action( 'struktur_select_action_style_dynamic', 'struktur_select_vertical_sliding_menu_styles' );
}

if ( ! function_exists( 'struktur_select_vertical_sliding_main_menu_styles' ) ) {
	/**
	 * Generates styles for vertical main main menu
	 */
	function struktur_select_vertical_sliding_main_menu_styles() {
		$logo_section_styles = array();
		$widget_section_styles = array();

		$menu_top_margin    = struktur_select_options()->getOptionValue( 'vertical_menu_top_margin' );
		$menu_bottom_margin = struktur_select_options()->getOptionValue( 'vertical_menu_bottom_margin' );
		
		if ( ! empty( $menu_top_margin ) ) {
            $logo_section_styles['padding-top'] = struktur_select_filter_px( $menu_top_margin ) . 'px';
		}
		if ( ! empty( $menu_bottom_margin ) ) {
            $widget_section_styles['bottom'] = struktur_select_filter_px( $menu_bottom_margin ) . 'px';
		}

        $logo_section_selector = array(
			'.qodef-header-vertical-sliding .qodef-logo-wrapper'
		);
        $widget_section_selector = array(
            '.qodef-header-vertical-sliding .qodef-vertical-area-widget-holder'
        );
		
		echo struktur_select_dynamic_css( $logo_section_selector, $logo_section_styles );
		echo struktur_select_dynamic_css( $widget_section_selector, $widget_section_styles );

		// vertical menu 1st level style
		
		$first_level_styles = struktur_select_get_typography_styles( 'vertical_menu_1st' );
		
		$first_level_selector = array(
                '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu > ul > li > a'
		);
		
		echo struktur_select_dynamic_css( $first_level_selector, $first_level_styles );
		
		$first_level_hover_styles = array();
		
		$first_level_hover_color = struktur_select_options()->getOptionValue( 'vertical_menu_1st_hover_color' );
		if ( ! empty( $first_level_hover_color ) ) {
			$first_level_hover_styles['color'] = $first_level_hover_color;
		}
		
		$first_level_hover_selector = array(
			'.qodef-header-vertical-sliding nav.qodef-fullscreen-menu > ul > li > a:hover',
			'.qodef-header-vertical-sliding nav.qodef-fullscreen-menu > ul > li > a.qodef-active-item',
			'.qodef-header-vertical-sliding nav.qodef-fullscreen-menu > ul > li > a.current-menu-ancestor'
		);
		
		echo struktur_select_dynamic_css( $first_level_hover_selector, $first_level_hover_styles );
		
		// vertical menu 2nd level style
		
		$second_level_styles = struktur_select_get_typography_styles( 'vertical_menu_2nd' );
		
		$second_level_selector = array(
			'.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li a'
		);
		
		echo struktur_select_dynamic_css( $second_level_selector, $second_level_styles );
		
		$second_level_hover_styles = array();
		
		$second_level_hover_color = struktur_select_options()->getOptionValue( 'vertical_menu_2nd_hover_color' );
		if ( ! empty( $second_level_hover_color ) ) {
			$second_level_hover_styles['color'] = $second_level_hover_color;
		}
		
		$second_level_hover_selector = array(
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li a:hover',
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li.current-menu-ancestor > a',
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li.current-menu-item > a'
		);
		
		echo struktur_select_dynamic_css( $second_level_hover_selector, $second_level_hover_styles );
		
		// vertical menu 3rd level style
		
		$third_level_styles = struktur_select_get_typography_styles( 'vertical_menu_3rd' );
		
		$third_level_selector = array(
			'.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li ul li a'
		);
		
		echo struktur_select_dynamic_css( $third_level_selector, $third_level_styles );
		
		
		$third_level_hover_styles = array();
		
		$third_level_hover_color = struktur_select_options()->getOptionValue( 'vertical_menu_3rd_hover_color' );
		if ( ! empty( $third_level_hover_color ) ) {
			$third_level_hover_styles['color'] = $third_level_hover_color;
		}
		
		$third_level_hover_selector = array(
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li ul li a:hover',
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li ul li.current-menu-ancestor > a',
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li ul li.current-menu-item > a'
		);
		
		echo struktur_select_dynamic_css( $third_level_hover_selector, $third_level_hover_styles );
	}
	
	add_action( 'struktur_select_action_style_dynamic', 'struktur_select_vertical_sliding_main_menu_styles' );
}

if ( ! function_exists( 'struktur_select_vertical_sliding_icon_styles' ) ) {
	function struktur_select_vertical_sliding_icon_styles() {
		$icon_color       = struktur_select_options()->getOptionValue( 'vertical_sliding_icon_color' );
		$icon_hover_color = struktur_select_options()->getOptionValue( 'vertical_sliding_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.qodef-vertical-menu-opener a:hover'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo struktur_select_dynamic_css( '.qodef-vertical-menu-opener a', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo struktur_select_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
	}
	
	add_action( 'struktur_select_action_style_dynamic', 'struktur_select_vertical_sliding_icon_styles' );
}