<?php

class StrukturCoreElementorCounter extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_enqueue_script( 'counter', STRUKTUR_CORE_SHORTCODES_URL_PATH . '/counter/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'absoluteCounter', STRUKTUR_CORE_SHORTCODES_URL_PATH . '/counter/assets/js/plugins/absoluteCounter.min.js', array( 'jquery' ), false, true );
    }

    public function get_name() {
        return 'qodef_counter';
    }

    public function get_title() {
        return esc_html__( 'Counter', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-counter';
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
                    'qodef-zero-counter'   => esc_html__( 'Zero Counter', 'struktur-core' ),
                    'qodef-random-counter' => esc_html__( 'Random Counter', 'struktur-core' )
                ]
            ]
        );

        $this->add_control(
            'digit',
            [
                'label'       => esc_html__( 'Digit', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'digit_font_size',
            [
                'label'       => esc_html__( 'Digit Font Size (px)', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'digit!' => ''
                ],
            ]
        );

        $this->add_control(
            'digit_color',
            [
                'label'     => esc_html__( 'Digit Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'digit!' => ''
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
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
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $this->add_control(
            'title_font_weight',
            [
                'label'   => esc_html__( 'Title Font Weight', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_weight_array( true ),
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text!' => ''
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'custom_class'      => '',
            'type'              => 'qodef-zero-counter',
            'digit'             => '123',
            'digit_font_size'   => '',
            'digit_color'       => '',
            'title'             => '',
            'title_tag'         => 'h4',
            'title_color'       => '',
            'title_font_weight' => '',
            'text'              => '',
            'text_color'        => ''
        );

        $params['holder_classes']       = $this->getHolderClasses( $params );
        $params['counter_styles']       = $this->getCounterStyles( $params );
        $params['counter_title_styles'] = $this->getCounterTitleStyles( $params );
        $params['counter_text_styles']  = $this->getCounterTextStyles( $params );

        $params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/counter', 'counter', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getCounterStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['digit_font_size'] ) ) {
            $styles[] = 'font-size: ' . struktur_select_filter_px( $params['digit_font_size'] ) . 'px';
        }

        if ( ! empty( $params['digit_color'] ) ) {
            $styles[] = 'color: ' . $params['digit_color'];
        }

        return implode( ';', $styles );
    }

    private function getCounterTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        if ( ! empty( $params['title_font_weight'] ) ) {
            $styles[] = 'font-weight: ' . $params['title_font_weight'];
        }

        return implode( ';', $styles );
    }

    private function getCounterTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorCounter() );