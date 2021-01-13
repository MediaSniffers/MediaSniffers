<?php

class StrukturCoreElementorGoogleMap extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_google_map';
    }

    public function get_title() {
        return esc_html__( 'Google Map', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-google-map';
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
            'address1',
            [
                'label'       => esc_html__( 'Address 1', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'address2',
            [
                'label'       => esc_html__( 'Address 2', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'address1!' => ''
                ],
            ]
        );

        $this->add_control(
            'address3',
            [
                'label'       => esc_html__( 'Address 3', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'address2!' => ''
                ],
            ]
        );

        $this->add_control(
            'address4',
            [
                'label'       => esc_html__( 'Address 4', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'address3!' => ''
                ],
            ]
        );

        $this->add_control(
            'address5',
            [
                'label'       => esc_html__( 'Address 5', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'address4!' => ''
                ],
            ]
        );

        $this->add_control(
            'snazzy_map_style',
            [
                'label'       => esc_html__( 'Snazzy Map Style', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false ),
                'description' => esc_html__( 'Enabling this option will set predefined snazzy map style', 'struktur-core' ),
                'default'     => 'no'
            ]
        );

        $this->add_control(
            'snazzy_map_code',
            [
                'label'       => esc_html__( 'Snazzy Map Code', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::CODE,
                'condition' => [
                    'snazzy_map_style' => array( 'yes' )
                ],
                'description' => sprintf( esc_html__( 'Fill code from snazzy map site %s to add predefined style for your google map', 'struktur-core' ), '<a href="https://snazzymaps.com/" target="_blank">https://snazzymaps.com/</a>' ),
            ]
        );

        $this->add_control(
            'custom_map_style',
            [
                'label'   => esc_html__( 'Custom Map Style', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'condition' => [
                    'snazzy_map_style' => array( 'no' )
                ],
                'description' => esc_html__( 'Enabling this option will allow Map editing', 'struktur-core' ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'color_overlay',
            [
                'label'     => esc_html__( 'Color Overlay', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'custom_map_style' => array( 'yes' )
                ],
                'description' => esc_html__( 'Choose a Map color overlay', 'struktur-core' ),
                'default' => ''
            ]
        );

        $this->add_control(
            'saturation',
            [
                'label'       => esc_html__( 'Saturation', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'custom_map_style' => array( 'yes' )
                ],
                'description' => esc_html__( 'Choose a level of saturation (-100 = least saturated, 100 = most saturated', 'struktur-core' ),
                'default' => '0'
            ]
        );

        $this->add_control(
            'lightness',
            [
                'label'       => esc_html__( 'Lightness', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'snazzy_map_style' => array( 'no' )
                ],
                'description' => esc_html__( 'Choose a level of lightness (-100 = darkest, 100 = lightest)', 'struktur-core' ),
                'default' => '0'
            ]
        );

        $this->add_control(
            'pin',
            [
                'label'       => esc_html__( 'Pin', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select a pin image to be used on Google Map', 'struktur-core' )
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label'       => esc_html__( 'Map Zoom', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter a zoom factor for Google Map (0 = whole worlds, 19 = individual buildings)', 'struktur-core' ),
                'default' => '12'
            ]
        );

        $this->add_control(
            'scroll_wheel',
            [
                'label'   => esc_html__( 'Zoom Map on Mouse Wheel', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'description' => esc_html__( 'Enabling this option will allow users to zoom in on Map using mouse wheel', 'struktur-core' ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label'       => esc_html__( 'Map Height', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default' => '600'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['enable_direction_link'] = 'no';
        $rand_id = mt_rand( 100000, 3000000 );

        $params['is_elementor'] = true;

        if ( ! empty( $params['pin'] ) ) {
            $params['pin'] = $params['pin']['id'];
        }

        $params['map_data'] = $this->getMapDate( $params, $rand_id );
        $params['map_id']   = 'qodef-map-' . $rand_id;

        echo struktur_core_get_shortcode_module_template_part( 'templates/google-map-template', 'google-map', '', $params );
    }

    private function getMapDate( $params, $id ) {
        $map_data = array();

        $addresses_array = array();
        if ( $params['address1'] != '' ) {
            array_push( $addresses_array, esc_attr( $params['address1'] ) );
        }
        if ( $params['address2'] != '' ) {
            array_push( $addresses_array, esc_attr( $params['address2'] ) );
        }
        if ( $params['address3'] != '' ) {
            array_push( $addresses_array, esc_attr( $params['address3'] ) );
        }
        if ( $params['address4'] != '' ) {
            array_push( $addresses_array, esc_attr( $params['address4'] ) );
        }
        if ( $params['address5'] != '' ) {
            array_push( $addresses_array, esc_attr( $params['address5'] ) );
        }

        if ( $params['pin'] != "" ) {
            $map_pin = wp_get_attachment_image_src( $params['pin'], 'full', true );
            $map_pin = $map_pin[0];
        } else {
            $map_pin = get_template_directory_uri() . "/assets/img/pin.png";
        }

        $map_data[] = "data-addresses='[\"" . implode( '","', $addresses_array ) . "\"]'";
        $map_data[] = 'data-custom-map-style=' . $params['custom_map_style'];
        $map_data[] = 'data-color-overlay=' . $params['color_overlay'];
        $map_data[] = 'data-saturation=' . $params['saturation'];
        $map_data[] = 'data-lightness=' . $params['lightness'];
        $map_data[] = 'data-zoom=' . $params['zoom'];
        $map_data[] = 'data-pin=' . $map_pin;
        $map_data[] = 'data-unique-id=' . $id;
        $map_data[] = 'data-scroll-wheel=' . $params['scroll_wheel'];
        $map_data[] = 'data-height=' . $params['map_height'];
        $map_data[] = $params['snazzy_map_style'] == 'yes' ? 'data-snazzy-map-style=yes' : '';

        return implode( ' ', $map_data );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorGoogleMap() );