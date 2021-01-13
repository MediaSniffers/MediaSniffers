<?php

if ( ! function_exists( 'struktur_select_get_hide_dep_for_header_standard_options' ) ) {
	function struktur_select_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'struktur_select_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'struktur_select_header_standard_map' ) ) {
	function struktur_select_header_standard_map( $parent ) {
		$hide_dep_options = struktur_select_get_hide_dep_for_header_standard_options();
		
		struktur_select_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'struktur' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'struktur' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'struktur' ),
					'left'   => esc_html__( 'Left', 'struktur' ),
					'center' => esc_html__( 'Center', 'struktur' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_additional_header_menu_area_options_map', 'struktur_select_header_standard_map' );
}