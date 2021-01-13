<?php

class StrukturCoreElementorFullScreenSections extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_full_screen_sections';
    }

    public function get_title() {
        return esc_html__( 'Full Screen Sections', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-full-screen-sections';
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
            'enable_continuous_vertical',
            [
                'label'       => esc_html__( 'Enable Continuous Scrolling', 'struktur-core' ),
                'description' => esc_html__( 'Defines whether scrolling down in the last section or should scroll down to the first one and if scrolling up in the first section should scroll up to the last one', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false ),
                'deafult'     => 'no'
            ]
        );

        $this->add_control(
            'enable_navigation',
            [
                'label'       => esc_html__( 'Enable Navigation Arrows', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false, true ),
                'default'     => 'yes'
            ]
        );

        $this->add_control(
            'enable_pagination',
            [
                'label'       => esc_html__( 'Enable Pagination Dots', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => struktur_select_get_yes_no_select_array( false, true ),
                'default'     => 'yes'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'custom_class',
            [
                'label' => esc_html__( 'Custom CSS Class', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'struktur-core'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'background_position',
            [
                'label' => esc_html__( 'Background Image Position', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Please insert position in format horizontal vertical position, example - center center', 'struktur-core' ),
            ]
        );

        $repeater->add_control(
            'background_size',
            [
                'label' => esc_html__( 'Background Image Size', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'cover' => esc_html__( 'Cover', 'struktur-core' ),
                    'contain' => esc_html__( 'Contain', 'struktur-core' ),
                    'inherit' => esc_html__( 'Inherit', 'struktur-core' ),
                ],
                'default' => 'cover'
            ]
        );

        $repeater->add_control(
            'padding',
            [
                'label' => esc_html__( 'Content Padding', 'struktur-core' ),
                'description' => esc_html__( 'Please insert padding in format top right bottom left. You can use px or %', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'vertical_alignment',
            [
                'label' => esc_html__( 'Content Vertical Alignment', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'struktur-core' ),
                    'top' => esc_html__( 'Top', 'struktur-core' ),
                    'middle' => esc_html__( 'Middle', 'struktur-core' ),
                    'bottom' => esc_html__( 'Bottom', 'struktur-core' ),
                ],
                'default' => ''
            ]
        );

        $repeater->add_control(
            'horizontal_alignment',
            [
                'label' => esc_html__( 'Content Horizontal Alignment', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'struktur-core' ),
                    'left' => esc_html__( 'Left', 'struktur-core' ),
                    'center' => esc_html__( 'Center', 'struktur-core' ),
                    'right' => esc_html__( 'Right', 'struktur-core' ),
                ],
                'default' => ''
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Set custom link around item', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'link_target',
            [
                'label' => esc_html__( 'Custom Link Target', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'default' => '_blank',
                'condition' => [
                    'link!' => ''
                ]
            ]
        );

        $repeater->add_control(
            'header_skin',
            [
                'label' => esc_html__( 'Header and Navigation Skin', 'struktur-core' ),
                'description' => esc_html__( 'Choose a predefined header style for header elements and for full screen sections navigation/pagination', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'struktur-core' ),
                    'light' => esc_html__( 'Light', 'struktur-core' ),
                    'dark' => esc_html__( 'Dark', 'struktur-core' ),
                ],
                'default' => ''
            ]
        );

        $repeater->add_control(
            'image_laptop',
            [
                'label' => esc_html__('Background Image for Laptops', 'struktur-core'),
                'type'  => \Elementor\Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'image_tablet',
            [
                'label' => esc_html__('Background Image for Tablets - Landscape', 'struktur-core'),
                'type'  => \Elementor\Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'image_tablet_portrait',
            [
                'label' => esc_html__('Background Image for Tablets - Portrait', 'struktur-core'),
                'type'  => \Elementor\Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'image_mobile',
            [
                'label' => esc_html__('Background Image for Mobiles', 'struktur-core'),
                'type'  => \Elementor\Controls_Manager::MEDIA
            ]
        );

        struktur_core_generate_elementor_templates_control( $repeater );

        $this->add_control(
            'fss_items',
            [
                'label'       => esc_html__( 'Full Screen Section Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Full Screen Section Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_data']    = $this->getHolderData( $params );
        extract( $params );
        ?>

        <div class="qodef-full-screen-sections <?php echo esc_attr( $holder_classes ); ?>" <?php echo struktur_select_get_inline_attrs( $holder_data ); ?>>
            <div class="qodef-fss-wrapper">
                <?php  foreach( $fss_items as $fss_item ){
                    $rand_class = 'qodef-fss-custom-' . mt_rand(100000,1000000);

                    if( ! empty( $fss_item['background_image'] ) ){
                        $fss_item['background_image'] = $fss_item['background_image']['id'];
                    }

                    if( ! empty( $fss_item['image_laptop'] ) ){
                        $fss_item['image_laptop'] = $fss_item['image_laptop']['id'];
                    }

                    if( ! empty( $fss_item['image_tablet'] ) ){
                        $fss_item['image_tablet'] = $fss_item['image_tablet']['id'];
                    }

                    if( ! empty( $fss_item['image_tablet_portrait'] ) ){
                        $fss_item['image_tablet_portrait'] = $fss_item['image_tablet_portrait']['id'];
                    }

                    if( ! empty( $fss_item['image_mobile'] ) ){
                        $fss_item['image_mobile'] = $fss_item['image_mobile']['id'];
                    }

                    $fss_item['holder_unique_class'] = $rand_class;
                    $fss_item['holder_classes']      = $this->getItemHolderClasses( $fss_item );
                    $fss_item['holder_data']         = $this->getItemHolderData( $fss_item );
                    $fss_item['holder_styles']       = $this->getItemHolderStyles( $fss_item );
                    $fss_item['item_inner_styles']   = $this->getItemInnerStyles( $fss_item );
                    $fss_item['link_target']         = !empty($fss_item['link_target']) ? $fss_item['link_target'] : '_self';

                    $fss_item['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($fss_item['template_id']);

                    echo struktur_core_get_shortcode_module_template_part( 'templates/full-screen-sections-item', 'full-screen-sections', '', $fss_item );

                } ?>
            </div>
            <?php if ( $enable_navigation === 'yes' ) { ?>
                <div class="qodef-fss-nav-holder">
                    <a id="qodef-fss-nav-up" href="#"><span class='icon-arrows-up'></span></a>
                    <a id="qodef-fss-nav-down" href="#"><span class='icon-arrows-down'></span></a>
                </div>
            <?php } ?>
        </div>
        <?php
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = $params['enable_navigation'] === 'yes' ? 'qodef-fss-has-nav' : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderData( $params ) {
        $data = array();

        if ( ! empty( $params['enable_continuous_vertical'] ) ) {
            $data['data-enable-continuous-vertical'] = $params['enable_continuous_vertical'];
        }

        if ( ! empty( $params['enable_navigation'] ) ) {
            $data['data-enable-navigation'] = $params['enable_navigation'];
        }

        if ( ! empty( $params['enable_pagination'] ) ) {
            $data['data-enable-pagination'] = $params['enable_pagination'];
        }

        return $data;
    }

    private function getItemHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['holder_unique_class'] ) ? $params['holder_unique_class'] : '';
        $holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'qodef-fss-item-va-' . $params['vertical_alignment'] : '';
        $holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'qodef-fss-item-ha-' . $params['horizontal_alignment'] : '';
        $holderClasses[] = ! empty( $params['link'] ) ? 'qodef-fss-item-has-link' : '';
        $holderClasses[] = ! empty( $params['header_skin'] ) ? 'qodef-fss-item-has-style' : '';

        return implode( ' ', $holderClasses );
    }

    private function getItemHolderData( $params ) {
        $data                    = array();
        $data['data-item-class'] = $params['holder_unique_class'];

        if ( ! empty( $params['header_skin'] ) ) {
            $data['data-header-style'] = $params['header_skin'];
        }

        if ( ! empty( $params['image_laptop'] ) ) {
            $image                     = wp_get_attachment_image_src( $params['image_laptop'], 'full' );
            $data['data-laptop-image'] = $image[0];
        }

        if ( ! empty( $params['image_tablet'] ) ) {
            $image                     = wp_get_attachment_image_src( $params['image_tablet'], 'full' );
            $data['data-tablet-image'] = $image[0];
        }

        if ( ! empty( $params['image_tablet_portrait'] ) ) {
            $image                              = wp_get_attachment_image_src( $params['image_tablet_portrait'], 'full' );
            $data['data-tablet-portrait-image'] = $image[0];
        }

        if ( ! empty( $params['image_mobile'] ) ) {
            $image                     = wp_get_attachment_image_src( $params['image_mobile'], 'full' );
            $data['data-mobile-image'] = $image[0];
        }

        return $data;
    }

    private function getItemHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['background_color'] ) ) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        if ( ! empty( $params['background_image'] ) ) {
            $styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';

            if ( ! empty( $params['background_position'] ) ) {
                $styles[] = 'background-position:' . $params['background_position'];
            }

            if ( ! empty( $params['background_size'] ) ) {
                $styles[] = 'background-size:' . $params['background_size'];
            }
        }

        return implode( ';', $styles );
    }

    private function getItemInnerStyles( $params ) {
        $styles = array();

        if ( $params['padding'] !== '' ) {
            $styles[] = 'padding: ' . $params['padding'];
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorFullScreenSections() );