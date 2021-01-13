<?php

class StrukturCoreElementorElementorTeam extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_team';
    }

    public function get_title() {
        return esc_html__( 'Team', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-team';
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

        $this->add_control(
            'team_image',
            [
                'label' => esc_html__( 'Image', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'overlay_pattern',
            [
                'label' => esc_html__( 'Enable Pattern Overlay', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false )
            ]
        );

        $this->add_control(
            'overlay_pattern_color',
            [
                'label' => esc_html__( 'Overlay Pattern Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'overlay_pattern' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'team_name',
            [
                'label' => esc_html__( 'Name', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'team_name_tag',
            [
                'label'   => esc_html__( 'Name Tag', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'default' => 'h6'
            ]
        );

        $this->add_control(
            'team_name_color',
            [
                'label'     => esc_html__( 'Name Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_name!' => ''
                ],
            ]
        );

        $this->add_control(
            'team_position',
            [
                'label' => esc_html__( 'Position', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'team_position_color',
            [
                'label'     => esc_html__( 'Position Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_position!' => ''
                ],
            ]
        );

        $this->add_control(
            'team_text',
            [
                'label' => esc_html__( 'Text', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'team_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_text!' => ''
                ],
            ]
        );

        $this->add_control(
            'team_link',
            [
                'label' => esc_html__( 'Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
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

        $repeater = new \Elementor\Repeater();

        struktur_select_icon_collections()->getElementorParamsArray( $repeater, '', '' );

        $repeater->add_control(
            'team_social_icon_link',
            [
                'label' => esc_html__( 'Social Icon Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_social_icon_target',
            [
                'label'   => esc_html__( 'Social Icon Target', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array()
            ]
        );

        $this->add_control(
            'social_icon',
            [
                'label'       => esc_html__( 'Social Icons', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Social Icon' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args = array(
            'type'                  => 'info-below-image',
            'team_image'            => '',
            'team_name'             => '',
            'team_name_tag'         => 'h6',
            'team_name_color'       => '',
            'team_position'         => '',
            'team_position_color'   => '',
            'team_text'             => '',
            'team_text_color'       => '',
            'team_social_icon_pack' => ''
        );

        if ( ! empty( $params['team_image'] ) ) {
            $params['team_image'] = $params['team_image']['id'];
        }

        $params['type']                 = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
        $params['holder_classes']       = $this->getHolderClasses( $params );
        $params['team_name_tag']        = ! empty( $params['team_name_tag'] ) ? $params['team_name_tag'] : $args['team_name_tag'];
        $params['team_social_icons']    = $this->getTeamSocialIcons( $params );
        $params['team_name_styles']     = $this->getTeamNameStyles( $params );
        $params['team_position_styles'] = $this->getTeamPositionStyles( $params );
        $params['team_text_styles']     = $this->getTeamTextStyles( $params );
        $params['svg_pattern_style']    = $this->svgPatternStyle($params);

        echo struktur_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'team', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-team-' . $params['type'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getTeamSocialIcons( $params ) {

        $team_social_icons = array();

        if ( $params['social_icon'] !== '' ) {

            foreach ( $params['social_icon'] as $icon ) {

                $iconPackName = struktur_select_icon_collections()->getIconCollectionParamNameByKey( $icon['icon_pack'] );

                $team_icon_params                  = array();
                $team_icon_params['icon_pack']     = $icon['icon_pack'];
                $team_icon_params[ $iconPackName ] = $icon[ $iconPackName ];
                $team_icon_params['link']          = $icon['team_social_icon_link'];
                $team_icon_params['target']        = $icon['team_social_icon_target'];

                $team_social_icons[] = struktur_select_execute_shortcode( 'qodef_icon', $team_icon_params );
            }
        }

        return $team_social_icons;
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

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorElementorTeam() );