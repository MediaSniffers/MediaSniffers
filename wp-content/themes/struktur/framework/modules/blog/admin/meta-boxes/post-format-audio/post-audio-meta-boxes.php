<?php

if ( ! function_exists( 'struktur_select_map_post_audio_meta' ) ) {
	function struktur_select_map_post_audio_meta() {
		$audio_post_format_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'struktur' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'struktur' ),
				'description'   => esc_html__( 'Choose audio type', 'struktur' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'struktur' ),
					'self'            => esc_html__( 'Self Hosted', 'struktur' )
				)
			)
		);
		
		$qodef_audio_embedded_container = struktur_select_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'qodef_audio_embedded_container'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'struktur' ),
				'description' => esc_html__( 'Enter audio URL', 'struktur' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'struktur' ),
				'description' => esc_html__( 'Enter audio link', 'struktur' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_post_audio_meta', 23 );
}