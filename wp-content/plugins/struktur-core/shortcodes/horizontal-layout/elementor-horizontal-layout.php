<?php

class StrukturCoreElementorHorizontalLayout extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'qodef_horizontal_layout';
	}
	
	public function get_title() {
		return esc_html__( 'Horizontal Layout', 'struktur-core' );
	}
	
	public function get_icon() {
		return 'struktur-elementor-custom-icon struktur-elementor-horizontal-layout';
	}
	
	public function get_categories() {
		return [ 'struktur' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'cta',
			[
				'label' => esc_html__( 'Call To Action', 'struktur-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => esc_html__( 'Content Background Color', 'struktur-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);
		
		$this->add_control(
			'cta_title',
			[
				'label'   => esc_html__( 'CTA Title', 'struktur-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
            'cta_link',
            [
                'label'   => esc_html__( 'CTA Link', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'cta_link_text',
            [
                'label'   => esc_html__( 'CTA Link Text', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'cta_link!' => ''
                ]
            ]
        );

        $this->add_control(
            'cta_link_target',
            [
                'label'   => esc_html__( 'CTA Link target', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'condition' => [
                    'cta_link!' => ''
                ]
            ]
        );

        $this->add_control(
            'cta_widget_area',
            [
                'label'   => esc_html__( 'CTA Widget Area', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array_merge(
                    array(
                        '' => ''
                    ),
                    struktur_select_get_custom_sidebars()
                )
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'media_type',
            [
                'label' => esc_html__( 'Media Type', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__('Image', 'struktur-core'),
                    'video' => esc_html__('Video', 'struktur-core')
                ]
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => esc_html__( 'Image', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label'   => esc_html__( 'Video Url', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'media_type' => 'video'
                ]
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label'   => esc_html__( 'Intro Label', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label'   => esc_html__( 'Text', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'   => esc_html__( 'Link', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'target',
            [
                'label'   => esc_html__( 'Link target', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $this->add_control(
            'items',
            [
                'label'       => esc_html__( 'Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Item' ),
            ]
        );
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();

        $params['svg_pattern_style'] = $this->svgPatternStyle($params);
		$params['elementor'] = 'yes';

		echo struktur_core_get_shortcode_module_template_part('templates/horizontal-layout-template', 'horizontal-layout', '', $params);
    }

    private function svgPatternStyle($params)
    {
        $itemStyle = array();

        $svg = struktur_select_get_svg('inverted-pattern', $params['content_background_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode($svg) . "')";

        return implode(';', $itemStyle);
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorHorizontalLayout() );