<?php

if ( ! function_exists( 'struktur_select_map_post_quote_meta' ) ) {
	function struktur_select_map_post_quote_meta() {
		$quote_post_format_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'struktur' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'struktur' ),
				'description' => esc_html__( 'Enter Quote text', 'struktur' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'struktur' ),
				'description' => esc_html__( 'Enter Quote author', 'struktur' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_post_quote_meta', 25 );
}