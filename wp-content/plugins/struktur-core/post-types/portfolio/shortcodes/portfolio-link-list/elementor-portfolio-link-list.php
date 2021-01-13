<?php

class StrukturCoreElementorElementorPortfolioLinkList extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'qodef_portfolio_link_list';
    }

    public function get_title()
    {
        return esc_html__("Portfolio Link List", 'struktur-core');
    }

    public function get_icon()
    {
        return 'struktur-elementor-custom-icon struktur-elementor-portfolio-link-list';
    }

    public function get_categories()
    {
        return ['struktur'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'struktur-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_items',
            [
                'label' => esc_html__("Number of Portfolios Per Page", 'struktur-core'),
                'description' => esc_html__('et number of items for your portfolio list. Enter -1 to show all.', 'struktur-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__("One-Category Portfolio List", 'struktur-core'),
                'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'struktur-core'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'selected_projects',
            [
                'label' => esc_html__("Show Only Projects with Listed IDs", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'struktur-core')
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => esc_html__("One-Tag Portfolio List", 'struktur-core'),
                'description' => esc_html__('Enter one tag slug (leave empty for showing all tags)', 'struktur-core'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => esc_html__("Order By", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_by_array(),
                'default' => 'date'
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__("Order", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_query_order_array(),
                'default' => 'ASC'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'layout',
            [
                'label' => esc_html__('Content Layout', 'struktur-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'font_size',
            [
                'label' => esc_html__("Font Size", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'title_text_transform',
            [
                'label' => esc_html__("Title Text Transform", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_text_transform_array(true)
            ]
        );

        $this->add_control(
            'skin',
            [
                'label' => esc_html__("Title Skin", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'struktur-core'),
                    'light-skin' => esc_html__('Light', 'struktur-core')
                ],
                'default' => ''
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $params = $this->get_settings_for_display();

        $args = array(
            'number_of_items' => '-1',
            'category' => '',
            'selected_projects' => '',
            'tag' => '',
            'order_by' => 'date',
            'order' => 'ASC',
            'font_size' => '',
            'title_text_transform' => '',
            'skin' => ''
        );
        $params = shortcode_atts($args, $params);

        $additional_params = array();

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $additional_params['query_results'] = $query_results;

        $additional_params['holder_data'] = $this->getHolderData($params, $additional_params);
        $additional_params['holder_classes'] = $this->getHolderClasses($params);

        $params['this_object'] = $this;
        $params['title_styles'] = $this->getTitleStyles($params);

        echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-link-list', 'portfolio-link-list', '', $params, $additional_params);
    }

    public function getQueryArray($params)
    {
        $query_array = array(
            'post_status' => 'publish',
            'post_type' => 'portfolio-item',
            'posts_per_page' => $params['number_of_items'],
            'orderby' => $params['order_by'],
            'order' => $params['order']
        );

        if (!empty($params['category'])) {
            $query_array['portfolio-category'] = $params['category'];
        }

        $project_ids = null;
        if (!empty($params['selected_projects'])) {
            $project_ids = explode(',', $params['selected_projects']);
            $query_array['post__in'] = $project_ids;
        }

        if (!empty($params['tag'])) {
            $query_array['portfolio-tag'] = $params['tag'];
        }

        if (!empty($params['next_page'])) {
            $query_array['paged'] = $params['next_page'];
        } else {
            $query_array['paged'] = 1;
        }

        return $query_array;
    }

    /**
     * Generates data attributes array
     *
     * @param $params
     * @param $additional_params
     *
     * @return string
     */
    public function getHolderData($params, $additional_params)
    {
        $dataString = '';

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $query_results = $additional_params['query_results'];
        $params['max_num_pages'] = $query_results->max_num_pages;

        if (!empty($paged)) {
            $params['next_page'] = $paged + 1;
        }

        foreach ($params as $key => $value) {
            if ($value !== '') {
                $new_key = str_replace('_', '-', $key);

                $dataString .= ' data-' . $new_key . '=' . esc_attr($value);
            }
        }

        return $dataString;
    }

    /**
     * Generates portfolio holder classes
     *
     * @param $params
     *
     * @return string
     */
    public function getHolderClasses($params)
    {
        $classes = array();

        if (!empty($params['skin'])) {
            $classes[] = $params['skin'];
        }

        return implode(' ', $classes);
    }

    /**
     * Generates portfolio article classes
     *
     * @param $params
     *
     * @return string
     */
    public function getArticleClasses($params)
    {
        $classes = array();

        $type = $params['type'];
        $item_style = $params['item_style'];

        if (get_post_meta(get_the_ID(), "qodef_portfolio_featured_image_meta", true) !== "" && $item_style === 'standard-switch-images') {
            $classes[] = 'qodef-pl-has-switch-image';
        } elseif (get_post_meta(get_the_ID(), "qodef_portfolio_featured_image_meta", true) === "" && $item_style === 'standard-switch-images') {
            $classes[] = 'qodef-pl-no-switch-image';
        }

        $image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
        $masonry_size = get_post_meta(get_the_ID(), 'qodef_portfolio_masonry_' . $image_proportion . '_dimensions_meta', true);

        $classes[] = !empty($masonry_size) && $type === 'masonry' ? 'qodef-pl-masonry-' . esc_attr($masonry_size) : '';

        $article_classes = get_post_class($classes);

        return implode(' ', $article_classes);
    }

    /**
     * Returns array of title element styles
     *
     * @param $params
     *
     * @return array
     */
    public function getTitleStyles($params)
    {
        $styles = array();

        if (!empty($params['title_text_transform'])) {
            $styles[] = 'text-transform: ' . $params['title_text_transform'];
        }

        if (!empty($params['font_size'])) {
            $styles[] = 'font-size: ' . struktur_select_filter_px($params['font_size']) . 'px';
        }

        return implode(';', $styles);
    }

    /**
     * Returns link url for items
     *
     * @return string
     */
    public function getItemLink()
    {
        $portfolio_link_meta = get_post_meta(get_the_ID(), 'portfolio_external_link', true);

        $portfolio_link = !empty($portfolio_link_meta) ? $portfolio_link_meta : get_permalink(get_the_ID());

        return $portfolio_link;
    }

    /**
     * Returns link target for items
     *
     * @return string
     */
    public function getItemLinkTarget()
    {
        $portfolio_link_meta = get_post_meta(get_the_ID(), 'portfolio_external_link', true);

        $portfolio_link_target = !empty($portfolio_link_meta) ? '_blank' : '_self';

        return $portfolio_link_target;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorElementorPortfolioLinkList() );