<?php

if ( ! function_exists( 'struktur_select_map_post_video_meta' ) ) {
	function struktur_select_map_post_video_meta() {
		$video_post_format_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'struktur' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'struktur' ),
				'description'   => esc_html__( 'Choose video type', 'struktur' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'struktur' ),
					'self'            => esc_html__( 'Self Hosted', 'struktur' )
				)
			)
		);
		
		$qodef_video_embedded_container = struktur_select_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'qodef_video_embedded_container'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'struktur' ),
				'description' => esc_html__( 'Enter Video URL', 'struktur' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'struktur' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'struktur' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'struktur' ),
				'description' => esc_html__( 'Enter video image', 'struktur' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_post_video_meta', 22 );
}