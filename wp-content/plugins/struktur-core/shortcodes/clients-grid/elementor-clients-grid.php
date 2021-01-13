<?php

class StrukturCoreElementorClientsGrid extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_clients_grid';
    }

    public function get_title() {
        return esc_html__( 'Clients Grid', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-clients-grid';
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
            'number_of_columns',
            [
                'label'   => esc_html__( 'Number of Columns', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_number_of_columns_array( true ),
                'default' => 'three'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label'   => esc_html__( 'Space Between Items', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'image_alignment',
            [
                'label'   => esc_html__( 'Items Horizontal Alignment', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''      => esc_html__( 'Default Center', 'struktur-core' ),
                    'left'  => esc_html__( 'Left', 'struktur-core' ),
                    'right' => esc_html__( 'Right', 'struktur-core' ),
                ]
            ]
        );

        $this->add_control(
            'items_hover_animation',
            [
                'label'   => esc_html__( 'Items Hover Animation', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'switch-images' => esc_html__( 'Switch Images', 'struktur-core' ),
                    'roll-over'     => esc_html__( 'Roll Over', 'struktur-core' )
                ],
                'default' => 'switch-images'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label'       => esc_html__( 'Image', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'hover_image',
            [
                'label'       => esc_html__( 'Hover Image', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'struktur-core' )
            ]
        );

        $repeater->add_control(
            'image_size',
            [
                'label'       => esc_html__( 'Image Size', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'struktur-core' ),
                'default'     => 'full'
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Custom Link', 'struktur-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'target',
            [
                'label'   => esc_html__( 'Custom Link Target', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_link_target_array(),
                'default' => '_self'
            ]
        );

        $this->add_control(
            'clients_item',
            [
                'label'       => esc_html__( 'Client Items', 'struktur-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Client Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args = array(
            'number_of_columns'     => 'three',
            'space_between_items'   => 'normal',
            'image_alignment'       => '',
            'items_hover_animation' => 'switch-images'
        );

        $params['holder_classes'] = $this->getHolderClasses( $params, $args );
        extract( $params );
        ?>

        <div class="qodef-clients-grid-holder qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr( $holder_classes ); ?>">
            <div class="qodef-cg-inner qodef-outer-space">
                <?php foreach ( $params['clients_item'] as $client ) {

                    $client['item_classes'] = $this->getItemClasses( $client, $args );
                    $client['image']        = $this->getCarouselImage( $client );
                    $client['hover_image']  = $this->getCarouselHoverImage( $client );

                    echo struktur_core_get_shortcode_module_template_part( 'templates/elementor-clients-grid-item', 'clients-grid', '', $client );
                } ?>
            </div>
        </div>

        <?php
    }

    private function getHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $args['number_of_columns'] . '-columns';
        $holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';
        $holderClasses[] = ! empty( $params['image_alignment'] ) ? 'qodef-cg-alignment-' . $params['image_alignment'] : '';
        $holderClasses[] = ! empty( $params['items_hover_animation'] ) ? 'qodef-cc-hover-' . $params['items_hover_animation'] : 'qodef-cc-hover-' . $args['items_hover_animation'];

        return implode( ' ', $holderClasses );
    }

    private function getItemClasses( $client, $args ) {
        $itemClasses = array();

        $itemClasses[] = ! empty( $client['link'] ) ? 'qodef-cci-has-link' : 'qodef-cci-no-link';

        return implode( ' ', $itemClasses );
    }

    private function getCarouselImage( $client ) {
        $image_meta = array();

        $client['image'] = $client['image']['id'];

        if ( ! empty( $client['image'] ) ) {
            $image_size     = $this->getCarouselImageSize( $client['image_size'] );
            $image_id       = $client['image'];
            $image_original = wp_get_attachment_image_src( $image_id, $image_size );
            $image['url']   = $image_original[0];
            $image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

            $image_meta = $image;
        }

        return $image_meta;
    }

    private function getCarouselHoverImage( $client ) {
        $image_meta = array();

        $client['hover_image'] = $client['hover_image']['id'];

        if ( ! empty( $client['hover_image'] ) ) {
            $image_size     = $this->getCarouselImageSize( $client['image_size'] );
            $image_id       = $client['hover_image'];
            $image_original = wp_get_attachment_image_src( $image_id, $image_size );
            $image['url']   = $image_original[0];
            $image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

            $image_meta = $image;
        }

        return $image_meta;
    }

    private function getCarouselImageSize( $image_size ) {
        $image_size = trim( $image_size );

        //Find digits
        preg_match_all( '/\d+/', $image_size, $matches );

        if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
            return $image_size;
        } elseif ( ! empty( $matches[0] ) ) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'full';
        }
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorClientsGrid() );