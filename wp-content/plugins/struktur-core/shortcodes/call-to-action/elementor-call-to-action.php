<?php

class StrukturCoreElementorCallToAction extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_call_to_action';
    }

    public function get_title() {
        return esc_html__( "Call To Action", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-call-to-action';
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
            'layout',
            [
                'label' => esc_html__( "Layout", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal'   => esc_html__( 'Normal', 'struktur-core' ),
                    'simple'   => esc_html__( 'Simple', 'struktur-core' ),
                ],
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'content_in_grid',
            [
                'label' => esc_html__( "Set Content In Grid", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'condition' => [
                    'layout' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'content_elements_proportion',
            [
                'label' => esc_html__( "Content Elements Proportion", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '80'   => esc_html__( '80/20', 'struktur-core' ),
                    '75'   => esc_html__( '75/25', 'struktur-core' ),
                    '66'   => esc_html__( '66/33', 'struktur-core' ),
                    '50'   => esc_html__( '50/50', 'struktur-core' ),
                ],
                'default' => '75',
                'condition' => [
                    'layout' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( "Background color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'layout' => 'simple'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( "Button Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( "Content", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'content_font_size',
            [
                'label' => esc_html__( "Content Font Size (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'content!' => ''
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
            'button_top_margin',
            [
                'label' => esc_html__( "Button Top Margin (px)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'layout' => 'simple'
                ]
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => esc_html__( "Button Type", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'solid' => esc_html__( 'Solid', 'struktur-core' ),
                    'outline' => esc_html__( 'Outline', 'struktur-core' ),
                    'simple' => esc_html__( 'Simple', 'struktur-core' )
                ],
                'default' => 'solid'
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__( "Button Size", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__( 'Default', 'struktur-core' ),
                    'small'  => esc_html__( 'Small', 'struktur-core' ),
                    'medium' => esc_html__( 'Medium', 'struktur-core' ),
                    'large'  => esc_html__( 'Large', 'struktur-core' )
                ],
                'default' => 'medium',
                'condition' => [
                    'button_type' => array( 'solid', 'outline' )
                ]
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
            'button_background_color',
            [
                'label' => esc_html__( "Button Background Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => array( 'solid' )
                ]
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__( "Button Hover Background Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => array( 'solid' )
                ]
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__( "Button Border Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => array( 'solid' , 'outline' )
                ]
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( "Button Hover Border Color", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_type' => array( 'solid' , 'outline' )
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $params['content'] = $this->wrapWord( $params['content'] );

        $params['holder_classes']       = $this->getHolderClasses( $params );
        $params['inner_classes']        = $this->getInnerClasses( $params );
        $params['button_holder_styles'] = $this->getButtonHolderStyles( $params );
        $params['button_parameters']    = $this->getButtonParameters( $params );
        $params['svg_pattern_style']    = $this->svgPatternStyle($params);
        $params['holder_background_color'] = !empty($params['background_color']) && $params['layout'] === 'simple' ? 'background-color:'.$params['background_color'] : '';

        echo struktur_core_get_shortcode_module_template_part( 'templates/call-to-action', 'call-to-action', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['layout'] ) ? 'qodef-' . $params['layout'] . '-layout' : '';
        $holderClasses[] = $params['content_in_grid'] === 'yes' && $params['layout'] === 'normal' ? 'qodef-content-in-grid' : '';

        $content_elements_proportion = $params['content_elements_proportion'];
        if ( $params['layout'] === 'normal' ) {
            switch ( $content_elements_proportion ):
                case '80':
                    $holderClasses[] = 'qodef-four-fifths-columns';
                    break;
                case '75':
                    $holderClasses[] = 'qodef-three-quarters-columns';
                    break;
                case '66':
                    $holderClasses[] = 'qodef-two-thirds-columns';
                    break;
                case '50':
                    $holderClasses[] = 'qodef-two-halves-columns';
                    break;
                default:
                    $holderClasses[] = 'qodef-three-quarters-columns';
                    break;
            endswitch;
        }

        return implode( ' ', $holderClasses );
    }

    private function getInnerClasses( $params ) {
        $innerClasses = array();

        $innerClasses[] = $params['layout'] === 'normal' && $params['content_in_grid'] === 'yes' ? 'qodef-grid' : '';

        return implode( ' ', $innerClasses );
    }

    private function getButtonHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['button_top_margin'] ) && $params['layout'] === 'simple' ) {
            $styles[] = 'margin-top: ' . struktur_select_filter_px( $params['button_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getButtonParameters( $params ) {
        $button_params_array = array();

        if ( ! empty( $params['button_text'] ) ) {
            $button_params_array['text'] = $params['button_text'];
        }

        if ( ! empty( $params['button_type'] ) ) {
            $button_params_array['type'] = $params['button_type'];
        }

        if ( ! empty( $params['button_size'] ) ) {
            $button_params_array['size'] = $params['button_size'];
        }

        if ( ! empty( $params['button_link'] ) ) {
            $button_params_array['link'] = $params['button_link'];
        }

        $button_params_array['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';

        if ( ! empty( $params['button_color'] ) ) {
            $button_params_array['color'] = $params['button_color'];
        }

        if ( ! empty( $params['button_hover_color'] ) ) {
            $button_params_array['hover_color'] = $params['button_hover_color'];
        }

        if ( ! empty( $params['button_background_color'] ) ) {
            $button_params_array['background_color'] = $params['button_background_color'];
        }

        if ( ! empty( $params['button_hover_background_color'] ) ) {
            $button_params_array['hover_background_color'] = $params['button_hover_background_color'];
        }

        if ( ! empty( $params['button_border_color'] ) ) {
            $button_params_array['border_color'] = $params['button_border_color'];
        }

        if ( ! empty( $params['button_hover_border_color'] ) ) {
            $button_params_array['hover_border_color'] = $params['button_hover_border_color'];
        }

        return $button_params_array;
    }

    private function svgPatternStyle( $params ) {
        $itemStyle = array();

        $svg = struktur_select_get_svg( 'inverted-pattern', $params['background_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";

        return implode( ';', $itemStyle );
    }

    private function wrapInSpan($str) {
        $re = "/([^\\s>])(?!(?:[^<>]*)?>)/u";
        $subst = "<span class='qodef-char' aria-hidden='true'>$1</span>";
        $result = preg_replace($re, $subst, $str);
        return $result;
    }

    private function wrapWord($str) {
        $words = preg_split('/\s+/', $str);
        $res = '';
        foreach ($words as $word) {
            $res .= '<span class="qodef-word">';
            $res .= $this->wrapInSpan($word);
            $res .= ' </span>';
        }
        return $res;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorCallToAction() );