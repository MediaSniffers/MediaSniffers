<?php

class StrukturCoreElementorSeparator extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_separator';
    }

    public function get_title() {
        return esc_html__( 'Separator', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-separator';
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
                    'normal'     => esc_html__( 'Normal', 'struktur-core' ),
                    'full-width' => esc_html__( 'Full Width', 'struktur-core' )
                ],
            ]
        );

        $this->add_control(
            'position',
            [
                'label'     => esc_html__( 'Position', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'center' => esc_html__( 'Center', 'struktur-core' ),
                    'left'   => esc_html__( 'Left', 'struktur-core' ),
                    'right'  => esc_html__( 'Right', 'struktur-core' ),
                ],
                'condition' => [
                    'type' => array( 'normal' )
                ],
                'default'   => 'center'
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'border_style',
            [
                'label'   => esc_html__( 'Style', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__( 'Default', 'struktur-core' ),
                    'dashed' => esc_html__( 'Dashed', 'struktur-core' ),
                    'solid'  => esc_html__( 'Solid', 'struktur-core' ),
                    'dotted' => esc_html__( 'Dotted', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'width',
            [
                'label'     => esc_html__( 'Width (px or %)', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'type' => array( 'normal' )
                ],
            ]
        );

        $this->add_control(
            'thickness',
            [
                'label' => esc_html__( 'Thickness (px)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'top_margin',
            [
                'label' => esc_html__( 'Top Margin (px or %)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'bottom_margin',
            [
                'label' => esc_html__( 'Bottom Margin (px or %)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_styles']  = $this->getHolderStyles( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/separator-template', 'separator', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['position'] ) ? 'qodef-separator-' . $params['position'] : '';
        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-separator-' . $params['type'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( $params['color'] !== '' ) {
            $styles[] = 'border-color: ' . $params['color'];
        }

        if ( $params['border_style'] !== '' ) {
            $styles[] = 'border-style: ' . $params['border_style'];
        }

        if ( $params['width'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['width'], '%' ) || struktur_select_string_ends_with( $params['width'], 'px' ) ) {
                $styles[] = 'width: ' . $params['width'];
            } else {
                $styles[] = 'width: ' . struktur_select_filter_px( $params['width'] ) . 'px';
            }
        }

        if ( $params['thickness'] !== '' ) {
            $styles[] = 'border-bottom-width: ' . struktur_select_filter_px( $params['thickness'] ) . 'px';
        }

        if ( $params['top_margin'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['top_margin'], '%' ) || struktur_select_string_ends_with( $params['top_margin'], 'px' ) ) {
                $styles[] = 'margin-top: ' . $params['top_margin'];
            } else {
                $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['top_margin'] ) . 'px';
            }
        }

        if ( $params['bottom_margin'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['bottom_margin'], '%' ) || struktur_select_string_ends_with( $params['bottom_margin'], 'px' ) ) {
                $styles[] = 'margin-bottom: ' . $params['bottom_margin'];
            } else {
                $styles[] = 'margin-bottom: ' . struktur_select_filter_px( $params['bottom_margin'] ) . 'px';
            }
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorSeparator() );