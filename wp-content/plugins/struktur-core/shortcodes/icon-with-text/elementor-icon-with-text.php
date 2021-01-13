<?php

class StrukturCoreElementorIconWithText extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_icon_with_text';
    }

    public function get_title() {
        return esc_html__( 'Icon With Text', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-icon-with-text';
    }

    public function get_categories() {
        return [ 'struktur' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label'       => esc_html__( 'Custom CSS Class', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'struktur-core' )
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'icon-left'            => esc_html__( 'Icon Left From Text', 'struktur-core' ),
                    'icon-left-from-title' => esc_html__( 'Icon Left From Title', 'struktur-core' ),
                    'icon-top'             => esc_html__( 'Icon Top', 'struktur-core' ),
                ],
                'default' => 'icon-left'
            ]
        );

        struktur_select_icon_collections()->getElementorParamsArray($this, '', '', true);

        $this->add_control(
            'custom_icon',
            [
                'label'       => esc_html__( 'Custom Icon', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_settings',
            [
                'label' => esc_html__( 'Icon Settings', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Icon Type', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qodef-normal' => esc_html__( 'Normal', 'struktur-core' ),
                    'qodef-circle' => esc_html__( 'Circle', 'struktur-core' ),
                    'qodef-square' => esc_html__( 'Square', 'struktur-core' ),
                ],
                'default' => 'qodef-normal'
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'   => esc_html__( 'Icon Size', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qodef-icon-medium' => esc_html__( 'Medium', 'struktur-core' ),
                    'qodef-icon-tiny'   => esc_html__( 'Tiny', 'struktur-core' ),
                    'qodef-icon-small'  => esc_html__( 'Small', 'struktur-core' ),
                    'qodef-icon-large'  => esc_html__( 'Large', 'struktur-core' ),
                    'qodef-icon-huge'   => esc_html__( 'Very Large', 'struktur-core' ),
                ],
                'default' => 'qodef-icon-medium'
            ]
        );

        $this->add_control(
            'custom_icon_size',
            [
                'label'   => esc_html__( 'Custom Icon Size (px)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'shape_size',
            [
                'label'   => esc_html__( 'Shape Size (px)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'   => esc_html__( 'Icon Hover Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label'   => esc_html__( 'Icon Background Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'qodef-square', 'qodef-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background_color',
            [
                'label'   => esc_html__( 'Icon Hover Background Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'qodef-square', 'qodef-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_border_color',
            [
                'label'   => esc_html__( 'Icon Border Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'qodef-square', 'qodef-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_border_hover_color',
            [
                'label'   => esc_html__( 'Icon Border Hover Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'qodef-square', 'qodef-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_border_width',
            [
                'label'   => esc_html__( 'Border Width (px)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_type' => array( 'qodef-square', 'qodef-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_animation',
            [
                'label'   => esc_html__( 'Icon Animation', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false )
            ]
        );

        $this->add_control(
            'icon_animation_delay',
            [
                'label'   => esc_html__( 'Icon Animation Delay (ms)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_animation' => array( 'yes' )
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_settings',
            [
                'label' => esc_html__( 'Text Settings', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'condition' => [
                    'title!' => ''
                ],
                'default' => 'h4'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'   => esc_html__( 'Title Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_top_margin',
            [
                'label'   => esc_html__( 'Title Top Margin (px)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label'   => esc_html__( 'Text', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'   => esc_html__( 'Text Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_top_margin',
            [
                'label'   => esc_html__( 'Text Top Margin (px)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label'   => esc_html__( 'Link', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Set link around icon and title', 'struktur-core' )
            ]
        );

        $this->add_control(
            'target',
            [
                'label'   => esc_html__( 'Target', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_padding',
            [
                'label'   => esc_html__( 'Text Padding (px)', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => array( 'icon-left', 'icon-top' )
                ],
                'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'struktur-core' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $default_atts = array(
            'custom_class'                => '',
            'type'                        => 'icon-left',
            'custom_icon'                 => '',
            'icon_type'                   => 'qodef-normal',
            'icon_size'                   => 'qodef-icon-medium',
            'custom_icon_size'            => '',
            'shape_size'                  => '',
            'icon_color'                  => '',
            'icon_hover_color'            => '',
            'icon_background_color'       => '',
            'icon_hover_background_color' => '',
            'icon_border_color'           => '',
            'icon_border_hover_color'     => '',
            'icon_border_width'           => '',
            'icon_animation'              => '',
            'icon_animation_delay'        => '',
            'title'                       => '',
            'title_tag'                   => 'h4',
            'title_color'                 => '',
            'title_top_margin'            => '',
            'text'                        => '',
            'text_color'                  => '',
            'text_top_margin'             => '',
            'link'                        => '',
            'target'                      => '_self',
            'text_padding'                => ''
        );

        if ( ! empty( $params['custom_icon'] ) ) {
            $params['custom_icon'] = $params['custom_icon']['id'];
        }

        $params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];

        $params['icon_parameters'] = $this->getIconParameters( $params );
        $params['holder_classes']  = $this->getHolderClasses( $params );
        $params['content_styles']  = $this->getContentStyles( $params );
        $params['title_styles']    = $this->getTitleStyles( $params );
        $params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
        $params['text_styles']     = $this->getTextStyles( $params );
        $params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
    }

    private function getIconParameters( $params ) {
        $params_array = array();

        if ( empty( $params['custom_icon'] ) ) {
            $iconPackName = struktur_select_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );

            $params_array['icon_pack']     = $params['icon_pack'];
            $params_array[ $iconPackName ] = $params[ $iconPackName ];

            if ( ! empty( $params['icon_size'] ) ) {
                $params_array['size'] = $params['icon_size'];
            }

            if ( ! empty( $params['custom_icon_size'] ) ) {
                $params_array['custom_size'] = struktur_select_filter_px( $params['custom_icon_size'] ) . 'px';
            }

            if ( ! empty( $params['icon_type'] ) ) {
                $params_array['type'] = $params['icon_type'];
            }

            if ( ! empty( $params['shape_size'] ) ) {
                $params_array['shape_size'] = struktur_select_filter_px( $params['shape_size'] ) . 'px';
            }

            if ( ! empty( $params['icon_border_color'] ) ) {
                $params_array['border_color'] = $params['icon_border_color'];
            }

            if ( ! empty( $params['icon_border_hover_color'] ) ) {
                $params_array['hover_border_color'] = $params['icon_border_hover_color'];
            }

            if ( $params['icon_border_width'] !== '' ) {
                $params_array['border_width'] = struktur_select_filter_px( $params['icon_border_width'] ) . 'px';
            }

            if ( ! empty( $params['icon_background_color'] ) ) {
                $params_array['background_color'] = $params['icon_background_color'];
            }

            if ( ! empty( $params['icon_hover_background_color'] ) ) {
                $params_array['hover_background_color'] = $params['icon_hover_background_color'];
            }

            $params_array['icon_color'] = $params['icon_color'];

            if ( ! empty( $params['icon_hover_color'] ) ) {
                $params_array['hover_icon_color'] = $params['icon_hover_color'];
            }

            $params_array['icon_animation']       = $params['icon_animation'];
            $params_array['icon_animation_delay'] = $params['icon_animation_delay'];
        }

        return $params_array;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array( 'qodef-iwt', 'clearfix' );

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-iwt-' . $params['type'] : '';
        $holderClasses[] = ! empty( $params['icon_size'] ) ? 'qodef-iwt-' . str_replace( 'qodef-', '', $params['icon_size'] ) : '';

        return $holderClasses;
    }

    private function getContentStyles( $params ) {
        $styles = array();

        if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
            $styles[] = 'padding-left: ' . struktur_select_filter_px( $params['text_padding'] ) . 'px';
        }

        if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
            $styles[] = 'padding-top: ' . struktur_select_filter_px( $params['text_padding'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        if ( $params['title_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['title_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        if ( $params['text_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['text_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorIconWithText() );