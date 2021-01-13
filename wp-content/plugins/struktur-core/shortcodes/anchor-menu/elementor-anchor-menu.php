<?php

class StrukturCoreElementorAnchorMenu extends \Elementor\Widget_Base {

    public function get_name() {
        return 'struktur_anchor_menu';
    }

    public function get_title() {
        return esc_html__( 'Anchor Menu', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-anchor-menu';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => esc_html__( 'Label', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'anchor',
            [
                'label'       => esc_html__( 'Anchor Link', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'For example #home. Same anchor link you need to set for Row shortcode -> Select Anchor ID field', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Label Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'label!' => ''
                ]
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label'       => esc_html__( 'Menu Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Menu Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        echo struktur_core_get_shortcode_module_template_part( 'templates/anchor-menu', 'anchor-menu', '', $params );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorAnchorMenu() );