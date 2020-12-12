<?php

if ( ! function_exists( 'struktur_select_get_hide_dep_for_breadcrumbs_title_meta_boxes' ) ) {
	function struktur_select_get_hide_dep_for_breadcrumbs_title_meta_boxes() {
		$hide_dep_options = apply_filters( 'struktur_select_filter_breadcrumbs_title_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'struktur_select_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function struktur_select_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
	    $hide_dep_options = struktur_select_get_hide_dep_for_breadcrumbs_title_meta_boxes();
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'struktur' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'struktur' ),
				'parent'      => $show_title_area_meta_container,
                'dependency'  => array(
                    'hide' => array(
                        'qodef_title_area_type_meta' => $hide_dep_options
                    )
                )
			)
		);
	}
	
	add_action( 'struktur_select_action_additional_title_area_meta_boxes', 'struktur_select_breadcrumbs_title_type_options_meta_boxes' );
}