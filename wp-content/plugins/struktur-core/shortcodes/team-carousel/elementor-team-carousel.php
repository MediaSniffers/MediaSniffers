<?php

class StrukturCoreElementorTeamCarousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_team_carousel';
    }

    public function get_title() {
        return esc_html__( 'Team Carousel', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-team-carousel';
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
            'number_of_visible_items',
            [
                'label'   => esc_html__( 'Number of Visible Items', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'One', 'struktur-core' ),
                    '2' => esc_html__( 'Two', 'struktur-core' ),
                    '3' => esc_html__( 'Three', 'struktur-core' ),
                    '4' => esc_html__( 'Four', 'struktur-core' ),
                    '5' => esc_html__( 'Five', 'struktur-core' ),
                    '6' => esc_html__( 'Six', 'struktur-core' ),
                ],
                'default' => '3'
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

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Enable Slider Loop', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Enable Slider Autoplay', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => esc_html__( 'Slide Duration', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'struktur-core' ),
                'default'     => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'       => esc_html__( 'Slide Animation Duration', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'struktur-core' ),
                'default'     => '600'
            ]
        );

        $this->add_control(
            'slider_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_pagination',
            [
                'label'   => esc_html__( 'Enable Slider Pagination', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'info-below-image' => esc_html__( 'Info Below Image', 'struktur-core' ),
                    'info-on-image'    => esc_html__( 'Info On Image Hover', 'struktur-core' ),
                ],
                'default' => 'info-below-image'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__( 'Image', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'overlay_pattern',
            [
                'label' => esc_html__( 'Enable Pattern Overlay', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false )
            ]
        );

        $repeater->add_control(
            'overlay_pattern_color',
            [
                'label' => esc_html__( 'Overlay Pattern Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'overlay_pattern' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'team_name',
            [
                'label' => esc_html__( 'Name', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_name_tag',
            [
                'label'   => esc_html__( 'Name Tag', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'default' => 'h6',
                'condition' => [
                    'team_name!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team_name_color',
            [
                'label'     => esc_html__( 'Name Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_name!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team_position',
            [
                'label' => esc_html__( 'Position', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_position_color',
            [
                'label'     => esc_html__( 'Position Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_position!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team_text',
            [
                'label' => esc_html__( 'Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_text!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team_link',
            [
                'label' => esc_html__( 'Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_target',
            [
                'label' => esc_html__( 'Target', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'condition' => [
                    'team_link!' => ''
                ]
            ]
        );

        $this->add_control(
            'team_item',
            [
                'label'       => esc_html__( 'Team Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Team Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'number_of_visible_items' => '3',
            'space_between_items'     => 'normal',
            'slider_loop'             => 'yes',
            'slider_autoplay'         => 'yes',
            'slider_speed'            => '5000',
            'slider_speed_animation'  => '600',
            'slider_navigation'       => 'yes',
            'slider_pagination'       => 'yes',
        );

        $holder_classes = $this->getSliderHolderClasses( $params, $args );
        $slider_data    = $this->getSliderData( $params );
        $params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'info-below-image';
        ?>

        <div class="qodef-team-carousel-holder <?php echo esc_attr( $holder_classes ) ?>">
            <div class="qodef-tc-inner qodef-owl-slider" <?php echo struktur_select_get_inline_attrs( $slider_data ) ?>>
                <?php foreach ( $params['team_item'] as $team ) {
                    if ( ! empty( $team['team_image'] ) ) {
                        $team['team_image'] = $team['team_image']['id'];
                    }

                    $team['holder_classes']         = $this->getHolderClasses( $params );
                    $team['team_name_tag']          = ! empty( $team['team_name_tag'] ) ? $team['team_name_tag'] : 'h6';
                    $team['team_social_icons']      = '';
                    $team['team_name_styles']       = $this->getTeamNameStyles( $team );
                    $team['team_position_styles']   = $this->getTeamPositionStyles( $team );
                    $team['team_text_styles']       = $this->getTeamTextStyles( $team );
                    $team['svg_pattern_style']      = $this->svgPatternStyle($team);

                    echo struktur_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'team', '', $team );
                } ?>
            </div>
        </div>
        <?php
    }

    private function getSliderHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';

        return implode( ' ', $holderClasses );
    }

    private function getSliderData( $params ) {
        $slider_data = array();

        $slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '3';
        $slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

        return $slider_data;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-team-' . $params['type'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getTeamNameStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['team_name_color'] ) ) {
            $styles[] = 'color: ' . $params['team_name_color'];
        }

        return implode( ';', $styles );
    }

    private function getTeamPositionStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['team_position_color'] ) ) {
            $styles[] = 'color: ' . $params['team_position_color'];
        }

        return implode( ';', $styles );
    }

    private function getTeamTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['team_text_color'] ) ) {
            $styles[] = 'color: ' . $params['team_text_color'];
        }

        return implode( ';', $styles );
    }

    private function svgPatternStyle($params) {
        $itemStyle = array();

        $svg = struktur_select_get_svg( 'pattern', $params['overlay_pattern_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";

        return implode( ';', $itemStyle );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorTeamCarousel() );