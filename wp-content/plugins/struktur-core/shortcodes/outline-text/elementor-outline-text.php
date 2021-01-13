<?php

class StrukturCoreElementorOutlineText extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_outline_text';
    }

    public function get_title() {
        return esc_html__( 'Outline Text', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-outline-text';
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
                'label' => esc_html__( 'Custom CSS Class', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'struktur-core' )
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'text_direction',
            [
                'label' => esc_html__( 'Text Direction', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'struktur-core' ),
                    'vertical'   => esc_html__( 'Vertical', 'struktur-core' )
                ],
                'default' => 'horizontal'
            ]
        );

        $this->add_control(
            'text_position',
            [
                'label' => esc_html__( 'Text Position', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left'   => esc_html__( 'Left', 'struktur-core' ),
                    'right'  => esc_html__( 'Right', 'struktur-core' )
                ],
                'condition' => [
                    'text_direction' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'text_tag',
            [
                'label' => esc_html__( 'Text Tag', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true, array( 'p' => 'p' )),
                'default' => 'h2'
            ]
        );

        $this->add_control(
            'font_family',
            [
                'label' => esc_html__( 'Font Family', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'font_size',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'font_weight',
            [
                'label' => esc_html__( 'Font Weight', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_weight_array( true )
            ]
        );

        $this->add_control(
            'font_style',
            [
                'label' => esc_html__( 'Font Style', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_style_array( true )
            ]
        );

        $this->add_control(
            'letter_spacing',
            [
                'label' => esc_html__( 'Letter Spacing (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Text Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'outline_color',
            [
                'label' => esc_html__( 'Outline Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'outline_width',
            [
                'label' => esc_html__( 'Outline Width', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert value in pixels (e.g. 2px)', 'struktur-core' )
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Text Align', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__( 'Default', 'struktur-core' ),
                    'left'   => esc_html__( 'Left', 'struktur-core' ),
                    'center' => esc_html__( 'Center', 'struktur-core' ),
                    'right'  => esc_html__( 'Right', 'struktur-core' ),
                    'justify' => esc_html__( 'Justify', 'struktur-core' )
                ]
            ]
        );

        $this->add_control(
            'margin',
            [
                'label' => esc_html__( 'Margin (px or %)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'struktur-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'laptops',
            [
                'label' => esc_html__( 'Laptops', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_1366',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_1366',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tablets_landscape',
            [
                'label' => esc_html__( 'Tablets Landscape', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_1024',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_1024',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tablets_portrait',
            [
                'label' => esc_html__( 'Tablets Landscape', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_768',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_768',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mobiles',
            [
                'label' => esc_html__( 'Mobiles', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_680',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_680',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'custom_class'     => '',
            'text'             => '',
            'text_direction'   => 'horizontal',
            'text_position'    => '',
            'text_tag'         => 'h2',
            'font_family'      => '',
            'font_size'        => '',
            'line_height'      => '',
            'font_weight'      => '',
            'font_style'       => '',
            'letter_spacing'   => '',
            'color'            => '',
            'outline_color'    => '',
            'outline_width'    => '',
            'text_align'       => '',
            'margin'           => '',
            'font_size_1366'   => '',
            'line_height_1366' => '',
            'font_size_1024'   => '',
            'line_height_1024' => '',
            'font_size_768'    => '',
            'line_height_768'  => '',
            'font_size_680'    => '',
            'line_height_680'  => ''
        );
        $params = shortcode_atts( $args, $params );

        $params['holder_classes']    = $this->getHolderClasses( $params );
        $params['text_styles']     = $this->getTextStyles( $params );
        $params['text_data']       = $this->getTextData( $params );

        $params['text_tag'] = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/outline-text', 'outline-text', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['text_direction'] ) ? 'qodef-ot-' . esc_attr( $params['text_direction'] ) : '';
        $holderClasses[] = $params['text_position'] == 'right' ? 'qodef-ot-position-right' : 'qodef-ot-position-left';

        return implode( ' ', $holderClasses );
    }

    private function getTextStyles( $params ) {
        $styles = array();

        if ( $params['font_family'] !== '' ) {
            $styles[] = 'font-family: ' . $params['font_family'];
        }

        if ( ! empty( $params['font_size'] ) ) {
            if ( struktur_select_string_ends_with( $params['font_size'], 'px' ) || struktur_select_string_ends_with( $params['font_size'], 'em' ) ) {
                $styles[] = 'font-size: ' . $params['font_size'];
            } else {
                $styles[] = 'font-size: ' . $params['font_size'] . 'px';
            }
        }

        if ( ! empty( $params['line_height'] ) ) {
            if ( struktur_select_string_ends_with( $params['line_height'], 'px' ) || struktur_select_string_ends_with( $params['line_height'], 'em' ) ) {
                $styles[] = 'line-height: ' . $params['line_height'];
            } else {
                $styles[] = 'line-height: ' . $params['line_height'] . 'px';
            }
        }

        if ( ! empty( $params['font_weight'] ) ) {
            $styles[] = 'font-weight: ' . $params['font_weight'];
        }

        if ( ! empty( $params['font_style'] ) ) {
            $styles[] = 'font-style: ' . $params['font_style'];
        }

        if ( ! empty( $params['letter_spacing'] ) ) {
            if ( struktur_select_string_ends_with( $params['letter_spacing'], 'px' ) || struktur_select_string_ends_with( $params['letter_spacing'], 'em' ) ) {
                $styles[] = 'letter-spacing: ' . $params['letter_spacing'];
            } else {
                $styles[] = 'letter-spacing: ' . $params['letter_spacing'] . 'px';
            }
        }

        if ( ! empty( $params['text_align'] ) ) {
            $styles[] = 'text-align: ' . $params['text_align'];
        }

        if ( ! empty( $params['color'] ) ) {
            $styles[] = 'color: ' . $params['color'];
        }

        if ( ! empty( $params['outline_color'] ) && ! empty( $params['outline_width'] ) ) {
            $styles[] = '-webkit-text-stroke: ' . $params['outline_width'] . ' ' .$params['outline_color'];
            $styles[] = 'text-stroke: ' . $params['outline_width'] . ' ' . $params['outline_color'];
        }

        if ( $params['margin'] !== '' ) {
            $styles[] = 'margin: ' . $params['margin'];
        }

        return implode( ';', $styles );
    }

    private function getTextData( $params ) {
        $data = array();

        if ( $params['font_size_1366'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_1366'], 'px' ) || struktur_select_string_ends_with( $params['font_size_1366'], 'em' ) ) {
                $data['data-font-size-1366'] = $params['font_size_1366'];
            } else {
                $data['data-font-size-1366'] = $params['font_size_1366'] . 'px';
            }
        }

        if ( $params['font_size_1024'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_1024'], 'px' ) || struktur_select_string_ends_with( $params['font_size_1024'], 'em' ) ) {
                $data['data-font-size-1024'] = $params['font_size_1024'];
            } else {
                $data['data-font-size-1024'] = $params['font_size_1024'] . 'px';
            }
        }

        if ( $params['font_size_768'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_768'], 'px' ) || struktur_select_string_ends_with( $params['font_size_768'], 'em' ) ) {
                $data['data-font-size-768'] = $params['font_size_768'];
            } else {
                $data['data-font-size-768'] = $params['font_size_768'] . 'px';
            }
        }

        if ( $params['font_size_680'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_680'], 'px' ) || struktur_select_string_ends_with( $params['font_size_680'], 'em' ) ) {
                $data['data-font-size-680'] = $params['font_size_680'];
            } else {
                $data['data-font-size-680'] = $params['font_size_680'] . 'px';
            }
        }

        if ( $params['line_height_1366'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_1366'], 'px' ) || struktur_select_string_ends_with( $params['line_height_1366'], 'em' ) ) {
                $data['data-line-height-1366'] = $params['line_height_1366'];
            } else {
                $data['data-line-height-1366'] = $params['line_height_1366'] . 'px';
            }
        }

        if ( $params['line_height_1024'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_1024'], 'px' ) || struktur_select_string_ends_with( $params['line_height_1024'], 'em' ) ) {
                $data['data-line-height-1024'] = $params['line_height_1024'];
            } else {
                $data['data-line-height-1024'] = $params['line_height_1024'] . 'px';
            }
        }

        if ( $params['line_height_768'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_768'], 'px' ) || struktur_select_string_ends_with( $params['line_height_768'], 'em' ) ) {
                $data['data-line-height-768'] = $params['line_height_768'];
            } else {
                $data['data-line-height-768'] = $params['line_height_768'] . 'px';
            }
        }

        if ( $params['line_height_680'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_680'], 'px' ) || struktur_select_string_ends_with( $params['line_height_680'], 'em' ) ) {
                $data['data-line-height-680'] = $params['line_height_680'];
            } else {
                $data['data-line-height-680'] = $params['line_height_680'] . 'px';
            }
        }

        return $data;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorOutlineText() );