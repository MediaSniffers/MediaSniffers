<?php

if ( ! function_exists( 'struktur_select_map_post_link_meta' ) ) {
	function struktur_select_map_post_link_meta() {
		$link_post_format_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'struktur' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'struktur' ),
				'description' => esc_html__( 'Enter link', 'struktur' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_post_link_meta', 24 );
}