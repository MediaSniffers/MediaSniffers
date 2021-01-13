<?php

class StrukturCoreElementorOutroSection extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_outro_section';
    }

    public function get_title() {
        return esc_html__( "Outro Section", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-outro-section';
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
            'title',
            [
                'label' => esc_html__( "Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( "Subtitle", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label' => esc_html__( "Tagline", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( "Link", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label' => esc_html__( "Link Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $this->add_control(
            'link_target',
            [
                'label' => esc_html__( "Link target", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $args = array(
            'title'     => '',
            'subtitle'  => '',
            'tagline'   => '',
            'link'              => '',
            'link_text'         => '',
            'link_target'       => '',
        );

        $params = shortcode_atts($args, $params);
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);

        echo struktur_core_get_shortcode_module_template_part('templates/outro-section-template', 'outro-section', '', $params);
    }

    private function svgPatternStyle($params) {
        $itemStyle = array();

        $svg = struktur_select_get_svg('inverted-pattern', '#181818');
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode($svg) . "')";

        return implode(';', $itemStyle);
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorOutroSection() );