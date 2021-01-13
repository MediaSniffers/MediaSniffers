<?php

if ( ! function_exists( 'struktur_core_map_testimonials_meta' ) ) {
	function struktur_core_map_testimonials_meta() {
		$testimonial_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'struktur-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'struktur-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'struktur-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'struktur-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'struktur-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'struktur-core' ),
				'description' => esc_html__( 'Enter author name', 'struktur-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'struktur-core' ),
				'description' => esc_html__( 'Enter author job position', 'struktur-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_core_map_testimonials_meta', 95 );
}