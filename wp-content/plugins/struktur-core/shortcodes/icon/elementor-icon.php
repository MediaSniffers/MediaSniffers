<?php

class StrukturCoreElementorIcon extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_icon';
    }

    public function get_title() {
        return esc_html__( 'Icon', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-icon';
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

        struktur_select_icon_collections()->getElementorParamsArray($this, '', '', true);

        $this->add_control(
            'size',
            [
                'label'   => esc_html__( 'Size', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qodef-icon-tiny'   => esc_html__( 'Tiny', 'struktur-core' ),
                    'qodef-icon-small'  => esc_html__( 'Small', 'struktur-core' ),
                    'qodef-icon-medium' => esc_html__( 'Medium', 'struktur-core' ),
                    'qodef-icon-large'  => esc_html__( 'Large', 'struktur-core' ),
                    'qodef-icon-huge'   => esc_html__( 'Huge', 'struktur-core' ),
                ]
            ]
        );

        $this->add_control(
            'custom_size',
            [
                'label' => esc_html__( 'Custom Size (px)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'struktur-core' ),
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
            'border_radius',
            [
                'label'       => esc_html__( 'Border Radius', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Please insert border radius(Rounded corners) in px. For example: 4 ', 'struktur-core' ),
                'condition'   => [
                    'type' => array( 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'shape_size',
            [
                'label'     => esc_html__( 'Shape Size (px)', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => array( 'qodef-circle', 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__( 'Border Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'qodef-circle', 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label'     => esc_html__( 'Border Width', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => array( 'qodef-circle', 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => esc_html__( 'Background Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'qodef-circle', 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'hover_icon_color',
            [
                'label' => esc_html__( 'Hover Icon Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'hover_border_color',
            [
                'label'     => esc_html__( 'Hover Border Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'qodef-circle', 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'hover_background_color',
            [
                'label'     => esc_html__( 'Hover Background Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'qodef-circle', 'qodef-square' )
                ],
            ]
        );

        $this->add_control(
            'margin',
            [
                'label'       => esc_html__( 'Margin', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'struktur-core' )
            ]
        );

        $this->add_control(
            'icon_animation',
            [
                'label'   => esc_html__( 'Icon Animation', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
            ]
        );

        $this->add_control(
            'icon_animation_delay',
            [
                'label'     => esc_html__( 'Icon Animation Delay (ms)', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_animation' => array( 'yes' )
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'anchor_icon',
            [
                'label'       => esc_html__( 'Use Link as Anchor', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array(),
                'description' => esc_html__( 'Check this box to use icon as anchor link (eg. #contact)', 'struktur-core' ),
                'condition'   => [
                    'link!' => ''
                ],
            ]
        );

        $this->add_control(
            'target',
            [
                'label'     => esc_html__( 'Target', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_link_target_array(),
                'condition' => [
                    'link!' => ''
                ],
                'default'   => '_self'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $default_atts = array(
            'custom_class'           => '',
            'size'                   => '',
            'custom_size'            => '',
            'type'                   => 'qodef-normal',
            'border_radius'          => '',
            'shape_size'             => '',
            'icon_color'             => '',
            'border_color'           => '',
            'border_width'           => '',
            'background_color'       => '',
            'hover_icon_color'       => '',
            'hover_border_color'     => '',
            'hover_background_color' => '',
            'margin'                 => '',
            'icon_animation'         => '',
            'icon_animation_delay'   => '',
            'link'                   => '',
            'anchor_icon'            => '',
            'target'                 => '_self'
        );

        $params['icon'] = struktur_select_icon_collections()->getElementorIconFromIconPack( $params );

        $params['icon_holder_classes']          = $this->generateIconHolderClasses( $params );
        $params['icon_holder_styles']           = $this->generateIconHolderStyles( $params );
        $params['icon_holder_data']             = $this->generateIconHolderData( $params );
        $params['icon_params']                  = $this->generateIconParams( $params );
        $params['icon_animation_holder']        = isset( $params['icon_animation'] ) && $params['icon_animation'] == 'yes';
        $params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles( $params );
        $params['link_class']                   = $this->getLinkClass( $params );
        $params['target']                       = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/icon', 'icon', '', $params );
    }

    private function generateIconHolderClasses( $params ) {
        $holderClasses = array( 'qodef-icon-shortcode', $params['type'] );

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = $params['icon_animation'] == 'yes' ? 'qodef-icon-animation' : '';
        $holderClasses[] = ! empty( $params['size'] ) ? $params['size'] : '';

        return implode( ' ', $holderClasses );
    }

    private function generateIconParams( $params ) {
        $iconParams = array( 'icon_attributes' => array() );

        $iconParams['icon_attributes']['style'] = $this->generateIconStyles( $params );
        $iconParams['icon_attributes']['class'] = 'qodef-icon-element';

        return $iconParams;
    }

    private function generateIconStyles( $params ) {
        $iconStyles = array();

        if ( ! empty( $params['icon_color'] ) ) {
            $iconStyles[] = 'color: ' . $params['icon_color'];
        }

        if ( ( $params['type'] !== 'qodef-normal' && ! empty( $params['shape_size'] ) ) || ( $params['type'] == 'qodef-normal' ) ) {
            if ( ! empty( $params['custom_size'] ) ) {
                $iconStyles[] = 'font-size:' . struktur_select_filter_px( $params['custom_size'] ) . 'px';
            }
        }

        return implode( ';', $iconStyles );
    }

    private function generateIconHolderStyles( $params ) {
        $iconHolderStyles = array();

        if ( $params['margin'] !== '' ) {
            $iconHolderStyles[] = 'margin: ' . $params['margin'];
        }

        if ( $params['type'] !== 'qodef-normal' ) {

            $shapeSize = '';
            if ( ! empty( $params['shape_size'] ) ) {
                $shapeSize = $params['shape_size'];
            } elseif ( ! empty( $params['custom_size'] ) ) {
                $shapeSize = $params['custom_size'];
            }

            if ( ! empty( $shapeSize ) ) {
                $iconHolderStyles[] = 'width: ' . struktur_select_filter_px( $shapeSize ) . 'px';
                $iconHolderStyles[] = 'height: ' . struktur_select_filter_px( $shapeSize ) . 'px';
                $iconHolderStyles[] = 'line-height: ' . struktur_select_filter_px( $shapeSize ) . 'px';
            }

            if ( ! empty( $params['background_color'] ) ) {
                $iconHolderStyles[] = 'background-color: ' . $params['background_color'];
            }

            if ( ! empty( $params['border_color'] ) && ( isset( $params['border_width'] ) && $params['border_width'] !== '' ) ) {
                $iconHolderStyles[] = 'border-style: solid';
                $iconHolderStyles[] = 'border-color: ' . $params['border_color'];
                $iconHolderStyles[] = 'border-width: ' . struktur_select_filter_px( $params['border_width'] ) . 'px';
            } else if ( isset( $params['border_width'] ) && $params['border_width'] !== '' ) {
                $iconHolderStyles[] = 'border-style: solid';
                $iconHolderStyles[] = 'border-width: ' . struktur_select_filter_px( $params['border_width'] ) . 'px';
            } else if ( ! empty( $params['border_color'] ) ) {
                $iconHolderStyles[] = 'border-color: ' . $params['border_color'];
            }

            if ( $params['type'] == 'qodef-square' ) {
                if ( isset( $params['border_radius'] ) && $params['border_radius'] !== '' ) {
                    $iconHolderStyles[] = 'border-radius: ' . struktur_select_filter_px( $params['border_radius'] ) . 'px';
                }
            }
        }

        return $iconHolderStyles;
    }

    private function generateIconHolderData( $params ) {
        $iconHolderData = array();

        if ( isset( $params['type'] ) && $params['type'] !== 'qodef-normal' ) {
            if ( ! empty( $params['hover_border_color'] ) ) {
                $iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
            }

            if ( ! empty( $params['hover_background_color'] ) ) {
                $iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
            }
        }

        if ( ( isset( $params['icon_animation'] ) && $params['icon_animation'] == 'yes' )
            && ( isset( $params['icon_animation_delay'] ) && $params['icon_animation_delay'] !== '' )
        ) {
            $iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
        }

        if ( ! empty( $params['hover_icon_color'] ) ) {
            $iconHolderData['data-hover-color'] = $params['hover_icon_color'];
        }

        if ( ! empty( $params['icon_color'] ) ) {
            $iconHolderData['data-color'] = $params['icon_color'];
        }

        return $iconHolderData;
    }

    private function generateIconAnimationHolderStyles( $params ) {
        $styles = array();

        if ( ( isset( $params['icon_animation'] ) && $params['icon_animation'] == 'yes' ) && ( isset( $params['icon_animation_delay'] ) && $params['icon_animation_delay'] !== '' ) ) {
            $styles[] = '-webkit-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
            $styles[] = '-moz-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
            $styles[] = 'transition-delay: ' . $params['icon_animation_delay'] . 'ms';
        }

        return $styles;
    }

    private function getLinkClass( $params ) {
        $class = '';

        if ( $params['anchor_icon'] != '' && $params['anchor_icon'] == 'yes' ) {
            $class .= 'qodef-anchor';
        }

        return $class;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorIcon() );