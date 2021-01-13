<?php

if ( ! function_exists( 'struktur_select_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function struktur_select_general_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'struktur' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = struktur_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'struktur' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'struktur' ),
				'parent'        => $panel_design_style
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'struktur' ),
				'parent'        => $panel_design_style
			)
		);
		
		$additional_google_fonts_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'struktur' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'struktur' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'struktur' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'struktur' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'struktur' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'struktur' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'struktur' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'struktur' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'struktur' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'struktur' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'struktur' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'struktur' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'struktur' ),
					'100i' => esc_html__( '100 Thin Italic', 'struktur' ),
					'200'  => esc_html__( '200 Extra-Light', 'struktur' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'struktur' ),
					'300'  => esc_html__( '300 Light', 'struktur' ),
					'300i' => esc_html__( '300 Light Italic', 'struktur' ),
					'400'  => esc_html__( '400 Regular', 'struktur' ),
					'400i' => esc_html__( '400 Regular Italic', 'struktur' ),
					'500'  => esc_html__( '500 Medium', 'struktur' ),
					'500i' => esc_html__( '500 Medium Italic', 'struktur' ),
					'600'  => esc_html__( '600 Semi-Bold', 'struktur' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'struktur' ),
					'700'  => esc_html__( '700 Bold', 'struktur' ),
					'700i' => esc_html__( '700 Bold Italic', 'struktur' ),
					'800'  => esc_html__( '800 Extra-Bold', 'struktur' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'struktur' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'struktur' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'struktur' )
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'struktur' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'struktur' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'struktur' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'struktur' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'struktur' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'struktur' ),
					'greek'        => esc_html__( 'Greek', 'struktur' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'struktur' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'struktur' )
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'struktur' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'struktur' ),
				'parent'      => $panel_design_style
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'struktur' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'struktur' ),
				'parent'      => $panel_design_style
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'struktur' ),
				'description' => esc_html__( 'Choose the background image for page content', 'struktur' ),
				'parent'      => $panel_design_style
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'struktur' ),
				'parent'        => $panel_design_style
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'struktur' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'struktur' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'struktur' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = struktur_select_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				struktur_select_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'struktur' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'struktur' ),
						'parent'      => $boxed_container
					)
				);
				
				struktur_select_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'struktur' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'struktur' ),
						'parent'      => $boxed_container
					)
				);
				
				struktur_select_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'struktur' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'struktur' ),
						'parent'      => $boxed_container
					)
				);
				
				struktur_select_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'struktur' ),
						'description'   => esc_html__( 'Choose background image attachment', 'struktur' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'struktur' ),
							'fixed'  => esc_html__( 'Fixed', 'struktur' ),
							'scroll' => esc_html__( 'Scroll', 'struktur' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'struktur' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = struktur_select_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				struktur_select_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'struktur' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'struktur' ),
						'parent'      => $paspartu_container
					)
				);
				
				struktur_select_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'struktur' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'struktur' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				struktur_select_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'struktur' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'struktur' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				struktur_select_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'struktur' )
					)
				);
		
				struktur_select_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'struktur' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'struktur' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'struktur' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'struktur' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'qodef-grid-1100' => esc_html__( '1100px - default', 'struktur' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'struktur' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'struktur' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'struktur' ),
					'qodef-grid-800'  => esc_html__( '800px', 'struktur' )
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'struktur' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'struktur' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = struktur_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'struktur' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'struktur' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'struktur' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = struktur_select_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				struktur_select_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'struktur' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'struktur' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = struktur_select_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					struktur_select_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'struktur' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = struktur_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'struktur' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'struktur' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = struktur_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					struktur_select_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'struktur' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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
					
					struktur_select_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'struktur' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					struktur_select_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'struktur' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'struktur' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'struktur' ),
				'parent'        => $panel_settings
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'struktur' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = struktur_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'struktur' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'struktur' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = struktur_select_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'struktur' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'struktur' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_general_options_map', struktur_select_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'struktur_select_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function struktur_select_page_general_style( $style ) {
		$current_style = '';
		$page_id       = struktur_select_get_page_id();
		$class_prefix  = struktur_select_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = struktur_select_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = struktur_select_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = struktur_select_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = struktur_select_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.qodef-boxed .qodef-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= struktur_select_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.qodef-paspartu-enabled .qodef-page-header .qodef-fixed-wrapper.fixed',
			'.qodef-paspartu-enabled .qodef-sticky-header',
			'.qodef-paspartu-enabled .qodef-mobile-header.mobile-header-appear .qodef-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.qodef-paspartu-enabled.qodef-fixed-paspartu-enabled .qodef-page-header .qodef-fixed-wrapper.fixed',
			'.qodef-paspartu-enabled.qodef-fixed-paspartu-enabled .qodef-sticky-header.header-appear',
			'.qodef-paspartu-enabled.qodef-fixed-paspartu-enabled .qodef-mobile-header.mobile-header-appear .qodef-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = struktur_select_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = struktur_select_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( struktur_select_string_ends_with( $paspartu_width, '%' ) || struktur_select_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = struktur_select_string_ends_with( $paspartu_width, '%' ) ? struktur_select_filter_suffix( $paspartu_width, '%' ) : struktur_select_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = struktur_select_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.qodef-paspartu-enabled .qodef-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= struktur_select_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= struktur_select_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= struktur_select_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = struktur_select_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( struktur_select_string_ends_with( $paspartu_responsive_width, '%' ) || struktur_select_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = struktur_select_string_ends_with( $paspartu_responsive_width, '%' ) ? struktur_select_filter_suffix( $paspartu_responsive_width, '%' ) : struktur_select_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = struktur_select_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . struktur_select_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . struktur_select_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . struktur_select_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'struktur_select_filter_add_page_custom_style', 'struktur_select_page_general_style' );
}