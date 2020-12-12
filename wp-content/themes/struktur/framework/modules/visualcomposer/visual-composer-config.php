<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = STRUKTUR_SELECT_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'struktur_select_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function struktur_select_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'struktur_select_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'struktur_select_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function struktur_select_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'struktur' ),
				'value'      => array(
					esc_html__( 'Full Width', 'struktur' ) => 'full-width',
					esc_html__( 'In Grid', 'struktur' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Select Anchor ID', 'struktur' ),
				'description' => esc_html__( 'For example "home"', 'struktur' ),
				'group'       => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'struktur' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'struktur' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'struktur' ),
				'value'       => array(
					esc_html__( 'Never', 'struktur' )        => '',
					esc_html__( 'Below 1280px', 'struktur' ) => '1280',
					esc_html__( 'Below 1024px', 'struktur' ) => '1024',
					esc_html__( 'Below 768px', 'struktur' )  => '768',
					esc_html__( 'Below 680px', 'struktur' )  => '680',
					esc_html__( 'Below 480px', 'struktur' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'struktur' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Select Parallax Speed', 'struktur' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'struktur' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'struktur' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'struktur' ),
				'value'      => array(
					esc_html__( 'Default', 'struktur' ) => '',
					esc_html__( 'Left', 'struktur' )    => 'left',
					esc_html__( 'Center', 'struktur' )  => 'center',
					esc_html__( 'Right', 'struktur' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_1',
				'heading'    => esc_html__( 'Select Background Text 1', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_2',
				'heading'    => esc_html__( 'Select Background Text 2', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_size',
				'heading'    => esc_html__( 'Select Background Text Size', 'struktur' ),
				'description' => esc_html__( 'Set the background text size in px or em', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_size_1440',
				'heading'    => esc_html__( 'Select Background Text Size 1280px-1440px', 'struktur' ),
				'description' => esc_html__( 'Set the background text size in px or em', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_size_1280',
				'heading'    => esc_html__( 'Select Background Text Size 1024px-1280px', 'struktur' ),
				'description' => esc_html__( 'Set the background text size in px or em', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_enable_grid',
				'group'      => esc_html__( 'Select Settings', 'struktur' ),
				'heading'    => 'Enable Row Grid',
				'description'=> 'Works with: Icon With Text, Image WIth Text',
				'value'      => array_flip( struktur_select_get_yes_no_select_array( false, false ) )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'row_background_text_color',
				'heading'    => esc_html__( 'Select Background Text Color', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_text_align',
				'heading'    => esc_html__( 'Select Background Text Align', 'struktur' ),
				'value'      => array(
					esc_html__( 'Default', 'struktur' ) => '',
					esc_html__( 'Left', 'struktur' )    => 'left',
					esc_html__( 'Center', 'struktur' )  => 'center',
					esc_html__( 'Right', 'struktur' )   => 'right'
				),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_text_vertical_align',
				'heading'    => esc_html__( 'Select Background Vertical Align', 'struktur' ),
				'value'      => array(
					esc_html__( 'Middle', 'struktur' )   => 'middle',
					esc_html__( 'Top', 'struktur' )      => 'top',
					esc_html__( 'Bottom', 'struktur' )   => 'bottom'
				),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_top',
				'heading'    => esc_html__( 'Select Background Text Top Padding', 'struktur' ),
				'description' => esc_html__( 'Set the value of top padding in px or %', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_left',
				'heading'    => esc_html__( 'Select Background Text Left Padding', 'struktur' ),
				'description' => esc_html__( 'Set the value of top padding in px or %', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_top_1440',
				'heading'    => esc_html__( 'Select Background Text Top Padding Size 1280px-1440px', 'struktur' ),
				'description' => esc_html__( 'Set the background text padding in px or em', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_padding_top', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'row_background_text_padding_top_1280',
				'heading'    => esc_html__( 'Select Background Text Top Padding Size 1024px-1280px', 'struktur' ),
				'description' => esc_html__( 'Set the background text padding in px or em', 'struktur' ),
				'dependency' => array( 'element' => 'row_background_text_padding_top', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_background_text_animation',
				'heading'    => esc_html__( 'Animate Background Text', 'struktur' ),
				'value'      => array_flip( struktur_select_get_yes_no_select_array(false, true) ),
				'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
				'description'    => esc_html__( 'Animate background text when row appears in viewport', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);

		do_action( 'struktur_select_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'struktur' ),
				'value'      => array(
					esc_html__( 'Full Width', 'struktur' ) => 'full-width',
					esc_html__( 'In Grid', 'struktur' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'struktur' ),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'struktur' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'struktur' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'struktur' ),
				'value'       => array(
					esc_html__( 'Never', 'struktur' )        => '',
					esc_html__( 'Below 1280px', 'struktur' ) => '1280',
					esc_html__( 'Below 1024px', 'struktur' ) => '1024',
					esc_html__( 'Below 768px', 'struktur' )  => '768',
					esc_html__( 'Below 680px', 'struktur' )  => '680',
					esc_html__( 'Below 480px', 'struktur' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'struktur' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'struktur' ),
				'value'      => array(
					esc_html__( 'Default', 'struktur' ) => '',
					esc_html__( 'Left', 'struktur' )    => 'left',
					esc_html__( 'Center', 'struktur' )  => 'center',
					esc_html__( 'Right', 'struktur' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'struktur' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( struktur_select_is_plugin_installed( 'revolution-slider' ) ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Select Enable Passepartout', 'struktur' ),
					'value'       => array_flip( struktur_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Select Settings', 'struktur' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Select Passepartout Size', 'struktur' ),
					'value'       => array(
						esc_html__( 'Tiny', 'struktur' )   => 'tiny',
						esc_html__( 'Small', 'struktur' )  => 'small',
						esc_html__( 'Normal', 'struktur' ) => 'normal',
						esc_html__( 'Large', 'struktur' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'struktur' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Select Disable Side Passepartout', 'struktur' ),
					'value'       => array_flip( struktur_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'struktur' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Select Disable Top Passepartout', 'struktur' ),
					'value'       => array_flip( struktur_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'struktur' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'struktur_select_vc_row_map' );
}