<?php

if ( ! function_exists( 'struktur_select_get_hide_dep_for_header_menu_area_meta_boxes' ) ) {
	function struktur_select_get_hide_dep_for_header_menu_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'struktur_select_filter_header_menu_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'struktur_select_header_menu_area_meta_options_map' ) ) {
	function struktur_select_header_menu_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = struktur_select_get_hide_dep_for_header_menu_area_meta_boxes();
		
		$menu_area_container = struktur_select_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'menu_area_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta' => $hide_dep_options
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		struktur_select_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'struktur' )
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_menu_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area In Grid', 'struktur' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'struktur' ),
				'parent'        => $menu_area_container,
				'default_value' => '',
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		$menu_area_in_grid_container = struktur_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_in_grid_container',
				'parent'          => $menu_area_container,
				'dependency' => array(
					'show' => array(
						'qodef_menu_area_in_grid_meta'  => 'yes'
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_menu_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'struktur' ),
				'description' => esc_html__( 'Set grid background color for menu area', 'struktur' ),
				'parent'      => $menu_area_in_grid_container
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_menu_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'struktur' ),
				'description' => esc_html__( 'Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'struktur' ),
				'parent'      => $menu_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_menu_area_in_grid_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Shadow', 'struktur' ),
				'description'   => esc_html__( 'Set shadow on grid menu area', 'struktur' ),
				'parent'        => $menu_area_in_grid_container,
				'default_value' => '',
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_menu_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'struktur' ),
				'description'   => esc_html__( 'Set border on grid menu area', 'struktur' ),
				'parent'        => $menu_area_in_grid_container,
				'default_value' => '',
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		$menu_area_in_grid_border_container = struktur_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_in_grid_border_container',
				'parent'          => $menu_area_in_grid_container,
				'dependency' => array(
					'show' => array(
						'qodef_menu_area_in_grid_border_meta'  => 'yes'
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_menu_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'struktur' ),
				'description' => esc_html__( 'Set border color for grid area', 'struktur' ),
				'parent'      => $menu_area_in_grid_border_container
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_menu_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'struktur' ),
				'description' => esc_html__( 'Choose a background color for menu area', 'struktur' ),
				'parent'      => $menu_area_container
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_menu_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'struktur' ),
				'description' => esc_html__( 'Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'struktur' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_menu_area_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area Shadow', 'struktur' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'struktur' ),
				'parent'        => $menu_area_container,
				'default_value' => '',
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_menu_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area Border', 'struktur' ),
				'description'   => esc_html__( 'Set border on menu area', 'struktur' ),
				'parent'        => $menu_area_container,
				'default_value' => '',
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		$menu_area_border_bottom_color_container = struktur_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_border_bottom_color_container',
				'parent'          => $menu_area_container,
				'dependency' => array(
					'show' => array(
						'qodef_menu_area_border_meta'  => 'yes'
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_menu_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'struktur' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'struktur' ),
				'parent'      => $menu_area_border_bottom_color_container
			)
		);

		struktur_select_create_meta_box_field(
			array(
				'type'        => 'text',
				'name'        => 'qodef_menu_area_height_meta',
				'label'       => esc_html__( 'Height', 'struktur' ),
				'description' => esc_html__( 'Enter header height', 'struktur' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => esc_html__( 'px', 'struktur' )
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'type'        => 'text',
				'name'        => 'qodef_menu_area_side_padding_meta',
				'label'       => esc_html__( 'Menu Area Side Padding', 'struktur' ),
				'description' => esc_html__( 'Enter value in px or percentage to define menu area side padding', 'struktur' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => esc_html__( 'px or %', 'struktur' )
				)
			)
		);
		
		do_action( 'struktur_select_header_menu_area_additional_meta_boxes_map', $menu_area_container );
	}
	
	add_action( 'struktur_select_action_header_menu_area_meta_boxes_map', 'struktur_select_header_menu_area_meta_options_map', 10, 1 );
}