<?php

class StrukturCoreElementorHorizontalTimeline extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_horizontal_timeline';
    }

    public function get_title() {
        return esc_html__( 'Horizontal Timeline', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-horizontal-timeline';
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
            'timeline_format',
            [
                'label'       => esc_html__( 'Timeline displays?', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'Y'         =>     esc_html__( 'Only Years', 'struktur-core' ),
                    'M Y'       =>     esc_html__( 'Years and Months', 'struktur-core' ),
                    'M d, \'y'  =>     esc_html__( 'Years, Months and Days', 'struktur-core' ),
                    'M d'       =>     esc_html__( 'Months and Days', 'struktur-core' ),
                ]
            ]
        );

        $this->add_control(
            'distance',
            [
                'label'       => esc_html__( 'Minimal Distance Between Dates?', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 60', 'struktur-core' )
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'date',
            [
                'label'       => esc_html__( 'Timeline Date', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter date in format dd/mm/yyyy.', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'content_image',
            [
                'label'       => esc_html__( 'Content Image', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'select-core'),
                'type' => \Elementor\Controls_Manager::WYSIWYG
            ]
        );

        struktur_core_generate_elementor_templates_control( $repeater, array('content' => '') );

        $this->add_control(
            'horizontal_timeline_items',
            [
                'label'       => esc_html__( 'Horizontal Timeline Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Horizontal Timeline Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $temp_content = [];

        foreach ($params['horizontal_timeline_items'] as $i) {
            $item_date = 'date="' . $i['date'] . '"';
            array_push($temp_content, $item_date);
        }
        $params['content'] = implode( ", ", $temp_content );

        $params['timeline_format'] = ! empty( $params['timeline_format'] ) ? $params['timeline_format'] : $args['timeline_format'];
        $params['dates']           = $this->getDates( $params['content'], $params['timeline_format'] );
        ?>

        <div class="qodef-horizontal-timeline" data-distance="<?php echo esc_attr( $params['distance'] ); ?>">
            <div class="qodef-ht-nav">
                <div class="qodef-ht-nav-wrapper">
                    <div class="qodef-ht-nav-inner">
                        <ol>
                            <?php foreach ( $params['dates'] as $date ) { ?>
                                <li>
                                    <a href="#" data-date="<?php echo esc_attr( $date['formatted'] ); ?>"><?php echo esc_html( $date['date_label'] ); ?></a>
                                </li>
                            <?php } ?>
                        </ol>
                        <span class="qodef-ht-nav-filling-line" aria-hidden="true"></span>
                    </div>
                </div>
                <ul class="qodef-ht-nav-navigation">
                    <li><a href="#" class="qodef-prev qodef-inactive"></a></li>
                    <li><a href="#" class="qodef-next"></a></li>
                </ul>
            </div>
            <div class="qodef-ht-content">
                <ol>
                    <?php
                    foreach ( $params['horizontal_timeline_items'] as $items ) {
                        if( ! empty( $items['content_image'] ) ){
                            $items['content_image'] = $items['content_image']['id'];
                        }
                        if( empty( $items['content'] ) ){
                            $items['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $items['template_id'] );
                        };

                        $items['holder_classes'] = $this->getHolderClasses( $items );

                        echo struktur_core_get_shortcode_module_template_part( 'templates/horizontal-timeline-item', 'horizontal-timeline', '', $items );
                    }
                    ?>
                </ol>
            </div>
        </div>

        <?php
    }

    private function getDates( $content, $timeline_format ) {
        $datesArray = array();

        preg_match_all( '/date="(.*?)"/i', $content, $matches );

        if ( isset( $matches[1] ) && is_array( $matches[1] ) ) {
            foreach ( $matches[1] as $match ) {
                if ( ! empty( $match ) ) {
                    $date      = new \DateTime( str_replace( '/', '-', $match ) );
                    $date_info = getdate( $date->getTimestamp() );

                    switch ( $date_info['month'] ) {
                        case 'January':
                            $month = esc_attr__( 'Jan', 'struktur-core' );
                            break;
                        case 'February':
                            $month = esc_attr__( 'Feb', 'struktur-core' );
                            break;
                        case 'March':
                            $month = esc_attr__( 'Mar', 'struktur-core' );
                            break;
                        case 'April':
                            $month = esc_attr__( 'Apr', 'struktur-core' );
                            break;
                        case 'May':
                            $month = esc_attr__( 'May', 'struktur-core' );
                            break;
                        case 'June':
                            $month = esc_attr__( 'Jun', 'struktur-core' );
                            break;
                        case 'July':
                            $month = esc_attr__( 'Jul', 'struktur-core' );
                            break;
                        case 'August':
                            $month = esc_attr__( 'Aug', 'struktur-core' );
                            break;
                        case 'September':
                            $month = esc_attr__( 'Sep', 'struktur-core' );
                            break;
                        case 'October':
                            $month = esc_attr__( 'Oct', 'struktur-core' );
                            break;
                        case 'November':
                            $month = esc_attr__( 'Nov', 'struktur-core' );
                            break;
                        case 'December':
                            $month = esc_attr__( 'Dec', 'struktur-core' );
                            break;
                        default:
                            $month = $date_info['month'];
                            break;
                    }

                    switch ( $timeline_format ) {
                        case 'Y':
                            $date_label = $date_info['year'];
                            break;
                        case 'M Y':
                            $date_label = $month . ' ' . $date_info['year'];
                            break;
                        case 'M d, \'y':
                            $date_label = $month . ' ' . $date_info['mday'] . ', ' . $date_info['year'];
                            break;
                        case 'M d':
                            $date_label = $month . ' ' . $date_info['mday'];
                            break;
                        default:
                            $date_label = $date_info['year'];
                            break;
                    }

                    $currentDate = array(
                        'formatted'  => $match,
                        'date_label' => $date_label
                    );

                    $datesArray[] = $currentDate;
                }
            }
        }

        return $datesArray;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['content_image'] ) ? 'qodef-timeline-has-image' : 'qodef-timeline-no-image';

        return implode( ' ', $holderClasses );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorHorizontalTimeline() );