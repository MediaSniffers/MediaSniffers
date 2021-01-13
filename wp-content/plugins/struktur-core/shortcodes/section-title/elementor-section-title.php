<?php

class StrukturCoreElementorSectionTitle extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_section_title';
    }

    public function get_title() {
        return esc_html__( "Section Title", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-section-title';
    }

    public function get_categories() {
        return [ 'struktur' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label' => esc_html__( "Custom CSS Class", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'struktur-core' )
            ]
        );

        $this->add_control(
            'title_type',
            [
                'label' => esc_html__( "Type", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard'   => esc_html__( 'Standard', 'struktur-core' ),
                    'underlined' => esc_html__( 'Underlined', 'struktur-core' ),
                ],
                'default' => 'standard'
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => esc_html__( "Horizontal Position", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''         => esc_html__( 'Default', 'struktur-core' ),
                    'left'     => esc_html__( 'Left', 'struktur-core' ),
                    'center'   => esc_html__( 'Center', 'struktur-core' ),
                    'right'    => esc_html__( 'Right', 'struktur-core' ),
                ],
                'default' => ''
            ]
        );

        $this->add_control(
            'holder_padding',
            [
                'label' => esc_html__( "Holder Side Padding (px or %)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( "Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( "Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( "Button Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title Style', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( "Title Tag", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'default' => 'h2',
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( "Title Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_font_size',
            [
                'label' => esc_html__( "Title Font Size (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_emphasize_words',
            [
                'label' => esc_html__( "Emphasize Words", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Enter the positions of the words you would like to Emphasize. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to be emphasized, you would enter "1,3,4")', 'struktur-core'),
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_break_words',
            [
                'label' => esc_html__( "Position of Line Break", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'struktur-core' ),
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'disable_break_words',
            [
                'label' => esc_html__( "Disable Line Break for Smaller Screens", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_style',
            [
                'label' => esc_html__( 'Text Style', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_tag',
            [
                'label' => esc_html__( "Text Tag", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'default' => 'p',
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( "Text Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_font_size',
            [
                'label' => esc_html__( "Text Font Size (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_line_height',
            [
                'label' => esc_html__( "Text Line Height (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_font_weight',
            [
                'label' => esc_html__( "Text Font Weight", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_font_weight_array( true ),
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__( "Text Top Margin (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button Style', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( "Button Link", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'button_target',
            [
                'label' => esc_html__( "Button Link Target", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array()
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( "Button Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( "Button Hover Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'button_top_margin',
            [
                'label' => esc_html__( "Button Top Margin (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $params['holder_classes']    = $this->getHolderClasses( $params );
        $params['holder_styles']     = $this->getHolderStyles( $params );
        $params['title']             = $this->getModifiedTitle( $params );
        $params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h2';
        $params['title_styles']      = $this->getTitleStyles( $params );
        $params['text_tag']          = ! empty( $params['text_tag'] ) ? $params['text_tag'] : 'p';
        $params['text_styles']       = $this->getTextStyles( $params );
        $params['button_parameters'] = $this->getButtonParameters( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = $params['disable_break_words'] === 'yes' ? 'qodef-st-disable-title-break' : '';

        if (!empty($params['title_type'])) {

            if ($params['title_type'] === 'standard') {
                $holderClasses[] = 'qodef-st-standard';
            } else {
                $holderClasses[] = 'qodef-st-underlined';
            }

        }

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['holder_padding'] ) ) {
            $styles[] = 'padding: 0 ' . $params['holder_padding'];
        }

        if ( ! empty( $params['position'] ) ) {
            $styles[] = 'text-align: ' . $params['position'];
        }

        return implode( ';', $styles );
    }

    private function getModifiedTitle( $params ) {
        $title             = $params['title'];
        $title_emphasize_words = str_replace(' ', '', $params['title_emphasize_words']);
        $title_break_words = str_replace( ' ', '', $params['title_break_words'] );

        if ( ! empty( $title ) ) {
            $emphasize_words = explode(',', $title_emphasize_words);
            $split_title = explode( ' ', $title );


            if (!empty($title_emphasize_words)) {
                foreach ($emphasize_words as $value) {
                    if (!empty($split_title[$value - 1])) {
                        $split_title[$value - 1] = '<span class="qodef-st-title-emphasize"><span>'.$split_title[$value - 1].'</span><span>' . $split_title[$value - 1] . '</span></span>';
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

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        if ( ! empty( $params['title_font_size'] ) ) {
            $styles[] = 'font-size: ' . struktur_select_filter_px( $params['title_font_size'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        if ( ! empty( $params['text_font_size'] ) ) {
            $styles[] = 'font-size: ' . struktur_select_filter_px( $params['text_font_size'] ) . 'px';
        }

        if ( ! empty( $params['text_line_height'] ) ) {
            $styles[] = 'line-height: ' . struktur_select_filter_px( $params['text_line_height'] ) . 'px';
        }

        if ( ! empty( $params['text_font_weight'] ) ) {
            $styles[] = 'font-weight: ' . $params['text_font_weight'];
        }

        if ( $params['text_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['text_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getButtonParameters( $params ) {
        $button_params = array();

        if ( ! empty( $params['button_text'] ) ) {
            $button_params['text'] = $params['button_text'];
            $button_params['type'] = 'simple';
            $button_params['link'] = ! empty( $params['button_link'] ) ? $params['button_link'] : '#';
            $button_params['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';

            if ( ! empty( $params['button_color'] ) ) {
                $button_params['color'] = $params['button_color'];
            }

            if ( ! empty( $params['button_hover_color'] ) ) {
                $button_params['hover_color'] = $params['button_hover_color'];
            }

            if ( $params['button_top_margin'] !== '' ) {
                $button_params['margin'] = intval( $params['button_top_margin'] ) . 'px 0 0';
            }
        }

        return $button_params;
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorSectionTitle() );