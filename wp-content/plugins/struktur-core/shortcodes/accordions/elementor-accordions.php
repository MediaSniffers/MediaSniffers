<?php

class StrukturCoreElementorAccordion extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_enqueue_script( 'jquery-ui-accordion' );
    }

    public function get_name() {
        return 'qodef_accordion';
    }

    public function get_title() {
        return esc_html__( 'Accordion', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-accordions';
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
            'style',
            [
                'label'   => esc_html__( 'Style', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'accordion' => esc_html__( 'Accordion', 'struktur-core' ),
                    'toggle'    => esc_html__( 'Toggle', 'struktur-core' )
                ],
                'default' => 'accordion'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter accordion section title', 'struktur-core' ),
                'default'     => 'Section'
            ]
        );

        $repeater->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'default' => 'h5'
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'select-core'),
                'type' => \Elementor\Controls_Manager::WYSIWYG
            ]
        );

        struktur_core_generate_elementor_templates_control( $repeater, array('content' => '') );

        $this->add_control(
            'accordion_tab',
            [
                'label'       => esc_html__( 'Accordion Tabs', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Accordion Tab' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses( $params );
        ?>

        <div class="qodef-accordion-holder qodef-ac-simple <?php echo esc_attr( $params['holder_classes'] ); ?> clearfix">
            <?php foreach ( $params['accordion_tab'] as $tab ) {

                if( empty( $tab['content'] ) ){
                    $tab['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tab['template_id'] );
                };

                echo struktur_core_get_shortcode_module_template_part( 'templates/accordion-template', 'accordions', '', $tab );
            } ?>
        </div>
        <?php
    }

    private function getHolderClasses( $params ) {
        $holder_classes = array( 'qodef-ac-default' );

        $holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holder_classes[] = $params['style'] == 'toggle' ? 'qodef-toggle' : 'qodef-accordion';
        $holder_classes[] = ! empty( $params['background_skin'] ) ? 'qodef-' . esc_attr( $params['background_skin'] ) . '-skin' : '';

        return implode( ' ', $holder_classes );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorAccordion() );