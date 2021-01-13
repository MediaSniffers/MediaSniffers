<?php

if ( ! function_exists( 'struktur_select_map_general_meta' ) ) {
	function struktur_select_map_general_meta() {
		
		$general_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => apply_filters( 'struktur_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'struktur' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'struktur' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'struktur' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'struktur' ),
				'parent'        => $general_meta_box
			)
		);
		
		$qodef_content_padding_group = struktur_select_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'struktur' ),
				'description' => esc_html__( 'Define styles for Content area', 'struktur' ),
				'parent'      => $general_meta_box
			)
		);
		
			$qodef_content_padding_row = struktur_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row',
					'parent' => $qodef_content_padding_group
				)
			);
			
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'struktur' ),
						'parent'      => $qodef_content_padding_row
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'struktur' ),
						'parent'        => $qodef_content_padding_row
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'struktur' ),
						'options'       => struktur_select_get_yes_no_select_array(),
						'parent'        => $qodef_content_padding_row
					)
				);
		
			$qodef_content_padding_row_1 = struktur_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row_1',
					'next'   => true,
					'parent' => $qodef_content_padding_group
				)
			);
		
				struktur_select_create_meta_box_field(
					array(
						'name'   => 'qodef_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'struktur' ),
						'parent' => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'    => 'qodef_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'struktur' ),
						'parent'  => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'struktur' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'struktur' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'struktur' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'struktur' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'struktur' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'struktur' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'struktur' ),
					'qodef-grid-800'  => esc_html__( '800px', 'struktur' )
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'struktur' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'struktur' ),
				'options'     => struktur_select_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'    => 'qodef_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'struktur' ),
				'parent'  => $general_meta_box,
				'options' => struktur_select_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = struktur_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'struktur' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'struktur' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'struktur' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'struktur' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'struktur' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'struktur' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'          => 'qodef_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'struktur' ),
						'description'   => esc_html__( 'Choose background image attachment', 'struktur' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'struktur' ),
							'fixed'  => esc_html__( 'Fixed', 'struktur' ),
							'scroll' => esc_html__( 'Scroll', 'struktur' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'struktur' ),
				'parent'        => $general_meta_box,
				'options'       => struktur_select_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = struktur_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'qodef_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'struktur' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'struktur' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'struktur' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'struktur' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'struktur' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'struktur' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				struktur_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'struktur' ),
						'options'       => struktur_select_get_yes_no_select_array(),
					)
				);
		
				struktur_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'struktur' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'struktur' ),
						'options'       => struktur_select_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'struktur' ),
				'parent'        => $general_meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = struktur_select_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				struktur_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'struktur' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'struktur' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => struktur_select_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = struktur_select_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'qodef_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					struktur_select_create_meta_box_field(
						array(
							'name'   => 'qodef_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'struktur' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = struktur_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'struktur' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'struktur' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = struktur_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					struktur_select_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'qodef_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'struktur' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'struktur' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'struktur' ),
								'pulse'                 => esc_html__( 'Pulse', 'struktur' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'struktur' ),
								'cube'                  => esc_html__( 'Cube', 'struktur' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'struktur' ),
								'stripes'               => esc_html__( 'Stripes', 'struktur' ),
								'wave'                  => esc_html__( 'Wave', 'struktur' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'struktur' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'struktur' ),
								'atom'                  => esc_html__( 'Atom', 'struktur' ),
								'clock'                 => esc_html__( 'Clock', 'struktur' ),
								'mitosis'               => esc_html__( 'Mitosis', 'struktur' ),
								'lines'                 => esc_html__( 'Lines', 'struktur' ),
								'fussion'               => esc_html__( 'Fussion', 'struktur' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'struktur' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'struktur' )
							)
						)
					);
					
					struktur_select_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'qodef_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'struktur' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					struktur_select_create_meta_box_field(
						array(
							'name'        => 'qodef_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'struktur' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'struktur' ),
							'options'     => struktur_select_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Back to top - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_back_top_top_skin_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Back To Top Skin', 'struktur' ),
				'parent'      => $general_meta_box,
				'options' => array(
					''             => esc_html__( 'Default', 'struktur' ),
					'light'        => esc_html__( 'Light', 'struktur' ),
					'dark'         => esc_html__( 'Dark', 'struktur' )
				)
			)
		);
		
		/***************** Back to top - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'struktur' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'struktur' ),
				'parent'      => $general_meta_box,
				'options'     => struktur_select_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_general_meta', 10 );
}

if ( ! function_exists( 'struktur_select_container_background_style' ) ) {
	/**
	 * Function that return container style
	 *
	 * @param $style
	 *
	 * @return string
	 */
	function struktur_select_container_background_style( $style ) {
		$page_id      = struktur_select_get_page_id();
		$class_prefix = struktur_select_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .qodef-content'
		);
		
		$container_class        = array();
		$current_style = '';
		$page_background_color  = get_post_meta( $page_id, 'qodef_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'qodef_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'qodef_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}

		if(! empty( $container_class )) {
			$current_style = struktur_select_dynamic_css( $container_selector, $container_class );
		}

		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'struktur_select_filter_add_page_custom_style', 'struktur_select_container_background_style' );
}