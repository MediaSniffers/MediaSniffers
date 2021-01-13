<?php

class StrukturElementorProductList extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_product_list';
    }

    public function get_title() {
        return esc_html__( 'Product List', 'struktur' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-product-list';
    }

    public function get_categories() {
        return [ 'struktur' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'struktur' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard' => esc_html__( 'Standard', 'struktur' ),
                    'masonry'  => esc_html__( 'Masonry', 'struktur' )
                ],
                'default' => 'standard'
            ]
        );

        $this->add_control(
            'info_position',
            [
                'label'   => esc_html__( 'Product Info Position', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'info-on-image'    => esc_html__( 'Info On Image Hover', 'struktur' ),
                    'info-below-image' => esc_html__( 'Info Below Image', 'struktur' )
                ],
                'default' => 'info-on-image'
            ]
        );

        $this->add_control(
            'enable_animation',
            [
                'label'   => esc_html__( 'Enable Animation', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array(false, true),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'number_of_posts',
            [
                'label'   => esc_html__( 'Number of Products', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '8'
            ]
        );

        $this->add_control(
            'number_of_columns',
            [
                'label'   => esc_html__( 'Number of Columns', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_number_of_columns_array( true ),
                'default' => 'three'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label'   => esc_html__( 'Space Between Items', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_space_between_items_array(),
                'default' => 'large'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_by_array( false, array( 'on-sale' => esc_html__( 'On Sale', 'struktur' ) ) ),
                'default' => 'date'
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_array(),
                'order' => 'ASC'
            ]
        );

        $this->add_control(
            'taxonomy_to_display',
            [
                'label'       => esc_html__( 'Choose Sorting Taxonomy', 'struktur' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'category' => esc_html__( 'Category', 'struktur' ),
                    'tag'      => esc_html__( 'Tag', 'struktur' ),
                    'id'       => esc_html__( 'Id', 'struktur' ),
                ],
                'default'     => 'category',
                'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'struktur' )
            ]
        );

        $this->add_control(
            'taxonomy_values',
            [
                'label'       => esc_html__( 'Enter Taxonomy Values', 'struktur' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'struktur' )
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'   => esc_html__( 'Image Proportions', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''                      => esc_html__( 'Default', 'struktur' ),
                    'full'                  => esc_html__( 'Original', 'struktur' ),
                    'square'                => esc_html__( 'Square', 'struktur' ),
                    'landscape'             => esc_html__( 'Landscape', 'struktur' ),
                    'portrait'              => esc_html__( 'Portrait', 'struktur' ),
                    'medium'                => esc_html__( 'Medium', 'struktur' ),
                    'large'                 => esc_html__( 'Large', 'struktur' ),
                    'woocommerce_single'    => esc_html__( 'Shop Single', 'struktur' ),
                    'woocommerce_thumbnail' => esc_html__( 'Shop Thumbnail', 'struktur' ),
                ],
                'default' => 'full'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_info',
            [
                'label' => esc_html__( 'Product Info', 'struktur' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label'   => esc_html__( 'Display Title', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'product_info_skin',
            [
                'label'     => esc_html__( 'Product Info Skin', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'struktur' ),
                    'light'   => esc_html__( 'Light', 'struktur' ),
                    'dark'    => esc_html__( 'Dark', 'struktur' ),
                ],
                'condition' => [
                    'info_position' => array( 'info-on-image' )
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title Tag', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_title_tag( true ),
                'condition' => [
                    'display_title' => array( 'yes' )
                ],
                'default' => 'h5'
            ]
        );

        $this->add_control(
            'title_transform',
            [
                'label'     => esc_html__( 'Title Text Transform', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => struktur_select_get_text_transform_array( true ),
                'condition' => [
                    'display_title' => array( 'yes' )
                ],
            ]
        );

        $this->add_control(
            'display_category',
            [
                'label'   => esc_html__( 'Display Category', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'display_excerpt',
            [
                'label'   => esc_html__( 'Display Excerpt', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'       => esc_html__( 'Excerpt Length', 'struktur' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Number of characters', 'struktur' ),
                'condition'   => [
                    'display_excerpt' => array( 'yes' )
                ],
                'default' => '20'
            ]
        );

        $this->add_control(
            'display_rating',
            [
                'label'   => esc_html__( 'Display Rating', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'display_price',
            [
                'label'   => esc_html__( 'Display Price', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'display_button',
            [
                'label'   => esc_html__( 'Display Button', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'button_skin',
            [
                'label'     => esc_html__( 'Button Skin', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'struktur' ),
                    'light'   => esc_html__( 'Light', 'struktur' ),
                    'dark'    => esc_html__( 'Dark', 'struktur' ),
                ],
                'condition' => [
                    'display_button' => array( 'yes' )
                ],
                'default' => 'default'
            ]
        );

        $this->add_control(
            'shader_background_color',
            [
                'label' => esc_html__( 'Shader Background Color', 'struktur' ),
                'type'  => \Elementor\Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'info_bottom_text_align',
            [
                'label'     => esc_html__( 'Product Info Text Alignment', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'struktur' ),
                    'left'    => esc_html__( 'Left', 'struktur' ),
                    'center'  => esc_html__( 'Center', 'struktur' ),
                    'right'   => esc_html__( 'Right', 'struktur' ),
                ],
                'condition' => [
                    'info_position' => array( 'info-below-image' )
                ],
            ]
        );

        $this->add_control(
            'info_bottom_margin',
            [
                'label'     => esc_html__( 'Product Info Bottom Margin (px)', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'info_position' => array( 'info-below-image' )
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $default_atts = array(
            'type'                    => 'standard',
            'info_position'           => 'info-on-image',
            'enable_animation'        => 'yes',
            'number_of_posts'         => '8',
            'number_of_columns'       => 'four',
            'space_between_items'     => 'normal',
            'orderby'                 => 'date',
            'order'                   => 'ASC',
            'taxonomy_to_display'     => 'category',
            'taxonomy_values'         => '',
            'image_size'              => 'full',
            'display_title'           => 'yes',
            'product_info_skin'       => '',
            'title_tag'               => 'h5',
            'title_transform'         => '',
            'display_category'        => 'no',
            'display_excerpt'         => 'no',
            'excerpt_length'          => '20',
            'display_rating'          => 'yes',
            'display_price'           => 'yes',
            'display_button'          => 'yes',
            'button_skin'             => 'default',
            'shader_background_color' => '',
            'info_bottom_text_align'  => '',
            'info_bottom_margin'      => ''
        );
        $params       = shortcode_atts( $default_atts, $params );

        $params['class_name']     = 'pli';
        $params['type']           = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
        $params['info_position']  = ! empty( $params['info_position'] ) ? $params['info_position'] : $default_atts['info_position'];
        $params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];

        $additional_params                   = array();
        $additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );

        $queryArray                        = $this->generateProductQueryArray( $params );
        $query_result                      = new \WP_Query( $queryArray );
        $additional_params['query_result'] = $query_result;

        $params['this_object'] = $this;

        echo struktur_select_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list', $params['type'], $params, $additional_params );
    }

    private function getHolderClasses( $params, $default_atts ) {
        $holderClasses   = array();
        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-' . $params['type'] . '-layout' : 'qodef-' . $default_atts['type'] . '-layout';
        $holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $default_atts['number_of_columns'] . '-columns';
        $holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
        $holderClasses[] = ! empty( $params['info_position'] ) ? 'qodef-' . $params['info_position'] : 'qodef-' . $default_atts['info_position'];
        $holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'qodef-product-info-' . $params['product_info_skin'] : '';

        if($params['enable_animation'] == 'no'){
            $holderClasses[] = 'qodef-pl-animation-disabled';
        }

        return implode( ' ', $holderClasses );
    }

    private function generateProductQueryArray( $params ) {
        $queryArray = array(
            'post_status'         => 'publish',
            'post_type'           => 'product',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $params['number_of_posts'],
            'orderby'             => $params['orderby'],
            'order'               => $params['order']
        );

        if ( $params['orderby'] === 'on-sale' ) {
            $queryArray['no_found_rows'] = 1;
            $queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
        }

        if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
            $idArray                = $params['taxonomy_values'];
            $ids                    = explode( ',', $idArray );
            $queryArray['orderby'] = 'post__in';
            $queryArray['post__in'] = $ids;
        }

        return $queryArray;
    }

    public function getItemClasses( $params ) {
        $itemClasses = array();

        $image_size_meta = get_post_meta( get_the_ID(), 'qodef_product_featured_image_size', true );

        if ( ! empty( $image_size_meta ) ) {
            $itemClasses[] = 'qodef-fixed-masonry-item qodef-masonry-size-' . $image_size_meta;
        }

        return implode( ' ', $itemClasses );
    }

    public function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_transform'] ) ) {
            $styles[] = 'text-transform: ' . $params['title_transform'];
        }

        return implode( ';', $styles );
    }

    public function getShaderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['shader_background_color'] ) ) {
            $styles[] = 'background-color: ' . $params['shader_background_color'];
        }

        return implode( ';', $styles );
    }

    public function getTextWrapperStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['info_bottom_text_align'] ) ) {
            $styles[] = 'text-align: ' . $params['info_bottom_text_align'];
        }

        if ( $params['info_bottom_margin'] !== '' ) {
            $styles[] = 'margin-bottom: ' . struktur_select_filter_px( $params['info_bottom_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturElementorProductList() );