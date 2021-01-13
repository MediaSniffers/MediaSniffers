<?php

class StrukturElementorBlogSlider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_blog_slider';
    }

    public function get_title() {
        return esc_html__( 'Blog Slider', 'struktur' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-blog-slider';
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
            'slider_type',
            [
                'label'   => esc_html__( 'Type', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'slider'            => esc_html__( 'Slider', 'struktur' ),
                    'carousel'          => esc_html__( 'Carousel', 'struktur' ),
                    'carousel-centered' => esc_html__( 'Carousel Centered', 'struktur' )
                ],
                'default' => 'slider'
            ]
        );

        $this->add_control(
            'number_of_posts',
            [
                'label'   => esc_html__( 'Number of Posts', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_by_array(),
                'default' => 'title'
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_array(),
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'category',
            [
                'label'       => esc_html__( 'Category', 'struktur' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'struktur' )
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'     => esc_html__( 'Image Size', 'struktur' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'options'   => [
                    'full'                       => esc_html__( 'Original', 'struktur' ),
                    'struktur_select_image_square'    => esc_html__( 'Square', 'struktur' ),
                    'struktur_select_image_landscape' => esc_html__( 'Landscape', 'struktur' ),
                    'struktur_select_image_portrait'  => esc_html__( 'Portrait', 'struktur' ),
                    'thumbnail'                  => esc_html__( 'Thumbnail', 'struktur' ),
                    'medium'                     => esc_html__( 'Medium', 'struktur' ),
                    'large'                      => esc_html__( 'Large', 'struktur' ),
                    'custom'                      => esc_html__( 'Custom', 'struktur' )
                ],
                'default'   => 'full',
                'condition' => [
                    'slider_type' => array('slider', 'carousel-centered' )
                ]
            ]
        );

        $this->add_control(
            'custom_image_width',
            [
                'label' => esc_html__( "Custom Image Width", 'struktur-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image width in px', 'struktur-core' ),
                'condition' => [
                    'image_size' => array( 'custom' )
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
                    'image_size' => array( 'custom' )
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_info',
            [
                'label' => esc_html__( 'Post Info', 'struktur' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true ),
                'default' => 'h4'
            ]
        );

        $this->add_control(
            'title_transform',
            [
                'label'   => esc_html__( 'Title Text Transform', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_text_transform_array( true )
            ]
        );

        $this->add_control(
            'post_info_author',
            [
                'label'   => esc_html__( 'Enable Post Info Author', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true )
            ]
        );

        $this->add_control(
            'post_info_date',
            [
                'label'   => esc_html__( 'Enable Post Info Date', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true )
            ]
        );

        $this->add_control(
            'post_info_category',
            [
                'label'   => esc_html__( 'Enable Post Info Category', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false, true )
            ]
        );

        $this->add_control(
            'post_info_comments',
            [
                'label'   => esc_html__( 'Enable Post Info Comments', 'struktur' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_yes_no_select_array( false )
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'       => esc_html__( 'Number of Words in Excerpt', 'struktur' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '40'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $default_atts = array(
            'slider_type'         => 'slider',
            'number_of_posts'     => '-1',
            'orderby'             => 'title',
            'order'               => 'ASC',
            'category'            => '',
            'image_size'          => 'full',
            'custom_image_width'  => '',
            'custom_image_height' => '',
            'title_tag'           => 'h2',
            'title_transform'     => '',
            'post_info_author'    => '',
            'post_info_date'      => '',
            'post_info_category'  => '',
            'post_info_comments'  => '',
            'excerpt_length'      => ''
        );
        $params       = shortcode_atts( $default_atts, $params );

        $queryArray             = $this->generateBlogQueryArray( $params );
        $query_result           = new \WP_Query( $queryArray );
        $params['query_result'] = $query_result;

        $params['slider_type']    = ! empty( $params['slider_type'] ) ? $params['slider_type'] : $default_atts['slider_type'];
        $params['slider_classes'] = $this->getSliderClasses( $params );
        $params['slider_data']    = $this->getSliderData( $params );

        ob_start();

        struktur_select_get_module_template_part( 'shortcodes/blog-slider/holder', 'blog', '', $params );

        $html = ob_get_contents();

        ob_end_clean();

        echo struktur_select_get_module_part($html);
    }

    public function generateBlogQueryArray( $params ) {
        $queryArray = array(
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'orderby'        => $params['orderby'],
            'order'          => $params['order'],
            'posts_per_page' => $params['number_of_posts'],
            'post__not_in'   => get_option( 'sticky_posts' )
        );

        if ( ! empty( $params['category'] ) ) {
            $queryArray['category_name'] = $params['category'];
        }

        return $queryArray;
    }

    public function getSliderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = 'qodef-bs-' . $params['slider_type'];

        return implode( ' ', $holderClasses );
    }

    private function getSliderData( $params ) {
        $type        = $params['slider_type'];
        $slider_data = array();

        if($type == 'carousel') {
            $slider_data['data-number-of-items']   = '1';
            $slider_data['data-slider-margin']     = '80';
            $slider_data['data-slider-padding']    = 'yes';
            $slider_data['data-enable-navigation'] = 'no';
            $slider_data['data-enable-pagination'] = 'yes';
        } else if ($type == 'carousel-centered') {
            $slider_data['data-number-of-items']   = '2';
            $slider_data['data-slider-margin']     = '30';
            $slider_data['data-enable-center']     = 'yes';
            $slider_data['data-enable-navigation'] = 'yes';
            $slider_data['data-enable-pagination'] = 'yes';
        } else {
            $slider_data['data-number-of-items']   = '1';
            $slider_data['data-enable-pagination'] = 'yes';
        }

        return $slider_data;
    }

    /**
     * Filter categories
     *
     * @param $query
     *
     * @return array
     */
    public function blogListCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'struktur' ) . ': ' . $value['category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find categories by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function blogListCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get category
            $category = get_term_by( 'slug', $query, 'category' );
            if ( is_object( $category ) ) {

                $category_slug = $category->slug;
                $category_title = $category->name;

                $category_title_display = '';
                if ( ! empty( $category_title ) ) {
                    $category_title_display = esc_html__( 'Category', 'struktur' ) . ': ' . $category_title;
                }

                $data          = array();
                $data['value'] = $category_slug;
                $data['label'] = $category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturElementorBlogSlider() );