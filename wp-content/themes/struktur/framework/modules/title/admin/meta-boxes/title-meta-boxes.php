<?php

if ( ! function_exists( 'struktur_select_get_title_types_meta_boxes' ) ) {
	function struktur_select_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'struktur_select_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'struktur' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'struktur_select_map_title_meta' ) ) {
	function struktur_select_map_title_meta() {
		$title_type_meta_boxes = struktur_select_get_title_types_meta_boxes();
		
		$title_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => apply_filters( 'struktur_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'struktur' ),
				'name'  => 'title_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'struktur' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'struktur' ),
				'parent'        => $title_meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = struktur_select_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'qodef_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'qodef_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'struktur' ),
						'description'   => esc_html__( 'Choose title type', 'struktur' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'struktur' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'struktur' ),
						'options'       => struktur_select_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'struktur' ),
						'description' => esc_html__( 'Set a height for Title Area', 'struktur' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);

				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_mobile_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height on Mobile', 'struktur' ),
						'description' => esc_html__( 'Set a height for Title Area on Mobile', 'struktur' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'struktur' ),
						'description' => esc_html__( 'Choose a background color for title area', 'struktur' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'struktur' ),
						'description' => esc_html__( 'Choose an Image for title area', 'struktur' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'struktur' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'struktur' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'struktur' ),
							'hide'                => esc_html__( 'Hide Image', 'struktur' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'struktur' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'struktur' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'struktur' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'struktur' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'struktur' )
						)
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'struktur' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'struktur' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'struktur' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'struktur' ),
							'window-top'    => esc_html__( 'From Window Top', 'struktur' )
						)
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'struktur' ),
						'options'       => struktur_select_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'struktur' ),
						'description' => esc_html__( 'Choose a color for title text', 'struktur' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'struktur' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'struktur' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'struktur' ),
						'options'       => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'struktur' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'struktur' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'struktur_select_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_title_meta', 60 );
}