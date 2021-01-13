<?php

class StrukturCoreElementorWorkflow extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_workflow';
    }

    public function get_title() {
        return esc_html__( 'Workflow', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-workflow';
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
            'custom_clas',
            [
                'label'   => esc_html__( 'Extra class name', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'struktur-core')
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label'   => esc_html__( 'Workflow line color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'description' => esc_html__('Pick a color for the workflow line.', 'struktur-core')
            ]
        );

        $this->add_control(
            'animate',
            [
                'label'   => esc_html__( 'Animate Workflow', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array(),
                'description' => esc_html__('Animate Workflow shortcode when it comes into viewport', 'struktur-core'),
                'default' => 'yes'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter workflow item title.', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label'       => esc_html__( 'Text', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'description' => esc_html__( 'Enter workflow item text.', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'       => esc_html__( 'Image', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Insert workflow item image.', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'circle_border_color',
            [
                'label'       => esc_html__( 'Circle border color', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'description' => esc_html__( 'Pick a color for the circle border color.', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'circle_background_color',
            [
                'label'       => esc_html__( 'Circle background color', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'description' => esc_html__( 'Pick a color for the circle background color.', 'struktur-core' )
            ]
        );

        $this->add_control(
            'workflow_items',
            [
                'label'       => esc_html__( 'Workflow Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Workflow Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['style_params']= $this->getStyleProperties($params);
        $params['custom_clas'] = $this->getWorkflowClasses($params);

        ?>

            <div class="qodef-workflow <?php echo esc_attr($params['custom_clas']) ?>">
                <span class="main-line" style="<?php echo esc_attr($params['style_params']); ?>"></span>

                <?php foreach ( $params['workflow_items'] as $item ) {

                    if ( ! empty( $item['image'] ) ) {
                        $item['image'] = $item['image']['id'];
                    }

                    $style_params = $this->getItemStyleProperties($item);
                    $item       = array_merge($item, $style_params);
                    extract($item);

                    echo struktur_core_get_shortcode_module_template_part('templates/workflow-item-template', 'workflow', '', $item);
                } ?>
            </div>

        <?php
    }

    private function getWorkflowClasses($params) {

        $custom_clas = '';
        $class    = $params['custom_clas'];

        if($class !== '') {
            $custom_clas = $class;
        }

        if($params['animate'] == 'yes') {
            $custom_clas = 'qodef-workflow-animate';
        }

        return $custom_clas;
    }

    private function getStyleProperties($params) {

        $style                    = array();
        $style['main_line_style'] = '';

        if($params['line_color'] !== '') {
            $style['main_line_style'] = 'background-color:'.$params['line_color'].';';
        }

        return implode( ' ', $style );
    }

    private function getItemStyleProperties($params) {

        $style                            = array();
        $style['circle_border_color']     = '';
        $style['circle_background_color'] = '';
        $style['line_color']              = '';

        if($params['circle_border_color'] !== '') {
            $style['circle_border_color'] = 'border-color:'.$params['circle_border_color'].';';
        }
        if($params['circle_background_color'] !== '') {
            $style['circle_background_color'] = 'background-color:'.$params['circle_background_color'].';';
        }

        return $style;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorWorkflow() );