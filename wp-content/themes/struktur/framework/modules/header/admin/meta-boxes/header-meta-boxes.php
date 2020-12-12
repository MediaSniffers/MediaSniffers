<?php

if ( ! function_exists( 'struktur_select_header_types_meta_boxes' ) ) {
	function struktur_select_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'struktur_select_filter_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'struktur' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'struktur_select_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function struktur_select_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'struktur_select_filter_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'struktur_select_map_header_meta' ) ) {
	function struktur_select_map_header_meta() {
		$header_type_meta_boxes              = struktur_select_header_types_meta_boxes();
		$header_behavior_meta_boxes_hide_dep = struktur_select_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => apply_filters( 'struktur_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'header_meta' ),
				'title' => esc_html__( 'Header', 'struktur' ),
				'name'  => 'header_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'struktur' ),
				'description'   => esc_html__( 'Select header type layout', 'struktur' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'struktur' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'struktur' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'struktur' ),
					'light-header' => esc_html__( 'Light', 'struktur' ),
					'dark-header'  => esc_html__( 'Dark', 'struktur' )
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'qodef_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'struktur' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'struktur' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'struktur' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'struktur' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'struktur' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'struktur' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'struktur' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
					)
				)
			)
		);
		
		//additional area
		do_action( 'struktur_select_action_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'struktur_select_action_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'struktur_select_action_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'struktur_select_action_header_menu_area_meta_boxes_map', $header_meta_box );

		//mobile menu
		do_action( 'struktur_select_action_header_mobile_menu_meta_boxes_map', $header_meta_box );

		//dropdown
		do_action( 'struktur_select_action_dropdown_meta_boxes_map', $header_meta_box );

		//widget areaa
		do_action( 'struktur_select_action_header_widget_areas_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_header_meta', 50 );
}