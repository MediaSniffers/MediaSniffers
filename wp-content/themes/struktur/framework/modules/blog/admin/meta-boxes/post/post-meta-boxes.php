<?php

/*** Post Settings ***/

if ( ! function_exists( 'struktur_select_map_post_meta' ) ) {
	function struktur_select_map_post_meta() {
		
		$post_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'struktur' ),
				'name'  => 'post-meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'struktur' ),
				'parent'        => $post_meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'struktur' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'struktur' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => struktur_select_get_custom_sidebars_options( true )
			)
		);
		
		$struktur_custom_sidebars = struktur_select_get_custom_sidebars();
		if ( count( $struktur_custom_sidebars ) > 0 ) {
			struktur_select_create_meta_box_field( array(
				'name'        => 'qodef_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'struktur' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'struktur' ),
				'parent'      => $post_meta_box,
				'options'     => struktur_select_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'struktur' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'struktur' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('struktur_select_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_post_meta', 20 );
}
