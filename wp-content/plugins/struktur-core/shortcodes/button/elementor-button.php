<?php

class StrukturCoreElementorButton extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_button';
    }

    public function get_title() {
        return esc_html__( "Button", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-button';
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
                    'solid' => esc_html__( 'Solid', 'struktur-core' ),
                    'outline' => esc_html__( 'Outline', 'struktur-core' ),
                    'simple' => esc_html__( 'Simple', 'struktur-core' )
                ],
                'default' => 'solid'
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => esc_html__( "Size", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__( 'Default', 'struktur-core' ),
                    'small'  => esc_html__( 'Small', 'struktur-core' ),
                    'medium' => esc_html__( 'Medium', 'struktur-core' ),
                    'large'  => esc_html__( 'Large', 'struktur-core' ),
                    'huge'   => esc_html__( 'Huge', 'struktur-core' )
                ],
                'default' => 'medium',
                'condition' => [
                    'type' => array( 'solid', 'outline' )
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( "Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Button Text', 'struktur-core' )
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
            'target',
            [
                'label' => esc_html__( "Link Target", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array()
            ]
        );

        struktur_select_icon_collections()->getElementorParamsArray($this, '', '', true);

        $this->end_controls_section();

        $this->start_controls_section(
            'design',
            [
                'label' => esc_html__( 'Design Options', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( "Button Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => esc_html__( "Hover Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( "Background Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'solid' )
                ]
            ]
        );

        $this->add_control(
            'hover_background_color',
            [
                'label' => esc_html__( "Hover Background Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'solid', 'outline' )
                ]
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( "Border Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'solid' , 'outline' )
                ]
            ]
        );

        $this->add_control(
            'hover_border_color',
            [
                'label' => esc_html__( "Hover Border Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'type' => array( 'solid' , 'outline' )
                ]
            ]
        );

        $this->add_control(
            'font_size',
            [
                'label' => esc_html__( "Font Size (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'font_weight',
            [
                'label' => esc_html__( "Font Weight", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_weight_array( true )
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => esc_html__( "Text Transform", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_text_transform_array( true )
            ]
        );

        $this->add_control(
            'margin',
            [
                'label' => esc_html__( "Margin", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'struktur-core' ),
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => esc_html__( "Button Padding", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'struktur-core' ),
                'condition' => [
                    'type' => array( 'solid', 'outline' )
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $params['icon'] = struktur_select_icon_collections()->getElementorIconFromIconPack( $params );

        $params['html_type'] = 'anchor';
        $params['input_name'] = '';
        $params['custom_attrs'] = '';

        if ( $params['html_type'] !== 'input' ) {
            $iconPackName   = struktur_select_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
            $params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
        }

        $params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
        $params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';

        $params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
        $params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];

        $params['button_classes']      = $this->getButtonClasses( $params );
        $params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
        $params['button_styles']       = $this->getButtonStyles( $params );
        $params['button_data']         = $this->getButtonDataAttr( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
    }

    private function getButtonStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['color'] ) ) {
            $styles[] = 'color: ' . $params['color'];
        }

        if ( ! empty( $params['background_color'] ) && $params['type'] !== 'outline' ) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        if ( ! empty( $params['border_color'] ) ) {
            $styles[] = 'border-color: ' . $params['border_color'];
        }

        if ( ! empty( $params['font_size'] ) ) {
            $styles[] = 'font-size: ' . struktur_select_filter_px( $params['font_size'] ) . 'px';
        }

        if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
            $styles[] = 'font-weight: ' . $params['font_weight'];
        }

        if ( ! empty( $params['text_transform'] ) ) {
            $styles[] = 'text-transform: ' . $params['text_transform'];
        }

        if ( $params['margin'] !== '' ) {
            $styles[] = 'margin: ' . $params['margin'];
        }

        if ( $params['padding'] !== '' ) {
            $styles[] = 'padding: ' . $params['padding'];
        }

        return $styles;
    }

    private function getButtonDataAttr( $params ) {
        $data = array();

        if ( ! empty( $params['hover_color'] ) ) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if ( ! empty( $params['hover_background_color'] ) ) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if ( ! empty( $params['hover_border_color'] ) ) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        return $data;
    }

    private function getButtonClasses( $params ) {
        $buttonClasses = array(
            'qodef-btn',
            'qodef-btn-' . $params['size'],
            'qodef-btn-' . $params['type']
        );

        if ( ! empty( $params['hover_background_color'] ) ) {
            $buttonClasses[] = 'qodef-btn-custom-hover-bg';
        }

        if ( ! empty( $params['hover_border_color'] ) ) {
            $buttonClasses[] = 'qodef-btn-custom-border-hover';
        }

        if ( ! empty( $params['hover_color'] ) ) {
            $buttonClasses[] = 'qodef-btn-custom-hover-color';
        }

        if ( ! empty( $params['icon'] ) ) {
            $buttonClasses[] = 'qodef-btn-icon';
        }

        if ( ! empty( $params['custom_class'] ) ) {
            $buttonClasses[] = esc_attr( $params['custom_class'] );
        }

        return $buttonClasses;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorButton() );