<?php

class StrukturCoreElementorPieChart extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_enqueue_script( 'counter', STRUKTUR_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'easypiechart', STRUKTUR_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/easypiechart.js', array( 'jquery' ), false, true );
    }

    public function get_name() {
        return 'qodef_pie_chart';
    }

    public function get_title() {
        return esc_html__( 'Pie Chart', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-pie-chart';
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
            'percent',
            [
                'label'   => esc_html__( 'Percentage', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '69%'
            ]
        );

        $this->add_control(
            'percent_color',
            [
                'label'     => esc_html__( 'Percentage Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'percent!' => ''
                ],
            ]
        );

        $this->add_control(
            'active_color',
            [
                'label' => esc_html__( 'Pie Chart Active Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'inactive_color',
            [
                'label' => esc_html__( 'Pie Chart Inactive Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => esc_html__( 'Pie Chart Size (px)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title Tag', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_title_tag( true ),
                'condition' => [
                    'title!' => ''
                ],
                'default'   => 'h6'
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

        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['pie_chart_data'] = $this->getPieChartData( $params );
        $params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h6';
        $params['percent_styles'] = $this->getPercentStyles( $params );
        $params['title_styles']   = $this->getTitleStyles( $params );
        $params['text_styles']    = $this->getTextStyles( $params );
        $params['svg_style']      = $this->getSvgStyle( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/pie-chart', 'pie-chart', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getPieChartData( $params ) {
        $data = array();

        if ( ! empty( $params['percent'] ) ) {
            $data['data-percent'] = $params['percent'];
        }
        if ( ! empty( $params['size'] ) ) {
            $data['data-size'] = $params['size'];
        }
        if ( ! empty( $params['active_color'] ) ) {
            $data['data-bar-color'] = $params['active_color'];
        }
        if ( ! empty( $params['inactive_color'] ) ) {
            $data['data-track-color'] = $params['inactive_color'];
        }

        return $data;
    }

    private function getPercentStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['percent_color'] ) ) {
            $styles[] = 'color: ' . $params['percent_color'];
        }

        return implode( ';', $styles );
    }

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        return implode( ';', $styles );
    }

    private function getTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        return implode( ';', $styles );
    }

    private function getSvgStyle( $params ) {
        $styles = array();

        if ( ! empty( $params['inactive_color'] ) ) {
            $styles[] = 'fill: ' . $params['inactive_color'];
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorPieChart() );