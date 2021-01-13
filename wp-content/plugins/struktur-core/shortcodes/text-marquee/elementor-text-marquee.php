<?php

class StrukturCoreElementorTextMarquee extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_text_marquee';
    }

    public function get_title() {
        return esc_html__( 'Text Marquee', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-text-marquee';
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
            'text',
            [
                'label' => esc_html__( 'Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Text Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'font_size',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'font_weight',
            [
                'label'   => esc_html__( 'Font Weight', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_weight_array( true )
            ]
        );

        $this->add_control(
            'font_style',
            [
                'label'   => esc_html__( 'Font Style', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_style_array( true )
            ]
        );

        $this->add_control(
            'letter_spacing',
            [
                'label' => esc_html__( 'Letter Spacing (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label'   => esc_html__( 'Text Transform', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_text_transform_array( true )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'laptops',
            [
                'label' => esc_html__( 'Laptops', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_1366',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_1366',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tablets_landscape',
            [
                'label' => esc_html__( 'Tablets Landscape', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_1024',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_1024',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tablets_portrait',
            [
                'label' => esc_html__( 'Tablets Landscape', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_768',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_768',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mobiles',
            [
                'label' => esc_html__( 'Mobiles', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size_680',
            [
                'label' => esc_html__( 'Font Size (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'line_height_680',
            [
                'label' => esc_html__( 'Line Height (px or em)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_rand_class'] = 'qodef-tm-' . mt_rand( 1000, 10000 );
        $params['holder_classes']    = $this->getHolderClasses( $params );
        $params['text_styles']       = $this->getTextStyles( $params );
        $params['text_data']         = $this->getTextData( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/text-marquee', 'text-marquee', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['color'] ) ) {
            $styles[] = 'color: ' . $params['color'];
        }

        if ( ! empty( $params['font_size'] ) ) {
            if ( struktur_select_string_ends_with( $params['font_size'], 'px' ) || struktur_select_string_ends_with( $params['font_size'], 'em' ) ) {
                $styles[] = 'font-size: ' . $params['font_size'];
            } else {
                $styles[] = 'font-size: ' . $params['font_size'] . 'px';
            }
        }

        if ( ! empty( $params['line_height'] ) ) {
            if ( struktur_select_string_ends_with( $params['line_height'], 'px' ) || struktur_select_string_ends_with( $params['line_height'], 'em' ) ) {
                $styles[] = 'line-height: ' . $params['line_height'];
            } else {
                $styles[] = 'line-height: ' . $params['line_height'] . 'px';
            }
        }

        if ( ! empty( $params['font_weight'] ) ) {
            $styles[] = 'font-weight: ' . $params['font_weight'];
        }

        if ( ! empty( $params['font_style'] ) ) {
            $styles[] = 'font-style: ' . $params['font_style'];
        }

        if ( ! empty( $params['letter_spacing'] ) ) {
            if ( struktur_select_string_ends_with( $params['letter_spacing'], 'px' ) || struktur_select_string_ends_with( $params['letter_spacing'], 'em' ) ) {
                $styles[] = 'letter-spacing: ' . $params['letter_spacing'];
            } else {
                $styles[] = 'letter-spacing: ' . $params['letter_spacing'] . 'px';
            }
        }

        if ( ! empty( $params['text_transform'] ) ) {
            $styles[] = 'text-transform: ' . $params['text_transform'];
        }

        return implode( ';', $styles );
    }

    private function getTextData( $params ) {
        $data                    = array();
        $data['data-item-class'] = $params['holder_rand_class'];

        if ( $params['font_size_1366'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_1366'], 'px' ) || struktur_select_string_ends_with( $params['font_size_1366'], 'em' ) ) {
                $data['data-font-size-1366'] = $params['font_size_1366'];
            } else {
                $data['data-font-size-1366'] = $params['font_size_1366'] . 'px';
            }
        }

        if ( $params['font_size_1024'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_1024'], 'px' ) || struktur_select_string_ends_with( $params['font_size_1024'], 'em' ) ) {
                $data['data-font-size-1024'] = $params['font_size_1024'];
            } else {
                $data['data-font-size-1024'] = $params['font_size_1024'] . 'px';
            }
        }

        if ( $params['font_size_768'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_768'], 'px' ) || struktur_select_string_ends_with( $params['font_size_768'], 'em' ) ) {
                $data['data-font-size-768'] = $params['font_size_768'];
            } else {
                $data['data-font-size-768'] = $params['font_size_768'] . 'px';
            }
        }

        if ( $params['font_size_680'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['font_size_680'], 'px' ) || struktur_select_string_ends_with( $params['font_size_680'], 'em' ) ) {
                $data['data-font-size-680'] = $params['font_size_680'];
            } else {
                $data['data-font-size-680'] = $params['font_size_680'] . 'px';
            }
        }

        if ( $params['line_height_1366'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_1366'], 'px' ) || struktur_select_string_ends_with( $params['line_height_1366'], 'em' ) ) {
                $data['data-line-height-1366'] = $params['line_height_1366'];
            } else {
                $data['data-line-height-1366'] = $params['line_height_1366'] . 'px';
            }
        }

        if ( $params['line_height_1024'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_1024'], 'px' ) || struktur_select_string_ends_with( $params['line_height_1024'], 'em' ) ) {
                $data['data-line-height-1024'] = $params['line_height_1024'];
            } else {
                $data['data-line-height-1024'] = $params['line_height_1024'] . 'px';
            }
        }

        if ( $params['line_height_768'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_768'], 'px' ) || struktur_select_string_ends_with( $params['line_height_768'], 'em' ) ) {
                $data['data-line-height-768'] = $params['line_height_768'];
            } else {
                $data['data-line-height-768'] = $params['line_height_768'] . 'px';
            }
        }

        if ( $params['line_height_680'] !== '' ) {
            if ( struktur_select_string_ends_with( $params['line_height_680'], 'px' ) || struktur_select_string_ends_with( $params['line_height_680'], 'em' ) ) {
                $data['data-line-height-680'] = $params['line_height_680'];
            } else {
                $data['data-line-height-680'] = $params['line_height_680'] . 'px';
            }
        }

        return $data;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorTextMarquee() );