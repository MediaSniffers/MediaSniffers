<?php

class StrukturCoreElementorImageGallery extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_image_gallery';
    }

    public function get_title() {
        return esc_html__( 'Image Gallery', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-image-gallery';
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
                'label'   => esc_html__( 'Gallery Type', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'grid'     => esc_html__( 'Image Grid', 'struktur-core' ),
                    'masonry'  => esc_html__( 'Masonry', 'struktur-core' ),
                    'slider'   => esc_html__( 'Slider', 'struktur-core' ),
                    'carousel' => esc_html__( 'Carousel', 'struktur-core' ),
                ],
                'default' => 'grid'
            ]
        );

        $this->add_control(
            'images',
            [
                'label'       => esc_html__( 'Images', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::GALLERY,
                'description' => esc_html__( 'Select images from media library', 'struktur-core' )
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'       => esc_html__( 'Image Size', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'struktur-core' ),
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
                    ''            => esc_html__( 'None', 'struktur-core' ),
                    'lightbox'    => esc_html__( 'Open Lightbox', 'struktur-core' ),
                    'custom-link' => esc_html__( 'Open Custom Link', 'struktur-core' ),
                    'zoom'        => esc_html__( 'Zoom', 'struktur-core' ),
                    'grayscale'   => esc_html__( 'Grayscale', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'custom_links',
            [
                'label'       => esc_html__( 'Custom Links', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'description' => esc_html__( 'Delimit links by comma', 'struktur-core' ),
                'condition'   => [
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

        $this->add_control(
            'number_of_columns',
            [
                'label'     => esc_html__( 'Number of Columns', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_number_of_columns_array( true ),
                'condition' => [
                    'type' => array( 'grid', 'masonry' )
                ],
                'default'   => 'three'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label'   => esc_html__( 'Space Between Items', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_settings',
            [
                'label'     => esc_html__( 'Slider Settings', 'struktur-core' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'type' => array( 'slider', 'carousel' )
                ],
            ]
        );

        $this->add_control(
            'number_of_visible_items',
            [
                'label'     => esc_html__( 'Number Of Visible Items', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    '1' => esc_html__( 'One', 'struktur-core' ),
                    '2' => esc_html__( 'Two', 'struktur-core' ),
                    '3' => esc_html__( 'Three', 'struktur-core' ),
                    '4' => esc_html__( 'Four', 'struktur-core' ),
                    '5' => esc_html__( 'Five', 'struktur-core' ),
                    '6' => esc_html__( 'Six', 'struktur-core' ),
                ],
                'condition' => [
                    'type' => array( 'carousel' )
                ],
                'default'   => '1'
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label'     => esc_html__( 'Enable Slider Loop', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_yes_no_select_array( false, true ),
                'condition' => [
                    'type' => array( 'slider', 'carousel' )
                ],
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'     => esc_html__( 'Enable Slider Autoplay', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_yes_no_select_array( false, true ),
                'condition' => [
                    'type' => array( 'slider', 'carousel' )
                ],
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => esc_html__( 'Slide Duration', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition'   => [
                    'type' => array( 'slider', 'carousel' )
                ],
                'description' => esc_html__( 'Default value is 5000 (ms)', 'struktur-core' ),
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'       => esc_html__( 'Slide Animation Duration', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition'   => [
                    'type' => array( 'slider', 'carousel' )
                ],
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'struktur-core' ),
            ]
        );

        $this->add_control(
            'slider_padding',
            [
                'label'       => esc_html__( 'Enable Slider Padding', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false ),
                'condition'   => [
                    'type' => array( 'slider' )
                ],
                'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'struktur-core' ),
                'default'     => 'no'
            ]
        );

        $this->add_control(
            'slider_navigation',
            [
                'label'       => esc_html__( 'Enable Slider Navigation Arrows', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false, true ),
                'condition'   => [
                    'type' => array( 'slider', 'carousel' )
                ],
                'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'struktur-core' ),
                'default'     => 'yes'
            ]
        );

        $this->add_control(
            'slider_pagination',
            [
                'label'       => esc_html__( 'Enable Slider Pagination', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false, true ),
                'condition'   => [
                    'type' => array( 'slider', 'carousel' )
                ],
                'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'struktur-core' ),
                'default'     => 'yes'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'custom_class'            => '',
            'type'                    => 'grid',
            'images'                  => '',
            'image_size'              => 'full',
            'enable_image_shadow'     => 'no',
            'image_behavior'          => '',
            'custom_links'            => '',
            'custom_link_target'      => '_self',
            'number_of_columns'       => 'three',
            'space_between_items'     => 'normal',
            'number_of_visible_items' => '1',
            'slider_loop'             => 'yes',
            'slider_autoplay'         => 'yes',
            'slider_speed'            => '5000',
            'slider_speed_animation'  => '600',
            'slider_padding'          => 'no',
            'slider_navigation'       => 'yes',
            'slider_pagination'       => 'yes'
        );

        $params['holder_classes'] = $this->getHolderClasses( $params, $args );
        $params['slider_data']    = $this->getSliderData( $params );

        $params['type']               = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
        $params['images']             = $this->getGalleryImages( $params );
        $params['image_size']         = $this->getImageSize( $params['image_size'] );
        $params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
        $params['custom_links']       = $this->getCustomLinks( $params );
        $params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'image-gallery', '', $params );
    }

    private function getHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-ig-' . $params['type'] . '-type' : 'qodef-ig-' . $args['type'] . '-type';
        $holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $args['number_of_columns'] . '-columns';
        $holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'qodef-has-shadow' : '';
        $holderClasses[] = ! empty( $params['image_behavior'] ) ? 'qodef-image-behavior-' . $params['image_behavior'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getSliderData( $params ) {
        $slider_data = array();

        $slider_data['data-number-of-items']        = $params['number_of_visible_items'] !== '' && $params['type'] === 'carousel' ? $params['number_of_visible_items'] : '1';
        $slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-slider-padding']         = ! empty( $params['slider_padding'] ) ? $params['slider_padding'] : '';
        $slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

        return $slider_data;
    }

    private function getGalleryImages( $params ) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if ( $params['images'] !== '' ) {
            $image_ids = array();
            foreach ($params['images'] as $img) {
                array_push($image_ids, $img['id']);
            }
        }

        foreach ( $image_ids as $id ) {

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src( $id, 'full' );
            $image['url']      = $image_original[0];
            $image['title']    = get_the_title( $id );
            $image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

            $images[ $i ] = $image;
            $i ++;
        }

        return $images;
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
            return 'full';
        }
    }

    private function getCustomLinks( $params ) {
        $custom_links = array();

        if ( ! empty( $params['custom_links'] ) ) {
            $custom_links = array_map( 'trim', explode( ',', $params['custom_links'] ) );
        }

        return $custom_links;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorImageGallery() );