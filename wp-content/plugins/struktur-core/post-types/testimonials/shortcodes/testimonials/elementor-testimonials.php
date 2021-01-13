<?php

class StrukturCoreElementorElementorTestimonials extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Testimonials', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-testimonials';
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
            'skin',
            [
                'label'   => esc_html__( 'Skin', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''      => esc_html__( 'Default', 'struktur-core' ),
                    'light' => esc_html__( 'Light', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'   => esc_html__( 'Background color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'quote_color',
            [
                'label'   => esc_html__( 'Quote color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'number',
            [
                'label'   => esc_html__( 'Number of Testimonials', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );

        $this->add_control(
            'category',
            [
                'label'   => esc_html__( 'Category', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'struktur-core' )

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => esc_html__( 'Slider Settings', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Enable Slider Loop', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Enable Slider Autoplay', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'   => esc_html__( 'Slide Duration', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'struktur-core' ),
                'default' => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'   => esc_html__( 'Slide Animation Duration', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'struktur-core' ),
                'default' => '600'
            ]
        );

        $this->add_control(
            'slider_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'condition' => [
                    'type' => array( 'boxed', 'boxed-text', 'standard', 'image-pagination' )
                ],
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_pagination',
            [
                'label'   => esc_html__( 'Enable Slider Pagination', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'condition' => [
                    'type' => array( 'boxed', 'boxed-text', 'standard', 'image-pagination' )
                ],
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args = array(
            'type'                    => '',
            'skin'                    => '',
            'background_color'        => '',
            'quote_color'             => '',
            'title'                   => '',
            'number'                  => '-1',
            'category'                => '',
            'box_color'               => '',
            'number_of_visible_items' => '3',
            'slider_loop'             => 'yes',
            'slider_autoplay'         => 'yes',
            'slider_speed'            => '5000',
            'slider_speed_animation'  => '600',
            'slider_navigation'       => 'yes',
            'slider_pagination'       => 'yes'
        );

        $params = shortcode_atts( $args, $params );

        $params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'standard';

        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_styles'] = $this->getHolderStyles( $params );
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);

        $params['query_args']    = $this->getQueryParams( $params );
        $params['query_results'] = new \WP_Query( $params['query_args'] );

        $params['data_attr'] = $this->getSliderData( $params );

        echo struktur_core_get_cpt_shortcode_module_template_part( 'testimonials', 'testimonials', 'testimonials-' . $params['type'], '', $params );

    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = 'qodef-testimonials-' . $params['type'];
        $holderClasses[] = ! empty( $params['skin'] ) ? 'qodef-testimonials-' . $params['skin'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['background_color'] ) ) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        return implode( ';', $styles );
    }

    private function svgPatternStyle( $params ) {
        $itemStyle = array();

        $svg = struktur_select_get_svg( 'inverted-pattern', $params['background_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";

        return implode( ';', $itemStyle );
    }

    private function getQueryParams( $params ) {
        $args = array(
            'post_status'    => 'publish',
            'post_type'      => 'testimonials',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ( $params['category'] != '' ) {
            $args['testimonials-category'] = $params['category'];
        }

        return $args;
    }

    private function getSliderData( $params ) {
        $slider_data = array();

        $slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

        return $slider_data;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorElementorTestimonials() );