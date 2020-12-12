<?php

if ( ! function_exists( 'struktur_select_mobile_header_options_map' ) ) {
	function struktur_select_mobile_header_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '_mobile_header',
				'title' => esc_html__( 'Mobile Header', 'struktur' ),
				'icon'  => 'fa fa-mobile'
			)
		);
		
		$panel_mobile_header = struktur_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'struktur' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_mobile_header'
			)
		);
		
		$mobile_header_group = struktur_select_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'struktur' )
			)
		);
		
		$mobile_header_row1 = struktur_select_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'struktur' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'struktur' ),
				'parent' => $mobile_header_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'struktur' ),
				'parent' => $mobile_header_row1
			)
		);
		
		$mobile_menu_group = struktur_select_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'struktur' )
			)
		);
		
		$mobile_menu_row1 = struktur_select_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'struktur' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'struktur' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'struktur' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'struktur' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'struktur' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'struktur' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'struktur' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'name'          => 'mobile_header_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Mobile Header in Grid', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will put mobile header in grid', 'struktur' ),
				'parent'        => $panel_mobile_header,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$mobile_header_without_grid_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_header_without_grid_container',
				'dependency' => array(
					'show' => array(
						'mobile_header_in_grid' => 'no'
					)
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'name'        => 'mobile_header_without_grid_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Header Padding', 'struktur' ),
				'description' => esc_html__( 'Set padding for Mobile Header', 'struktur' ),
				'parent'      => $mobile_header_without_grid_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		struktur_select_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'struktur' )
			)
		);
		
		$first_level_group = struktur_select_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'struktur' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'struktur' )
			)
		);
		
		$first_level_row1 = struktur_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'struktur' ),
				'parent' => $first_level_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'struktur' ),
				'parent' => $first_level_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'struktur' ),
				'parent' => $first_level_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'struktur' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$first_level_row2 = struktur_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'struktur' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'struktur' ),
				'parent'  => $first_level_row2,
				'options' => struktur_select_get_text_transform_array()
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'struktur' ),
				'parent'  => $first_level_row2,
				'options' => struktur_select_get_font_style_array()
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'struktur' ),
				'parent'  => $first_level_row2,
				'options' => struktur_select_get_font_weight_array()
			)
		);
		
		$first_level_row3 = struktur_select_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'struktur' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_group = struktur_select_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'struktur' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'struktur' )
			)
		);
		
		$second_level_row1 = struktur_select_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'struktur' ),
				'parent' => $second_level_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'struktur' ),
				'parent' => $second_level_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'struktur' ),
				'parent' => $second_level_row1
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'struktur' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$second_level_row2 = struktur_select_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'struktur' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'struktur' ),
				'parent'  => $second_level_row2,
				'options' => struktur_select_get_text_transform_array()
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'struktur' ),
				'parent'  => $second_level_row2,
				'options' => struktur_select_get_font_style_array()
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'struktur' ),
				'parent'  => $second_level_row2,
				'options' => struktur_select_get_font_weight_array()
			)
		);
		
		$second_level_row3 = struktur_select_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'struktur' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		struktur_select_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Navigation Title', 'struktur' ),
				'description' => esc_html__( 'Enter title for mobile menu navigation', 'struktur' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'parent'        => $panel_mobile_header,
				'type'          => 'select',
				'name'          => 'mobile_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Mobile Navigation Icon Source', 'struktur' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'struktur' ),
				'options'       => struktur_select_get_icon_sources_array()
			)
		);

		$mobile_icon_pack_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_source' => 'icon_pack'
					)
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'parent'        => $mobile_icon_pack_container,
				'type'          => 'select',
				'name'          => 'mobile_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Mobile Navigation Icon Pack', 'struktur' ),
				'description'   => esc_html__( 'Choose icon pack for mobile navigation icon', 'struktur' ),
				'options'       => struktur_select_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$mobile_icon_svg_path_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_source' => 'svg_path'
					)
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'parent'      => $mobile_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'mobile_icon_svg_path',
				'label'       => esc_html__( 'Mobile Navigation Icon SVG Path', 'struktur' ),
				'description' => esc_html__( 'Enter your mobile navigation icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'struktur' ),
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'struktur' ),
				'parent' => $panel_mobile_header
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'struktur' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_mobile_header_options_map', struktur_select_set_options_map_position( 'mobile-header' ) );
}