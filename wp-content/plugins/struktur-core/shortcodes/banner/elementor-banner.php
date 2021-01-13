<?php

class StrukturCoreElementorBanner extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_banner';
    }

    public function get_title() {
        return esc_html__( 'Banner', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-banner';
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
            'image',
            [
                'label'       => esc_html__( 'Image', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'struktur-core' )
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__( 'Image Overlay Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'hover_behavior',
            [
                'label'   => esc_html__( 'Hover Behavior', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qodef-visible-on-hover'   => esc_html__( 'Visible on Hover', 'struktur-core' ),
                    'qodef-visible-on-default' => esc_html__( 'Visible on Default', 'struktur-core' ),
                    'qodef-disabled'           => esc_html__( 'Disabled', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'info_position',
            [
                'label'   => esc_html__( 'Info Position', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default'  => esc_html__( 'Default', 'struktur-core' ),
                    'centered' => esc_html__( 'Centered', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'info_content_padding',
            [
                'label'       => esc_html__( 'Info Content Padding', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Please insert padding in format top right bottom left', 'struktur-core' )
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'subtitle_tag',
            [
                'label'     => esc_html__( 'Subtitle Tag', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'condition' => [
                    'subtitle!' => ''
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => esc_html__( 'Subtitle Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'subtitle!' => ''
                ],
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
                'options'   => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $this->add_control(
            'title_light_words',
            [
                'label'       => esc_html__( 'Words with Light Font Weight', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition'   => [
                    'title!' => ''
                ],
                'description' => esc_html__( 'Enter the positions of the words you would like to display in a "light" font weight. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a light font weight, you would enter "1,3,4")', 'struktur-core' ),
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
            'title_top_margin',
            [
                'label'     => esc_html__( 'Title Top Margin (px)', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'target',
            [
                'label'     => esc_html__( 'Target', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_link_target_array(),
                'condition' => [
                    'link!' => ''
                ],
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label'     => esc_html__( 'Link Text', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'link!' => ''
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => esc_html__( 'Link Text Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'link!' => ''
                ],
            ]
        );

        $this->add_control(
            'link_top_margin',
            [
                'label'     => esc_html__( 'Link Text Top Margin (px)', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'link!' => ''
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'custom_class'         => '',
            'image'                => '',
            'overlay_color'        => '',
            'hover_behavior'       => 'qodef-visible-on-hover',
            'info_position'        => 'default',
            'info_content_padding' => '',
            'subtitle'             => '',
            'subtitle_tag'         => 'h5',
            'subtitle_color'       => '',
            'title'                => '',
            'title_tag'            => 'h2',
            'title_light_words'    => '',
            'title_color'          => '',
            'title_top_margin'     => '',
            'link'                 => '',
            'target'               => '_self',
            'link_text'            => '',
            'link_color'           => '',
            'link_top_margin'      => ''
        );

        $params['holder_classes']  = $this->getHolderClasses( $params, $args );
        $params['overlay_styles']  = $this->getOverlayStyles( $params );
        $params['subtitle_tag']    = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $args['subtitle_tag'];
        $params['subtitle_styles'] = $this->getSubitleStyles( $params );
        $params['title']           = $this->getModifiedTitle( $params );
        $params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
        $params['title_styles']    = $this->getTitleStyles( $params );
        $params['link_styles']     = $this->getLinkStyles( $params );

        if( ! empty( $params['image'] ) ){
            $params['image'] = $params['image']['id'];
        }

        echo struktur_core_get_shortcode_module_template_part( 'templates/banner', 'banner', '', $params );
    }

    private function getHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['hover_behavior'] ) ? $params['hover_behavior'] : $args['hover_behavior'];
        $holderClasses[] = ! empty( $params['info_position'] ) ? 'qodef-banner-info-' . $params['info_position'] : 'qodef-banner-info-' . $args['info_position'];

        return implode( ' ', $holderClasses );
    }

    private function getOverlayStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['overlay_color'] ) ) {
            $styles[] = 'background-color: ' . $params['overlay_color'];
        }

        if ( ! empty( $params['info_content_padding'] ) ) {
            $styles[] = 'padding: ' . $params['info_content_padding'];
        }

        return implode( ';', $styles );
    }

    private function getSubitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['subtitle_color'] ) ) {
            $styles[] = 'color: ' . $params['subtitle_color'];
        }

        return implode( ';', $styles );
    }

    private function getModifiedTitle( $params ) {
        $title             = $params['title'];
        $title_light_words = str_replace( ' ', '', $params['title_light_words'] );

        if ( ! empty( $title ) ) {
            $light_words = explode( ',', $title_light_words );
            $split_title = explode( ' ', $title );

            if ( ! empty( $title_light_words ) ) {
                foreach ( $light_words as $value ) {
                    if ( ! empty( $split_title[ $value - 1 ] ) ) {
                        $split_title[ $value - 1 ] = '<span class="qodef-banner-title-light">' . $split_title[ $value - 1 ] . '</span>';
                    }
                }
            }

            $title = implode( ' ', $split_title );
        }

        return $title;
    }

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        if ( ! empty( $params['title_top_margin'] ) ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['title_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getLinkStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['link_color'] ) ) {
            $styles[] = 'color: ' . $params['link_color'];
        }

        if ( ! empty( $params['link_top_margin'] ) ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['link_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorBanner() );
