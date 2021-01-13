<?php

class StrukturCoreElementorUnderlineText extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_underline_text';
    }

    public function get_title() {
        return esc_html__( "Underline Text", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-underline-text';
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
            'text',
            [
                'label' => esc_html__( "Text", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'text_tag',
            [
                'label' => esc_html__( "Text Tag", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'default' => 'h5',
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
            'underline_words',
            [
                'label' => esc_html__( "Underline Words", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter the positions of the words you would like to display as underline. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a underline, you would enter "1,2,3")', 'struktur-core' ),
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $args   = array(
            'custom_class'    => '',
            'text'            => '',
            'text_tag'        => 'h5',
            'text_color'      => '',
            'underline_words' => ''
        );
        $params = shortcode_atts( $args, $params );

        $params['holder_classes'] = $this->getHolderClasses( $params, $args );
        $params['holder_styles']  = $this->getHolderStyles( $params );
        $params['text']           = $this->getModifiedTitle( $params );
        $params['text_tag']       = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];

        echo struktur_core_get_shortcode_module_template_part( 'templates/underline-text', 'underline-text', '', $params );
    }

    private function getHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        return implode( ';', $styles );
    }

    private function getModifiedTitle( $params ) {
        $text = $params['text'];

        if ( ! empty( $text ) ) {
            $underline_words = array_filter( explode( ',', str_replace( ' ', '', $params['underline_words'] ) ) );
            array_walk( $underline_words, 'intval' );

            if ( ! empty( $underline_words ) ) {
                $split_text = explode( ' ', $text );
                $link_begin = '<span class="qodef-ut-underline">';
                $link_end   = '</span>';
                $prev_value = - 1;

                foreach ( $underline_words as $value ) {
                    if ( ! empty( $split_text[ $value - 1 ] ) ) {
                        $value           = intval( $value );
                        $link_begin_html = $prev_value + 1 !== $value ? $link_begin : '';
                        $link_end_html   = ! in_array( $value + 1, $underline_words ) ? $link_end : '';
                        $prev_value      = $value;

                        $split_text[ $value - 1 ] = $link_begin_html . $split_text[ $value - 1 ] . $link_end_html;
                    }
                }

                $text = implode( ' ', $split_text );
            }
        }

        return $text;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorUnderlineText() );