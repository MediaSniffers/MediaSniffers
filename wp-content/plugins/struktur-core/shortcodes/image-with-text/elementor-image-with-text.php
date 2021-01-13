<?php

class StrukturCoreElementorImageWithText extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_image_with_text';
    }

    public function get_title() {
        return esc_html__( 'Image With Text', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-image-with-text';
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
            'image_size',
            [
                'label'       => esc_html__( 'Image Size', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'struktur-core' ),
                'default'     => 'full'
            ]

        );

        $this->add_control(
            'enable_image_shadow',
            [
                'label'   => esc_html__( 'Enable Image Shadow', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'image_behavior',
            [
                'label'   => esc_html__( 'Image Behavior', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''                  => esc_html__( 'None', 'struktur-core' ),
                    'lightbox'          => esc_html__( 'Open Lightbox', 'struktur-core' ),
                    'custom-link'       => esc_html__( 'Open Custom Link', 'struktur-core' ),
                    'links-over-image'  => esc_html__( 'Links Over Image', 'struktur-core' ),
                    'zoom'              => esc_html__( 'Zoom', 'struktur-core' ),
                    'grayscale'         => esc_html__( 'Grayscale', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'enable_custom_cursor',
            [
                'label'   => esc_html__( 'Enable Custom Cursor', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'default' => 'no',
                'condition' => [
                    'image_behavior' => array( 'custom-link','lightbox','links-over-image')
                ]
            ]
        );

        $this->add_control(
            'custom_link',
            [
                'label'     => esc_html__( 'Custom Link', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_behavior' => array( 'custom-link' )
                ],
            ]
        );

        $this->add_control(
            'custom_link_one',
            [
                'label'     => esc_html__( 'Custom Link One', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_behavior' => array( 'links-over-image' )
                ],
            ]
        );

        $this->add_control(
            'link_text_one',
            [
                'label'     => esc_html__( 'Link Text One', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_behavior' => array( 'links-over-image' )
                ],
            ]
        );

        $this->add_control(
            'custom_link_two',
            [
                'label'     => esc_html__( 'Custom Link Two', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_behavior' => array( 'links-over-image' )
                ],
            ]
        );

        $this->add_control(
            'link_text_two',
            [
                'label'     => esc_html__( 'Link Text Two', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_behavior' => array( 'links-over-image' )
                ],
            ]
        );

        $this->add_control(
            'custom_link_target',
            [
                'label'     => esc_html__( 'Custom Link Target', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_link_target_array(),
                'condition' => [
                    'image_behavior' => array( 'custom-link','links-over-image' )
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
                'options'   => struktur_select_get_title_tag( true ) ,
                'condition' => [
                    'title!' => ''
                ],
                'default'   => 'h4'
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
            'number',
            [
                'label' => esc_html__( 'Number', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
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

        $this->add_control(
            'text_top_margin',
            [
                'label'     => esc_html__( 'Text Top Margin (px)', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        if ( ! empty( $params['image'] ) ) {
            $params['image'] = $params['image']['id'];
        }

        $params['holder_classes']     = $this->getHolderClasses( $params );
        $params['image']              = $this->getImage( $params );
        $params['image_size']         = $this->getImageSize( $params['image_size'] );
        $params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : '';
        $params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : '_self';
        $params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h4';
        $params['title_styles']       = $this->getTitleStyles( $params );
        $params['text_styles']        = $this->getTextStyles( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/image-with-text', 'image-with-text', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'qodef-has-shadow' : '';
        $holderClasses[] = $params['enable_custom_cursor'] === 'yes' ? 'qodef-iwt-custom-cursor' : '';
        $holderClasses[] = ! empty( $params['image_behavior'] ) ? 'qodef-image-behavior-' . $params['image_behavior'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getImage( $params ) {
        $image = array();

        if ( ! empty( $params['image'] ) ) {
            $id = $params['image'];

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src( $id, 'full' );
            $image['url']      = $image_original[0];
            $image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
        }

        return $image;
    }

    private function getImageSize( $image_size ) {
        $image_size = trim( $image_size );
        //Find digits
        preg_match_all( '/\d+/', $image_size, $matches );
        if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
            return $image_size;
        } elseif ( ! empty( $matches[0] ) ) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'thumbnail';
        }
    }

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        if ( $params['title_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['title_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        if ( $params['text_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['text_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorImageWithText() );