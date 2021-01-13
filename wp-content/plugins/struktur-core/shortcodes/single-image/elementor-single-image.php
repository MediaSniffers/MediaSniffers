<?php

class StrukturCoreElementorSingleImage extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_single_image';
    }

    public function get_title() {
        return esc_html__( 'Single Image', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-single-image';
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
            'overlay_pattern',
            [
                'label'   => esc_html__( 'Enable Pattern Overlay', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'overlay_pattern_color',
            [
                'label'   => esc_html__( 'Overlay Pattern Color', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'overlay_pattern' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'image_behavior',
            [
                'label'   => esc_html__( 'Image Behavior', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''            => esc_html__( 'None', 'struktur-core' ),
                    'lightbox'    => esc_html__( 'Open Lightbox', 'struktur-core' ),
                    'custom-link' => esc_html__( 'Open Custom Link', 'struktur-core' ),
                    'zoom'        => esc_html__( 'Zoom', 'struktur-core' ),
                    'grayscale'   => esc_html__( 'Grayscale', 'struktur-core' ),
                    'moving'      => esc_html__( 'Moving on Hover', 'struktur-core' ),
                ],
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
            'custom_link_target',
            [
                'label'     => esc_html__( 'Custom Link Target', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_link_target_array(),
                'condition' => [
                    'image_behavior' => array( 'custom-link' )
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args = array(
            'image'               => '',
            'image_size'          => 'full',
            'enable_image_shadow' => 'no',
            'image_behavior'      => '',
            'custom_link'         => '',
            'custom_link_target'  => '_self'
        );

        if ( ! empty( $params['image'] ) ) {
            $params['image'] = $params['image']['id'];
        }

        $params['holder_classes']     = $this->getHolderClasses( $params );
        $params['holder_styles']      = $this->getHolderStyles( $params );
        $params['image']              = $this->getImage( $params );
        $params['image_size']         = $this->getImageSize( $params['image_size'] );
        $params['svg_pattern_style']  = $this->svgPatternStyle($params);
        $params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
        $params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/single-image', 'single-image', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'qodef-has-shadow' : '';
        $holderClasses[] = ! empty( $params['image_behavior'] ) ? 'qodef-image-behavior-' . $params['image_behavior'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['image'] ) && $params['image_behavior'] === 'moving' ) {
            $image_original = wp_get_attachment_image_src( $params['image'], 'full' );

            $styles[] = 'background-image: url(' . $image_original[0] . ')';
        }

        return implode( ';', $styles );
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

    private function svgPatternStyle($params) {
        $itemStyle = array();

        $svg = struktur_select_get_svg( 'pattern', $params['overlay_pattern_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";

        return implode( ';', $itemStyle );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorSingleImage() );