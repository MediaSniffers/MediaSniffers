<?php

if ( ! function_exists( 'struktur_core_include_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function struktur_core_include_shortcodes_file() {
		if ( struktur_core_theme_installed() ) {
			foreach ( glob( STRUKTUR_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode ) {
				if ( struktur_select_is_customizer_item_enabled( $shortcode, 'struktur_performance_disable_shortcode_' ) ) {
					include_once $shortcode;
				}
			}
		}
		
		do_action( 'struktur_core_action_include_shortcodes_file' );
	}
	
	add_action( 'init', 'struktur_core_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'struktur_core_load_shortcodes' ) ) {
	function struktur_core_load_shortcodes() {
		include_once STRUKTUR_CORE_ABS_PATH . '/lib/shortcode-loader.php';
		
		StrukturCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action( 'init', 'struktur_core_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after struktur_core_include_shortcodes_file hook
}

if ( ! function_exists( 'struktur_core_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function struktur_core_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'struktur-core-vc-shortcodes', STRUKTUR_CORE_ASSETS_URL_PATH . '/css/admin/struktur-vc-shortcodes.css' );
	}
	
	add_action( 'struktur_select_action_admin_scripts_init', 'struktur_core_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'struktur_core_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function struktur_core_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'struktur_core_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'struktur_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );
		
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'struktur-core-vc-shortcodes', $style );
		}
	}
	
	add_action( 'struktur_select_action_admin_scripts_init', 'struktur_core_add_admin_shortcodes_custom_styles' );
}

//Load Elementor Shortcodes
if( ! function_exists('struktur_core_load_elementor_shortcodes') ){
    function struktur_core_load_elementor_shortcodes(){
        if( struktur_core_is_elementor_installed() ) {
            foreach (glob(STRUKTUR_CORE_SHORTCODES_PATH . '/*/elementor-*.php') as $shortcode_load) {
                include_once $shortcode_load;
            }
        }
    }

    add_action('elementor/widgets/widgets_registered', 'struktur_core_load_elementor_shortcodes');
}

if( ! function_exists('struktur_core_add_elementor_widget_categories') ) {
    function struktur_core_add_elementor_widget_categories($elements_manager) {

        $elements_manager->add_category(
            'struktur',
            [
                'title' => esc_html__('by STRUKTUR', 'struktur-core'),
                'icon' => 'fa fa-plug',
            ]
        );

    }

    add_action('elementor/elements/categories_registered', 'struktur_core_add_elementor_widget_categories');
};

//function that returns all Elementor saved templates
if( ! function_exists('struktur_core_return_elementor_templates') ){
    function struktur_core_return_elementor_templates(){
        return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
    }
}

//function that adds Template Elementor Control
if( ! function_exists('struktur_core_generate_elementor_templates_control') ){
    function struktur_core_generate_elementor_templates_control( $object, $dependency_array = array() , $control_name = 'template_id' ){
        $templates = struktur_core_return_elementor_templates();

        if ( ! empty( $templates ) ) {
            $options = [
                '0' => '— ' . esc_html__('Select', 'struktur-core') . ' —',
            ];

            $types = [];

            foreach ($templates as $template) {
                $options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                $types[$template['template_id']] = $template['type'];
            }

            $control_options_array = [
                'label' => esc_html__('Choose Template', 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '0',
                'options' => $options,
                'types' => $types,
                'label_block' => 'true'
            ];

            if( is_array( $dependency_array ) && count( $dependency_array ) > 0 ){
                $control_options_array['condition'] = $dependency_array;
            }

            $object->add_control(
                $control_name, $control_options_array
            );
        };
    }
}

//function that maps "Anchor" option for section
if( ! function_exists('struktur_core_map_section_anchor_option') ){
    function struktur_core_map_section_anchor_option( $section, $args ){
        $section->start_controls_section(
            'section_qodef_anchor',
            [
                'label' => esc_html__( 'Select Anchor', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );
        $section->add_control(
            'anchor_id',
            [
                'label' => esc_html__( 'Select Anchor ID', 'struktur-core' ),
                'type'  => Elementor\Controls_Manager::TEXT,
            ]
        );
        $section->end_controls_section();
    }
    add_action('elementor/element/section/_section_responsive/after_section_end', 'struktur_core_map_section_anchor_option', 10, 2);
}
//function that renders "Anchor" option for section
if( ! function_exists('struktur_core_render_section_anchor_option') ) {
    function struktur_core_render_section_anchor_option( $element )   {
        if( 'section' !== $element->get_name() ) {
            return;
        }
        $params = $element->get_settings_for_display();
        if( ! empty( $params['anchor_id'] ) ){
            $element->add_render_attribute( '_wrapper', 'data-qodef-anchor', $params['anchor_id'] );
        }
    }
    add_action( 'elementor/frontend/section/before_render', 'struktur_core_render_section_anchor_option');
}

//function that maps "Parallax" option for section
if( ! function_exists('struktur_core_map_section_parallax_option') ){
    function struktur_core_map_section_parallax_option( $section, $args ){
        $section->start_controls_section(
            'section_qode_parallax',
            [
                'label' => esc_html__( 'Select Parallax', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'qode_enable_parallax',
            [
                'label'        => esc_html__( 'Enable Parallax', 'struktur-core'),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'no',
                'options' => [
                    'no' => esc_html__('No', 'struktur-core')  ,
                    'holder' => esc_html__('Yes', 'struktur-core')  ,
                ],
                'prefix_class' => 'parallax_section_'
            ]
        );

        $section->add_control(
            'qode_parallax_section_height',
            [
                'label'        => esc_html__( 'Parallax Section Height', 'struktur-core' ),
                'type'         => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'qode_enable_parallax' => 'holder'
                ],
                'selectors' => [
                    '{{WRAPPER}}.parallax_section_holder' => 'min-height: {{VALUE}}px !important;'
                ]
            ]
        );

        $section->add_control(
            'qode_parallax_image',
            [
                'label'        => esc_html__( 'Parallax Image', 'struktur-core' ),
                'type'         => Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'qode_enable_parallax' => 'holder'
                ],
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}}.parallax_section_holder' => 'background-image: url("{{URL}}") !important;'
                ]
            ]
        );

        $section->add_control(
            'qode_parallax_speed',
            [
                'label'        => esc_html__( 'Parallax Speed', 'struktur-core' ),
                'type'         => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'qode_enable_parallax' => 'holder'
                ],
                'default' => '0'
            ]
        );

        $section->end_controls_section();
    }

    add_action('elementor/element/section/_section_responsive/after_section_end', 'struktur_core_map_section_parallax_option', 10, 2);
}

//function that renders "Anchor" option for section
if( ! function_exists('struktur_core_render_section_parallax_option') ) {
    function struktur_core_render_section_parallax_option( $element )   {
        if( 'section' !== $element->get_name() ) {
            return;
        }

        $params = $element->get_settings_for_display();

        if( ! empty( $params['qode_parallax_image']['id'] ) ){
            $parallax_image_src = $params['qode_parallax_image']['url'];
            $parallax_speed = ! empty( $params['qode_parallax_speed'] ) ? $params['qode_parallax_speed'] : '0';
            $parallax_section_height = ! empty( $params['qode_parallax_section_height'] ) ? $params['qode_parallax_section_height'] : '0';
            $parallax_touch_devices = '';

            $element->add_render_attribute( '_wrapper', 'style', 'background-image: url(' . $parallax_image_src . '); min-height: ' . $parallax_section_height . 'px');
            $element->add_render_attribute( '_wrapper', 'class', 'qodef-parallax-section-holder '. $parallax_touch_devices);
            $element->add_render_attribute( '_wrapper', 'data-qodef-parallax-speed', $parallax_speed );
        }
    }

    add_action( 'elementor/frontend/section/before_render', 'struktur_core_render_section_parallax_option');
}

//function that renders helper hidden input for parallax data attribute section
if( ! function_exists('struktur_core_generate_parallax_helper') ){
    function struktur_core_generate_parallax_helper( $template, $widget ){
        if ( 'section' === $widget->get_name() ) {
            $template_preceding = "
            <# if( settings.qode_enable_parallax == 'holder' ){
		        let parallaxSpeed = settings.qode_parallax_speed !== '' ? settings.qode_parallax_speed : '0'; #>
		        <input type='hidden' class='qodef-parallax-helper-holder' data-speed='{{ parallaxSpeed }}'/>
		    <# } #>";
            $template = $template_preceding . " " . $template;
        }

        return $template;
    }

    add_action( 'elementor/section/print_template', 'struktur_core_generate_parallax_helper', 10, 2 );
}

//function that maps "Content Alignment" option for section
if ( ! function_exists( 'struktur_core_map_section_content_alignment_option' ) ) {
    function struktur_core_map_section_content_alignment_option( $section, $args ) {
        $section->start_controls_section(
            'qodef_section_content_alignment',
            [
                'label' => esc_html__( 'Select Content Alignment', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );
        $section->add_control(
            'qodef_content_alignment',
            [
                'label'        => esc_html__( 'Content Alignment', 'struktur-core' ),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'left',
                'options'      => [
                    'left'   => esc_html__( 'Left', 'struktur-core' ),
                    'center' => esc_html__( 'Center', 'struktur-core' ),
                    'right'  => esc_html__( 'Right', 'struktur-core' )
                ],
                'prefix_class' => 'qodef-content-aligment-'
            ]
        );
        $section->end_controls_section();
    }
    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'struktur_core_map_section_content_alignment_option', 10, 2 );
}

//function that maps "Full Screen Sections" option for section
if( ! function_exists('struktur_core_map_grid_option') ){
    function struktur_core_map_grid_option( $section, $args ){
        $section->start_controls_section(
            'section_qodef_grid_row',
            [
                'label' => esc_html__( 'Select Grid', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'qode_enable_grid_row',
            [
                'label'        => esc_html__( 'Make this row "In Grid"', 'struktur-core'),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'no',
                'options' => [
                    'no' => esc_html__('No', 'struktur-core')  ,
                    'inner' => esc_html__('Yes', 'struktur-core')  ,
                ],
                'prefix_class' => 'qodef-elementor-container-'
            ]
        );

        $section->end_controls_section();
    }

    add_action('elementor/element/section/_section_responsive/after_section_end', 'struktur_core_map_grid_option', 10, 2);
}

//function that adds maps "Disable Background" option for section
if ( ! function_exists( 'struktur_core_map_section_disable_background' ) ) {
    function struktur_core_map_section_disable_background( $section, $args ) {
        $section->start_controls_section(
            'select_section_background',
            [
                'label' => esc_html__( 'Select Background Text', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'bg_text',
            [
                'label' => esc_html__( 'Background Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $section->add_control(
            'bg_text_font_size',
            [
                'label' => esc_html__( 'Background Text Font size (px)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $section->add_control(
            'bg_text_font_size_1440',
            [
                'label' => esc_html__( 'Background Text Size 1280px-1440px', 'struktur-core' ),
                'description' => esc_html__( 'Set the background text size in px', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $section->add_control(
            'bg_text_font_size_1280',
            [
                'label' => esc_html__( 'Background Text Size 1024px-1280px', 'struktur-core' ),
                'description' => esc_html__( 'Set the background text size in px', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $section->add_control(
            'bg_text_color',
            [
                'label' => esc_html__( 'Background Text Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $section->add_control(
            'bg_text_align',
            [
                'label' => esc_html__( 'Background Text Align', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''        => esc_html__( 'Default', 'struktur-core' ),
                    'left'    => esc_html__( 'Left', 'struktur-core' ),
                    'center'  => esc_html__( 'Center', 'struktur-core' ),
                    'right'   => esc_html__( 'Right', 'struktur-core' )
                ]
            ]
        );

        $section->add_control(
            'bg_text_animation',
            [
                'label' => esc_html__( 'Animate Background Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array(false)
            ]
        );

        $section->end_controls_section();
    }

    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'struktur_core_map_section_disable_background', 10, 2 );
}

if ( ! function_exists( 'struktur_core_render_section_background_before' ) ) {
    function struktur_core_render_section_background_before( $section ) {
        ob_start();
    }
    add_action( 'elementor/frontend/section/before_render', 'struktur_core_render_section_background_before');
}

if ( ! function_exists( 'struktur_core_render_section_background_after' ) ) {
    function struktur_core_render_section_background_after( $section ) {

        $content = ob_get_clean();

        $svg = struktur_select_get_svg( 'inverted-pattern');
        if( struktur_select_is_plugin_installed('core') ){
            $svg_style = struktur_core_get_svg_mark( $svg );
        } else {
            $svg_style = '';
        }

        $params = $section->get_settings_for_display();

        $qodef_bg_text_html = '';
        if ( !empty($params['bg_text']) ) {
            $bg_text_styles = array();

            if (!empty($params['bg_text_font_size'])) {
                $bg_text_font_size = struktur_select_filter_suffix($params['bg_text_font_size'], 'px') . 'px';
                $bg_text_styles[] = 'font-size: ' . esc_attr($bg_text_font_size);
            }

            if (!empty($params['bg_text_color'])) {
                $bg_text_styles[] = 'color: ' . esc_attr($params['bg_text_color']);
            }

            if (!empty($params['bg_text_align'])) {
                $bg_text_styles[] = 'text-align: ' . esc_attr($params['bg_text_align']);
            }

            $additional_classes = '';

            if (!empty($params['bg_text_animation']) && $params['bg_text_animation'] === 'yes') {
                $additional_classes = 'qodef-row-background-text-animation';
            }

            $section_background_text_data = array();

            if(!empty($params['bg_text_font_size_1440'])){
                $section_background_text_data[] = 'data-font-size-1440=' . esc_html($params['bg_text_font_size_1440']);
            }

            if(!empty($params['bg_text_font_size_1280'])){
                $section_background_text_data[] = 'data-font-size-1280=' . esc_html($params['bg_text_font_size_1280']);
            }

            $section_background_text_datas = implode(' ', $section_background_text_data);

            $qodef_bg_text_html = '<div class="qodef-elementor-row">';
            $qodef_bg_text_html .= '<div class="qodef-row-background-text-holder">';
            $qodef_bg_text_html .= '<div class="qodef-row-background-text-wrapper  ' . $additional_classes . '">';
            $qodef_bg_text_html .= '<div class="qodef-row-background-text-wrapper-inner"' . struktur_select_get_inline_style($bg_text_styles) . ' ' . esc_html($section_background_text_datas) .'>';
            $qodef_bg_text_html .= '<div class="qodef-pattern-holder">';
            $qodef_bg_text_html .= '<div class="qodef-pattern-before"></div>';
            $qodef_bg_text_html .= '<div class="qodef-row-background-text-1">' . esc_attr($params['bg_text']) . '</div>';
            $qodef_bg_text_html .= '<div class="qodef-pattern-after" style="' . $svg_style . '"></div>';
            $qodef_bg_text_html .= '</div>';
            $qodef_bg_text_html .= '</div>';
            $qodef_bg_text_html .= '</div>';
            $qodef_bg_text_html .= '</div>';
            $qodef_bg_text_html .= $content;
            $qodef_bg_text_html .= '</div>';

            echo struktur_select_get_module_part($qodef_bg_text_html);
        } else {
            echo struktur_select_get_module_part($content);
        }
    }
    add_action( 'elementor/frontend/section/after_render', 'struktur_core_render_section_background_after');
}

//function that renders background elements in admin
if ( ! function_exists( 'struktur_core_render_section_background_option_admin' ) ) {
    function struktur_core_render_section_background_option_admin( $template, $widget ) {
        if ( 'section' === $widget->get_name() ) {

            $svg = struktur_select_get_svg( 'inverted-pattern');
            if( struktur_select_is_plugin_installed('core') ){
                $svg_style = struktur_core_get_svg_mark( $svg );
            } else {
                $svg_style = '';
            }

            $template_text = "
            <# 
                        
            if( settings.bg_text !== '' ){
            	let bg_text = settings.bg_text;
            	            	
            	let bg_text_font_size = '';
            	if( settings.bg_text_font_size !== '' ){
            		bg_text_font_size =  'font-size:' + settings.bg_text_font_size + 'px;';
            	}
            	
            	let bg_text_color = '';
            	if( settings.bg_text_color !== '' ){
            		bg_text_color =  'color:' + settings.bg_text_color + ';';
            	}
            	
            	let bg_text_align = '';
            	if( settings.bg_text_align !== '' ){
            		bg_text_align =  'text-align:' + settings.bg_text_align + ';';
            	}
            	
            	let bg_text_animation = '';
            	if( settings.bg_text_animation !== '' && settings.bg_text_animation === 'yes'){
            		bg_text_animation =  'qodef-row-background-text-animation';
            	}
	        #>
	        	<div class='qodef-row-background-text-holder'><div class='qodef-row-background-text-wrapper {{bg_text_animation}}'><div class='qodef-row-background-text-wrapper-inner' style='{{ bg_text_color }} {{ bg_text_font_size }} {{ bg_text_align }}'><div class='qodef-pattern-holder'><div class='qodef-pattern-before'></div><div class='qodef-row-background-text-1'>{{bg_text}}</div><div class='qodef-pattern-after' style=\"{$svg_style}\"></div> </div></div></div></div>
 			<# } #>";

            $template = $template_text . " " . $template;
        }

        return $template;
    }

    add_action( 'elementor/section/print_template', 'struktur_core_render_section_background_option_admin', 10, 2 );
}

if( ! function_exists('struktur_core_elementor_icons_style') ){
    function struktur_core_elementor_icons_style(){
        wp_enqueue_style( 'struktur-core-elementor', STRUKTUR_CORE_ASSETS_URL_PATH . '/css/admin/struktur-elementor.css');
    }

    add_action( 'elementor/editor/before_enqueue_scripts', 'struktur_core_elementor_icons_style' );
}

if ( ! function_exists( 'struktur_core_get_elementor_shortcodes_path' ) ) {
    function struktur_core_get_elementor_shortcodes_path() {
        $shortcodes       = array();
        $shortcodes_paths = array(
            STRUKTUR_CORE_SHORTCODES_PATH . '/*' => STRUKTUR_CORE_URL_PATH,
            STRUKTUR_CORE_CPT_PATH . '/**/shortcodes/*' => STRUKTUR_CORE_URL_PATH,
            STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/**/shortcodes/*' => STRUKTUR_SELECT_FRAMEWORK_ROOT . '/'
        );

        foreach ( $shortcodes_paths as $dir_path => $url_path ) {
            foreach ( glob( $dir_path, GLOB_ONLYDIR ) as $shortcode_dir_path ) {
                $shortcode_name     = basename( $shortcode_dir_path );
                $shortcode_url_path = $url_path . substr( $shortcode_dir_path, strpos( $shortcode_dir_path, basename( $url_path ) ) + strlen( basename( $url_path ) ) + 1 );

                $shortcodes[ $shortcode_name ] = array(
                    'dir_path' => $shortcode_dir_path,
                    'url_path' => $shortcode_url_path
                );
            }
        }

        return $shortcodes;
    }
}
if ( ! function_exists( 'struktur_core_add_elementor_shortcodes_custom_styles' ) ) {
    function struktur_core_add_elementor_shortcodes_custom_styles() {
        $style                  = '';
        $shortcodes_icon_styles = array();

        $shortcodes_icon_class_array = apply_filters( 'struktur_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
        sort( $shortcodes_icon_class_array );

        $shortcodes_path = struktur_core_get_elementor_shortcodes_path();
        if ( ! empty( $shortcodes_icon_class_array ) ) {
            foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
                $shortcode_name = str_replace( '.icon-wpb-', '', esc_attr( $shortcode_icon_class ) );

                if ( key_exists( $shortcode_name, $shortcodes_path ) && file_exists( $shortcodes_path[ $shortcode_name ]['dir_path'] . '/assets/img/dashboard_icon.png' ) ) {
                    $shortcodes_icon_styles[] = '.struktur-elementor-custom-icon.struktur-elementor-' . $shortcode_name . ' {
                        background-image: url( "' . $shortcodes_path[ $shortcode_name ]['url_path'] . '/assets/img/dashboard_icon.png" );
                    }';
                }
            }
        }

        if ( ! empty( $shortcodes_icon_styles ) ) {
            $style = implode( ' ', $shortcodes_icon_styles );
        }
        if ( ! empty( $style ) ) {
            wp_add_inline_style( 'struktur-core-elementor', $style );
        }
    }

    add_action( 'elementor/editor/before_enqueue_scripts', 'struktur_core_add_elementor_shortcodes_custom_styles', 15 );
}