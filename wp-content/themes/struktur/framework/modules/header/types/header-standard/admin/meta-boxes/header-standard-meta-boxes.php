<?php

if ( ! function_exists( 'struktur_select_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function struktur_select_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'struktur_select_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'struktur_select_header_standard_meta_map' ) ) {
	function struktur_select_header_standard_meta_map( $parent ) {
		$hide_dep_options = struktur_select_get_hide_dep_for_header_standard_meta_boxes();
		
		struktur_select_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'qodef_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'struktur' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'struktur' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'struktur' ),
					'left'   => esc_html__( 'Left', 'struktur' ),
					'right'  => esc_html__( 'Right', 'struktur' ),
					'center' => esc_html__( 'Center', 'struktur' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_additional_header_area_meta_boxes_map', 'struktur_select_header_standard_meta_map' );
}