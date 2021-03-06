<?php

if ( ! function_exists( 'struktur_select_logo_meta_box_map' ) ) {
	function struktur_select_logo_meta_box_map() {
		
		$logo_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => apply_filters( 'struktur_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'struktur' ),
				'name'  => 'logo_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'struktur' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'struktur' ),
				'parent'      => $logo_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'struktur' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'struktur' ),
				'parent'      => $logo_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'struktur' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'struktur' ),
				'parent'      => $logo_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'struktur' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'struktur' ),
				'parent'      => $logo_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'struktur' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'struktur' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_logo_meta_box_map', 47 );
}