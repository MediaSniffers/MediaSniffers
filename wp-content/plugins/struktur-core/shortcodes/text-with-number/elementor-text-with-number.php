<?php

class StrukturCoreElementorTextWithNumber extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_text_with_number';
    }

    public function get_title() {
        return esc_html__( "Text With Number", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-text-with-number';
    }

    public function get_categories() {
        return [ 'struktur' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label' => esc_html__( "Custom CSS Class", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'struktur-core' )
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( "Type", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'number_above_text'   => esc_html__( 'Number Above Text', 'struktur-core' ),
                    'with_separators'   => esc_html__( 'With Separators', 'struktur-core' ),
                ],
                'default' => 'number_above_text'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( "Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'number_above_text'
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__( "Number", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'number_above_text'
                ],
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( "Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'condition' => [
                    'type' => 'number_above_text'
                ],
            ]
        );

        $this->add_control(
            'number_of_columns',
            [
                'label' => esc_html__( "Number of Columns", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '3' => esc_html__( 'Three', 'struktur-core' ),
                    '4' => esc_html__( 'Four', 'struktur-core' )
                ],
                'default' => '3',
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( "Title Tag", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'default' => 'h3',
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'number_font_size',
            [
                'label' => esc_html__( "Number Font Size (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( "Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( "Background Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'items',
            [
                'label' => esc_html__( 'Items', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_one',
            [
                'label' => esc_html__( "Title 1", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'number_one',
            [
                'label' => esc_html__( "Number 1", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'title_two',
            [
                'label' => esc_html__( "Title 2", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'number_two',
            [
                'label' => esc_html__( "Number 2", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'title_three',
            [
                'label' => esc_html__( "Title 3", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'number_three',
            [
                'label' => esc_html__( "Number 3", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => 'with_separators'
                ]
            ]
        );

        $this->add_control(
            'title_four',
            [
                'label' => esc_html__( "Title 4", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'number_of_columns' => '4'
                ]
            ]
        );

        $this->add_control(
            'number_four',
            [
                'label' => esc_html__( "Number 4", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'number_of_columns' => '4'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $args   = array(
            'custom_class'        => '',
            'type'                => 'number_above_text',
            'title'               => '',
            'number'              => '',
            'text'                => '',
            'number_of_columns'   => '3',
            'title_one'           => '',
            'title_two'           => '',
            'title_three'         => '',
            'title_four'          => '',
            'title_tag'           => 'h3',
            'number_font_size'    => '',
            'color'               => '',
            'background_color'    => '',
            'number_one'          => '',
            'number_two'          => '',
            'number_three'        => '',
            'number_four'         => '',
        );
        $params = shortcode_atts( $args, $params );

        $params['holder_classes']    = $this->getHolderClasses( $params, $args );
        $params['holder_styles']     = $this->getHolderStyles( $params );
        $params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
        $params['title_styles']      = $this->getTitleStyles( $params );
        $params['number_styles']     = $this->getNumberStyles( $params );
        $params['separator_styles']  = ! empty( $params['color'] ) ? 'background-color:'.$params['color'] : '';
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);

        $params['items'] = array(
            array(
                'title'  => $params['title_one'],
                'number' => $params['number_one']
            ),
            array(
                'title'  => $params['title_two'],
                'number' => $params['number_two']
            ),
            array(
                'title'  => $params['title_three'],
                'number' => $params['number_three']
            ),
            array(
                'title'  => $params['title_four'],
                'number' => $params['number_four']
            ),
        );

        if($params['type'] === 'number_above_text') {
            echo struktur_core_get_shortcode_module_template_part( 'templates/number-above-text', 'text-with-number', '', $params );
        } else {
            echo struktur_core_get_shortcode_module_template_part( 'templates/with-separators', 'text-with-number', '', $params );
        }

    }

    private function getHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['background_color'] ) ) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        return implode( ';', $styles );
    }

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['color'] ) ) {
            $styles[] = 'color: ' . $params['color'];
        }

        return implode( ';', $styles );
    }

    private function getNumberStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['number_font_size'] ) ) {
            $styles[] = 'font-size: ' . struktur_select_filter_px( $params['number_font_size'] ) . 'px';
        }

        if ( ! empty( $params['color'] ) ) {
            $styles[] = 'color: ' . $params['color'];
        }

        return implode( ';', $styles );
    }

    private function svgPatternStyle( $params ) {
        $itemStyle = array();

        $svg = struktur_select_get_svg( 'inverted-pattern', $params['background_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";

        return implode( ';', $itemStyle );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorTextWithNumber() );