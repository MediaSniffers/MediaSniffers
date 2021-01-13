<?php

class StrukturCoreElementorIntroSection extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_intro_section';
    }

    public function get_title() {
        return esc_html__( "Intro Section", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-intro-section';
    }

    public function get_categories() {
        return [ 'struktur' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'loading_screen',
            [
                'label' => esc_html__( 'Loading Screen', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loading_title',
            [
                'label' => esc_html__( "Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'loading_subtitle',
            [
                'label' => esc_html__( "Subtitle", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'loading_tagline',
            [
                'label' => esc_html__( "Tagline", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'main_screen',
            [
                'label' => esc_html__( 'Main Screen', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_title',
            [
                'label' => esc_html__( "First Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'first_title_emphasize_words',
            [
                'label' => esc_html__( "Emphasize Words", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Enter the positions of the words you would like to Emphasize. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to be emphasized, you would enter "1,3,4")', 'struktur-core'),
                'condition' => [
                    'first_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'first_title_break_words',
            [
                'label' => esc_html__( "Position of Line Break", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'struktur-core' ),
                'condition' => [
                    'first_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'second_title',
            [
                'label' => esc_html__( "Second Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'second_title_emphasize_words',
            [
                'label' => esc_html__( "Emphasize Words", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Enter the positions of the words you would like to Emphasize. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to be emphasized, you would enter "1,3,4")', 'struktur-core'),
                'condition' => [
                    'second_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'second_title_break_words',
            [
                'label' => esc_html__( "Position of Line Break", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'struktur-core' ),
                'condition' => [
                    'second_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => esc_html__( "Video Url", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( "Link", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label' => esc_html__( "Link Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $this->add_control(
            'link_target',
            [
                'label' => esc_html__( "Link target", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $args = array(
            'loading_title'     => '',
            'loading_subtitle'  => '',
            'loading_tagline'   => '',
            'first_title'       => '',
            'first_title_emphasize_words'  => '',
            'first_title_break_words'  => '',
            'second_title'      => '',
            'second_title_emphasize_words'  => '',
            'second_title_break_words'  => '',
            'video_url'         => '',
            'link'              => '',
            'link_text'         => '',
            'link_target'       => '',
        );

        $params = shortcode_atts($args, $params);
        $params['first_title'] = $this->getModifiedTitle( $params['first_title'], $params['first_title_emphasize_words'], $params['first_title_break_words'] );
        $params['second_title'] = $this->getModifiedTitle( $params['second_title'], $params['second_title_emphasize_words'], $params['second_title_break_words'] );
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);

        echo struktur_core_get_shortcode_module_template_part('templates/intro-section-template', 'intro-section', '', $params);
    }

    private function getModifiedTitle( $title, $emphasize_words, $break_words  ) {
        $title_emphasize_words = str_replace(' ', '', $emphasize_words);
        $title_break_words = str_replace( ' ', '', $break_words );

        if ( ! empty( $title ) ) {
            $emphasize_words = explode(',', $title_emphasize_words);
            $split_title = explode( ' ', $title );

            if (!empty($title_emphasize_words)) {
                foreach ($emphasize_words as $value) {
                    if (!empty($split_title[$value - 1])) {
                        $split_title[$value - 1] = '<span class="qodef-st-title-emphasize"><span>' . $split_title[$value - 1] . '</span></span>';
                    }
                }
            }

            if ( ! empty( $title_break_words ) ) {
                if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
                    $split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
                }
            }

            $title = implode( ' ', $split_title );
        }

        return $title;
    }

    private function svgPatternStyle($params) {
        $itemStyle = array();

        $svg = struktur_select_get_svg('inverted-pattern', '#181818');
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode($svg) . "')";

        return implode(';', $itemStyle);
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorIntroSection() );