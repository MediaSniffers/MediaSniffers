<?php

if ( ! function_exists( 'struktur_select_mobile_menu_meta_box_map' ) ) {
	function struktur_select_mobile_menu_meta_box_map($header_meta_box) {

		struktur_select_add_admin_section_title(
			array(
				'parent' => $header_meta_box,
				'name'   => 'header_mobile',
				'title'  => esc_html__( 'Mobile Header in Grid', 'struktur' )
			)
		);

		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_mobile_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Mobile Header in Grid', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will put mobile header in grid', 'struktur' ),
				'parent'        => $header_meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);

		$mobile_header_without_grid_container = struktur_select_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'mobile_header_without_grid_container',
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_in_grid_meta' => 'no'
					)
				)
			)
		);

		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_mobile_header_without_grid_padding_meta',
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


	}
	
	add_action( 'struktur_select_action_header_mobile_menu_meta_boxes_map', 'struktur_select_mobile_menu_meta_box_map', 10 );
}