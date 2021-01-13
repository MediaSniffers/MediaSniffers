<?php

class StrukturCoreElementorCountdown extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_enqueue_script( 'jquery-plugin', STRUKTUR_CORE_SHORTCODES_URL_PATH . '/countdown/assets/js/plugins/jquery.plugin.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'countdown', STRUKTUR_CORE_SHORTCODES_URL_PATH . '/countdown/assets/js/plugins/jquery.countdown.min.js', array( 'jquery' ), false, true );
    }

    public function get_name() {
        return 'qodef_countdown';
    }

    public function get_title() {
        return esc_html__( 'Countdown', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-countdown';
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
            'skin',
            [
                'label'   => esc_html__( 'Skin', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''                 => esc_html__( 'Default', 'struktur-core' ),
                    'qodef-light-skin' => esc_html__( 'Light', 'struktur-core' )
                ],
            ]
        );

        $this->add_control(
            'year',
            [
                'label'   => esc_html__( 'Year', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '2020' => esc_html__( '2020', 'struktur-core' ),
                    '2021' => esc_html__( '2021', 'struktur-core' ),
                    '2022' => esc_html__( '2022', 'struktur-core' ),
                    '2023' => esc_html__( '2023', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'month',
            [
                'label'   => esc_html__( 'Month', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( 'January', 'struktur-core' ),
                    '2'  => esc_html__( 'February', 'struktur-core' ),
                    '3'  => esc_html__( 'March', 'struktur-core' ),
                    '4'  => esc_html__( 'April', 'struktur-core' ),
                    '5'  => esc_html__( 'May', 'struktur-core' ),
                    '6'  => esc_html__( 'June', 'struktur-core' ),
                    '7'  => esc_html__( 'July', 'struktur-core' ),
                    '8'  => esc_html__( 'August', 'struktur-core' ),
                    '9'  => esc_html__( 'September', 'struktur-core' ),
                    '10' => esc_html__( 'October', 'struktur-core' ),
                    '11' => esc_html__( 'November', 'struktur-core' ),
                    '12' => esc_html__( 'December', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'day',
            [
                'label'   => esc_html__( 'Day', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( '1', 'struktur-core' ),
                    '2'  => esc_html__( '2', 'struktur-core' ),
                    '3'  => esc_html__( '3', 'struktur-core' ),
                    '4'  => esc_html__( '4', 'struktur-core' ),
                    '5'  => esc_html__( '5', 'struktur-core' ),
                    '6'  => esc_html__( '6', 'struktur-core' ),
                    '7'  => esc_html__( '7', 'struktur-core' ),
                    '8'  => esc_html__( '8', 'struktur-core' ),
                    '9'  => esc_html__( '9', 'struktur-core' ),
                    '10' => esc_html__( '10', 'struktur-core' ),
                    '11' => esc_html__( '11', 'struktur-core' ),
                    '12' => esc_html__( '12', 'struktur-core' ),
                    '13' => esc_html__( '13', 'struktur-core' ),
                    '14' => esc_html__( '14', 'struktur-core' ),
                    '15' => esc_html__( '15', 'struktur-core' ),
                    '16' => esc_html__( '16', 'struktur-core' ),
                    '17' => esc_html__( '17', 'struktur-core' ),
                    '18' => esc_html__( '18', 'struktur-core' ),
                    '19' => esc_html__( '19', 'struktur-core' ),
                    '20' => esc_html__( '20', 'struktur-core' ),
                    '21' => esc_html__( '21', 'struktur-core' ),
                    '22' => esc_html__( '22', 'struktur-core' ),
                    '23' => esc_html__( '23', 'struktur-core' ),
                    '24' => esc_html__( '24', 'struktur-core' ),
                    '25' => esc_html__( '25', 'struktur-core' ),
                    '26' => esc_html__( '26', 'struktur-core' ),
                    '27' => esc_html__( '27', 'struktur-core' ),
                    '28' => esc_html__( '28', 'struktur-core' ),
                    '29' => esc_html__( '29', 'struktur-core' ),
                    '30' => esc_html__( '30', 'struktur-core' ),
                    '31' => esc_html__( '31', 'struktur-core' ),
                ],
            ]
        );

        $this->add_control(
            'hour',
            [
                'label'   => esc_html__( 'Hour', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( '1', 'struktur-core' ),
                    '2'  => esc_html__( '2', 'struktur-core' ),
                    '3'  => esc_html__( '3', 'struktur-core' ),
                    '4'  => esc_html__( '4', 'struktur-core' ),
                    '5'  => esc_html__( '5', 'struktur-core' ),
                    '6'  => esc_html__( '6', 'struktur-core' ),
                    '7'  => esc_html__( '7', 'struktur-core' ),
                    '8'  => esc_html__( '8', 'struktur-core' ),
                    '9'  => esc_html__( '9', 'struktur-core' ),
                    '10' => esc_html__( '10', 'struktur-core' ),
                    '11' => esc_html__( '11', 'struktur-core' ),
                    '12' => esc_html__( '12', 'struktur-core' ),
                    '13' => esc_html__( '13', 'struktur-core' ),
                    '14' => esc_html__( '14', 'struktur-core' ),
                    '15' => esc_html__( '15', 'struktur-core' ),
                    '16' => esc_html__( '16', 'struktur-core' ),
                    '17' => esc_html__( '17', 'struktur-core' ),
                    '18' => esc_html__( '18', 'struktur-core' ),
                    '19' => esc_html__( '19', 'struktur-core' ),
                    '20' => esc_html__( '20', 'struktur-core' ),
                    '21' => esc_html__( '21', 'struktur-core' ),
                    '22' => esc_html__( '22', 'struktur-core' ),
                    '23' => esc_html__( '23', 'struktur-core' ),
                    '24' => esc_html__( '24', 'struktur-core' )
                ],
            ]
        );

        $this->add_control(
            'minute',
            [
                'label'   => esc_html__( 'Minute', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( '1', 'struktur-core' ),
                    '2'  => esc_html__( '2', 'struktur-core' ),
                    '3'  => esc_html__( '3', 'struktur-core' ),
                    '4'  => esc_html__( '4', 'struktur-core' ),
                    '5'  => esc_html__( '5', 'struktur-core' ),
                    '6'  => esc_html__( '6', 'struktur-core' ),
                    '7'  => esc_html__( '7', 'struktur-core' ),
                    '8'  => esc_html__( '8', 'struktur-core' ),
                    '9'  => esc_html__( '9', 'struktur-core' ),
                    '10' => esc_html__( '10', 'struktur-core' ),
                    '11' => esc_html__( '11', 'struktur-core' ),
                    '12' => esc_html__( '12', 'struktur-core' ),
                    '13' => esc_html__( '13', 'struktur-core' ),
                    '14' => esc_html__( '14', 'struktur-core' ),
                    '15' => esc_html__( '15', 'struktur-core' ),
                    '16' => esc_html__( '16', 'struktur-core' ),
                    '17' => esc_html__( '17', 'struktur-core' ),
                    '18' => esc_html__( '18', 'struktur-core' ),
                    '19' => esc_html__( '19', 'struktur-core' ),
                    '20' => esc_html__( '20', 'struktur-core' ),
                    '21' => esc_html__( '21', 'struktur-core' ),
                    '22' => esc_html__( '22', 'struktur-core' ),
                    '23' => esc_html__( '23', 'struktur-core' ),
                    '24' => esc_html__( '24', 'struktur-core' ),
                    '25' => esc_html__( '25', 'struktur-core' ),
                    '26' => esc_html__( '26', 'struktur-core' ),
                    '27' => esc_html__( '27', 'struktur-core' ),
                    '28' => esc_html__( '28', 'struktur-core' ),
                    '29' => esc_html__( '29', 'struktur-core' ),
                    '30' => esc_html__( '30', 'struktur-core' ),
                    '31' => esc_html__( '31', 'struktur-core' ),
                    '32' => esc_html__( '32', 'struktur-core' ),
                    '33' => esc_html__( '33', 'struktur-core' ),
                    '34' => esc_html__( '34', 'struktur-core' ),
                    '35' => esc_html__( '35', 'struktur-core' ),
                    '36' => esc_html__( '36', 'struktur-core' ),
                    '37' => esc_html__( '37', 'struktur-core' ),
                    '38' => esc_html__( '38', 'struktur-core' ),
                    '39' => esc_html__( '39', 'struktur-core' ),
                    '40' => esc_html__( '40', 'struktur-core' ),
                    '41' => esc_html__( '41', 'struktur-core' ),
                    '42' => esc_html__( '42', 'struktur-core' ),
                    '43' => esc_html__( '43', 'struktur-core' ),
                    '44' => esc_html__( '44', 'struktur-core' ),
                    '45' => esc_html__( '45', 'struktur-core' ),
                    '46' => esc_html__( '46', 'struktur-core' ),
                    '47' => esc_html__( '47', 'struktur-core' ),
                    '48' => esc_html__( '48', 'struktur-core' ),
                    '49' => esc_html__( '49', 'struktur-core' ),
                    '50' => esc_html__( '50', 'struktur-core' ),
                    '51' => esc_html__( '51', 'struktur-core' ),
                    '52' => esc_html__( '52', 'struktur-core' ),
                    '53' => esc_html__( '53', 'struktur-core' ),
                    '54' => esc_html__( '54', 'struktur-core' ),
                    '55' => esc_html__( '55', 'struktur-core' ),
                    '56' => esc_html__( '56', 'struktur-core' ),
                    '57' => esc_html__( '57', 'struktur-core' ),
                    '58' => esc_html__( '58', 'struktur-core' ),
                    '59' => esc_html__( '59', 'struktur-core' ),
                    '60' => esc_html__( '60', 'struktur-core' ),
                ]
            ]
        );

        $this->add_control(
            'month_label',
            [
                'label' => esc_html__( 'Month Label', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Month', 'struktur-core' )
            ]
        );

        $this->add_control(
            'day_label',
            [
                'label' => esc_html__( 'Day Label', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Day', 'struktur-core' )
            ]
        );

        $this->add_control(
            'hour_label',
            [
                'label' => esc_html__( 'Hour Label', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Hour', 'struktur-core' )
            ]
        );

        $this->add_control(
            'minute_label',
            [
                'label' => esc_html__( 'Minute Label', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Minute', 'struktur-core' )
            ]
        );

        $this->add_control(
            'second_label',
            [
                'label' => esc_html__( 'Second Label', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Seconds', 'struktur-core' )
            ]
        );

        $this->add_control(
            'digit_font_size',
            [
                'label' => esc_html__( 'Digit Font Size (px)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'label_font_size',
            [
                'label' => esc_html__( 'Label Font Size (px)', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['id']             = mt_rand( 1000, 9999 );
        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_data']    = $this->getHolderData( $params );

        echo struktur_core_get_shortcode_module_template_part( 'templates/countdown', 'countdown', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderData( $params ) {
        $holderData = array();

        $holderData['data-year']         = ! empty( $params['year'] ) ? $params['year'] : '';
        $holderData['data-month']        = ! empty( $params['month'] ) ? $params['month'] : '';
        $holderData['data-day']          = ! empty( $params['day'] ) ? $params['day'] : '';
        $holderData['data-hour']         = $params['hour'] !== '' ? $params['hour'] : '';
        $holderData['data-minute']       = $params['minute'] !== '' ? $params['minute'] : '';
        $holderData['data-month-label']  = ! empty( $params['month_label'] ) ? $params['month_label'] : esc_html__( 'Months', 'struktur-core' );
        $holderData['data-day-label']    = ! empty( $params['day_label'] ) ? $params['day_label'] : esc_html__( 'Days', 'struktur-core' );
        $holderData['data-hour-label']   = ! empty( $params['hour_label'] ) ? $params['hour_label'] : esc_html__( 'Hours', 'struktur-core' );
        $holderData['data-minute-label'] = ! empty( $params['minute_label'] ) ? $params['minute_label'] : esc_html__( 'Minutes', 'struktur-core' );
        $holderData['data-second-label'] = ! empty( $params['second_label'] ) ? $params['second_label'] : esc_html__( 'Seconds', 'struktur-core' );
        $holderData['data-digit-size']   = ! empty( $params['digit_font_size'] ) ? $params['digit_font_size'] : '';
        $holderData['data-label-size']   = ! empty( $params['label_font_size'] ) ? $params['label_font_size'] : '';

        return $holderData;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorCountdown() );