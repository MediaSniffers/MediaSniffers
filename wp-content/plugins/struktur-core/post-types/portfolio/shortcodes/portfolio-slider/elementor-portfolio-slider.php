<?php

class StrukturCoreElementorElementorPortfolioSlider extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_portfolio_slider';
    }

    public function get_title() {
        return esc_html__( "Portfolio Slider", 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-portfolio-slider';
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
            'number_of_items',
            [
                'label' => esc_html__( "Number of Portfolios Items", 'struktur-core' ),
                'description' => esc_html__( 'Set number of items for your portfolio slider. Enter -1 to show all', 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );

        $this->add_control(
            'item_type',
            [
                'label' => esc_html__( "Click Behavior", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''        => esc_html__( 'Open portfolio single page on click', 'struktur-core' ),
                    'gallery' => esc_html__( 'Open gallery in Pretty Photo on click', 'struktur-core' )
                ],
                'default' => ''
            ]
        );

        $this->add_control(
            'two_rows',
            [
                'label' => esc_html__( "Split in Two Rows", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'number_of_columns',
            [
                'label' => esc_html__( "Number of Columns", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_number_of_columns_array( true ),
                'description' => esc_html__( 'Number of portfolios that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'struktur-core' ),
                'default' => 'four',
                'condition' => [
                    'enable_auto_width' => array( 'no' )
                ]
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label' => esc_html__( "Space Between Items", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'image_proportions',
            [
                'label' => esc_html__( "Image Proportions", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'full'      => esc_html__( 'Original', 'struktur-core' ),
                    'square'    => esc_html__( 'Square', 'struktur-core' ),
                    'landscape' => esc_html__( 'Landscape', 'struktur-core' ),
                    'portrait'  => esc_html__( 'Portrait', 'struktur-core' ),
                    'medium'    => esc_html__( 'Medium', 'struktur-core' ),
                    'large'     => esc_html__( 'Large', 'struktur-core' ),
                    'custom'    => esc_html__( 'Custom', 'struktur-core' )
                ],
                'description' => esc_html__( 'Set image proportions for your portfolio slider.', 'struktur-core' ),
                'default' => 'full'
            ]
        );

        $this->add_control(
            'custom_image_width',
            [
                'label' => esc_html__( "Custom Image Width", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image width in px', 'struktur-core' ),
                'condition' => [
                    'image_proportions' => array( 'custom' )
                ]
            ]
        );

        $this->add_control(
            'custom_image_height',
            [
                'label' => esc_html__( "Custom Image Height", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image height in px', 'struktur-core' ),
                'condition' => [
                    'image_proportions' => array( 'custom' )
                ]
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__( "One-Category Portfolio List", 'struktur-core' ),
                "description" => esc_html__( "Enter one category slug (leave empty for showing all categories)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'selected_projects',
            [
                'label' => esc_html__( "Show Only Projects with Listed IDs", 'struktur-core' ),
                'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => esc_html__( "One-Tag Portfolio List", 'struktur-core' ),
                'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( "Order By", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_by_array(),
                'default' => 'date'
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( "Order", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_array(),
                'default' => 'ASC'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_layout',
            [
                'label' => esc_html__( 'Content Layout', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'item_style',
            [
                'label' => esc_html__( "Item Style", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard-zoom'             => esc_html__( 'Standard - Zoom', 'struktur-core' ),
                    'standard-shader'           => esc_html__( 'Standard - Grayscale', 'struktur-core' ),
                    'standard-switch-images'    => esc_html__( 'Standard - Switch Featured Images', 'struktur-core' ),
                    'gallery-overlay'           => esc_html__( 'Gallery - Custom Cursor', 'struktur-core' ),
                    'gallery-slide-from-image-bottom'    => esc_html__( 'Gallery - Slide From Image Bottom', 'struktur-core' ),
                    'gallery-follow-info'                => esc_html__( 'Gallery - Follow Info', 'struktur-core' )
                ],
                'default' => 'standard-zoom'
            ]
        );

        $this->add_control(
            'content_top_margin',
            [
                'label' => esc_html__( "Content Top Margin (px or %)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'item_style' => array( 'standard-zoom', 'standard-shader', 'standard-switch-images' )
                ]
            ]
        );

        $this->add_control(
            'content_bottom_margin',
            [
                'label' => esc_html__( "Content Bottom Margin (px or %)", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'item_style' => array( 'standard-zoom', 'standard-shader', 'standard-switch-images' )
                ]
            ]
        );

        $this->add_control(
            'enable_title',
            [
                'label' => esc_html__( "Enable Title", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( "Title Tag", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'default' => 'h4',
                'condition' => [
                    'enable_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'title_text_transform',
            [
                'label' => esc_html__( "Title Text Transform", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_text_transform_array( true ),
                'condition' => [
                    'enable_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'enable_category',
            [
                'label' => esc_html__( "Enable Category", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'enable_count_images',
            [
                'label' => esc_html__( "Enable Number of Images", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes',
                'condition' => [
                    'type' => array( 'gallery' )
                ]
            ]
        );

        $this->add_control(
            'enable_excerpt',
            [
                'label' => esc_html__( "Enable Excerpt", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => esc_html__( "Excerpt Length", 'struktur-core' ),
                'description' => esc_html__( 'Number of characters', 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'enable_excerpt' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => esc_html__( 'Slider Settings', 'struktur-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_auto_width',
            [
                'label' => esc_html__( "Enable Auto Width", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'enable_loop',
            [
                'label'   => esc_html__( 'Enable Slider Loop', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes',
                'condition' => [
                    'item_type' => ''
                ]
            ]
        );

        $this->add_control(
            'enable_autoplay',
            [
                'label'   => esc_html__( 'Enable Slider Autoplay', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'   => esc_html__( 'Slide Duration', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'struktur-core' ),
                'default' => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'   => esc_html__( 'Slide Animation Duration', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'struktur-core' ),
                'default' => '600'
            ]
        );

        $this->add_control(
            'enable_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'navigation_skin',
            [
                'label' => esc_html__( "Navigation Skin", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''         => esc_html__( 'Default', 'struktur-core' ),
                    'light'    => esc_html__( 'Light', 'struktur-core' ),
                    'dark'     => esc_html__( 'Dark', 'struktur-core' ),
                ],
                'default' => '',
                'condition' => [
                    'enable_navigation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'enable_pagination',
            [
                'label'   => esc_html__( 'Enable Slider Pagination', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pagination_skin',
            [
                'label' => esc_html__( "Navigation Skin", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''         => esc_html__( 'Default', 'struktur-core' ),
                    'light'    => esc_html__( 'Light', 'struktur-core' ),
                    'dark'     => esc_html__( 'Dark', 'struktur-core' ),
                ],
                'default' => '',
                'condition' => [
                    'enable_pagination' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pagination_position',
            [
                'label' => esc_html__( "Pagination Position", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'below-slider'         => esc_html__( 'Below Slider', 'struktur-core' ),
                    'on-slider'    => esc_html__( 'On Slider', 'struktur-core' )
                ],
                'default' => 'below-slider',
                'condition' => [
                    'enable_pagination' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        $args   = array(
            'number_of_items'        => '9',
            'item_type'              => '',
            'two_rows'               => '',
            'enable_auto_width'      => '',
            'number_of_columns'      => 'four',
            'space_between_items'    => 'normal',
            'image_proportions'      => 'full',
            'custom_image_width'     => '',
            'custom_image_height'    => '',
            'category'               => '',
            'selected_projects'      => '',
            'tag'                    => '',
            'orderby'                => 'date',
            'order'                  => 'ASC',
            'item_style'             => 'standard-zoom',
            'content_top_margin'     => '',
            'content_bottom_margin'  => '',
            'enable_title'           => 'yes',
            'title_tag'              => 'h4',
            'title_text_transform'   => '',
            'enable_category'        => 'yes',
            'enable_count_images'    => 'yes',
            'enable_excerpt'         => 'no',
            'excerpt_length'         => '20',
            'enable_loop'            => 'no',
            'enable_autoplay'        => 'yes',
            'slider_speed'           => '5000',
            'slider_speed_animation' => '600',
            'enable_navigation'      => 'yes',
            'navigation_skin'        => '',
            'enable_pagination'      => 'yes',
            'pagination_skin'        => '',
            'pagination_position'    => 'below-slider'
        );
        $params = shortcode_atts( $args, $params );

        $params['type']                = 'gallery';
        $params['portfolio_slider_on'] = 'yes';

        $html = '<div class="qodef-portfolio-slider-holder">';
        $html .= struktur_select_execute_shortcode( 'qodef_portfolio_list', $params );
        $html .= '</div>';

        echo struktur_select_get_module_part($html);
    }

    public function portfolioCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'struktur-core' ) . ': ' . $value['portfolio_category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio category
            $portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
            if ( is_object( $portfolio_category ) ) {

                $portfolio_category_slug  = $portfolio_category->slug;
                $portfolio_category_title = $portfolio_category->name;

                $portfolio_category_title_display = '';
                if ( ! empty( $portfolio_category_title ) ) {
                    $portfolio_category_title_display = esc_html__( 'Category', 'struktur-core' ) . ': ' . $portfolio_category_title;
                }

                $data          = array();
                $data['value'] = $portfolio_category_slug;
                $data['label'] = $portfolio_category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter portfolios by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioIdAutocompleteSuggester( $query ) {
        global $wpdb;
        $portfolio_id    = (int) $query;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__( 'Id', 'struktur-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'struktur-core' ) . ': ' . $value['title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioIdAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio
            $portfolio = get_post( (int) $query );
            if ( ! is_wp_error( $portfolio ) ) {

                $portfolio_id    = $portfolio->ID;
                $portfolio_title = $portfolio->post_title;

                $portfolio_title_display = '';
                if ( ! empty( $portfolio_title ) ) {
                    $portfolio_title_display = ' - ' . esc_html__( 'Title', 'struktur-core' ) . ': ' . $portfolio_title;
                }

                $portfolio_id_display = esc_html__( 'Id', 'struktur-core' ) . ': ' . $portfolio_id;

                $data          = array();
                $data['value'] = $portfolio_id;
                $data['label'] = $portfolio_id_display . $portfolio_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter portfolio tags
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioTagAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'struktur-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio tag by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioTagAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio category
            $portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
            if ( is_object( $portfolio_tag ) ) {

                $portfolio_tag_slug  = $portfolio_tag->slug;
                $portfolio_tag_title = $portfolio_tag->name;

                $portfolio_tag_title_display = '';
                if ( ! empty( $portfolio_tag_title ) ) {
                    $portfolio_tag_title_display = esc_html__( 'Tag', 'struktur-core' ) . ': ' . $portfolio_tag_title;
                }

                $data          = array();
                $data['value'] = $portfolio_tag_slug;
                $data['label'] = $portfolio_tag_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorElementorPortfolioSlider() );