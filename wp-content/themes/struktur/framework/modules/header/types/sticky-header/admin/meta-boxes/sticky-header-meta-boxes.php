<?php

if ( ! function_exists( 'struktur_select_sticky_header_meta_boxes_options_map' ) ) {
	function struktur_select_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = struktur_select_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'dependency' => array(
					'hide' => array(
						'qodef_header_behaviour_meta'  => array( '', 'no-behavior','fixed-on-scroll','sticky-header-on-scroll-up' )
					)
				)
			)
		);

		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_sticky_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Sticky Header in Grid', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will put sticky header in grid', 'struktur' ),
				'parent'        => $header_meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky Header Appearance', 'struktur' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'struktur' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		$struktur_custom_sidebars = struktur_select_get_custom_sidebars();
		if ( count( $struktur_custom_sidebars ) > 0 ) {
			struktur_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sticky_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Sticky Header Menu Area', 'struktur' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header menu area"', 'struktur' ),
					'parent'      => $header_meta_box,
					'options'     => $struktur_custom_sidebars,
					'dependency' => array(
						'show' => array(
							'qodef_header_behaviour_meta' => array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' )
						)
					)
				)
			);
		}
	}
	
	add_action( 'struktur_select_action_additional_header_area_meta_boxes_map', 'struktur_select_sticky_header_meta_boxes_options_map', 8 );
}