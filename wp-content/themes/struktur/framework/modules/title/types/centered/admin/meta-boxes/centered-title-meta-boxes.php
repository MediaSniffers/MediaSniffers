<?php

if ( ! function_exists( 'struktur_select_centered_title_type_options_meta_boxes' ) ) {
	function struktur_select_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'struktur' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'struktur' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_additional_title_area_meta_boxes', 'struktur_select_centered_title_type_options_meta_boxes', 5 );
}