<?php

class StrukturCoreElementorTabs extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_tabs';
    }

    public function get_title() {
        return esc_html__( 'Tabs', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-tabs';
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
            'type',
            [
                'label'   => esc_html__( 'Type', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard' => esc_html__( 'Standard', 'struktur-core' ),
                    'boxed'    => esc_html__( 'Boxed', 'struktur-core' ),
                    'simple'   => esc_html__( 'Simple', 'struktur-core' ),
                    'vertical' => esc_html__( 'Vertical', 'struktur-core' ),
                ],
                'default' => 'standard'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'tab_text',
            [
                'label'       => esc_html__( 'Text', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'tabs_item',
            [
                'label'       => esc_html__( 'Tabs Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Tabs Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses( $params );
        ?>

        <div class="qodef-tabs <?php echo esc_attr( $params['holder_classes'] ); ?>">
            <ul class="qodef-tabs-nav clearfix">
                <?php foreach ( $params['tabs_item'] as $tab ) { ?>
                    <li>
                        <?php if ( ! empty( $tab['tab_title'] ) ) { ?>
                            <a href="#tab-<?php echo sanitize_title( $tab['tab_title'] ) ?>"><?php echo esc_html( $tab['tab_title'] ); ?></a>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>

            <?php foreach ( $params['tabs_item'] as $tab ) {

                $rand_number         = rand( 0, 1000 );
                $tab['tab_title'] = $tab['tab_title'] . '-' . $rand_number;

                echo struktur_core_get_shortcode_module_template_part( 'templates/elementor-tab-content', 'tabs', '', $tab );
            } ?>

        </div>
        <?php
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-tabs-' . esc_attr( $params['type'] ) : 'qodef-tabs-standard';

        return implode( ' ', $holderClasses );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorTabs() );