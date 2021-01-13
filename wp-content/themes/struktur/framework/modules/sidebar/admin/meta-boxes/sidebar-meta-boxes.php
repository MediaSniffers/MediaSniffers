<?php

if ( ! function_exists( 'struktur_select_map_sidebar_meta' ) ) {
	function struktur_select_map_sidebar_meta() {
		$qodef_sidebar_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => apply_filters( 'struktur_select_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'struktur' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'struktur' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'struktur' ),
				'parent'      => $qodef_sidebar_meta_box,
                'options'       => struktur_select_get_custom_sidebars_options( true )
			)
		);
		
		$qodef_custom_sidebars = struktur_select_get_custom_sidebars();
		if ( count( $qodef_custom_sidebars ) > 0 ) {
			struktur_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'struktur' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'struktur' ),
					'parent'      => $qodef_sidebar_meta_box,
					'options'     => $qodef_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_sidebar_meta', 31 );
}