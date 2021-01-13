<?php

class StrukturCoreElementorPortfolioProjectInfo extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'qodef_portfolio_project_info';
    }

    public function get_title()
    {
        return esc_html__("Portfolio Project Info", 'struktur-core');
    }

    public function get_icon()
    {
        return 'struktur-elementor-custom-icon struktur-elementor-portfolio-project-info';
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
            'project_id',
            [
                'label' => esc_html__("Selected Project", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'struktur-core' )
            ]
        );

        $this->add_control(
            'project_info_type',
            [
                'label' => esc_html__("Project Info Type", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'title'    => esc_html__('Title', 'struktur-core'),
                    'category' => esc_html__('Category', 'struktur-core'),
                    'tag'      => esc_html__('Tag', 'struktur-core'),
                    'author'   => esc_html__('Author', 'struktur-core'),
                    'date'     => esc_html__('Date', 'struktur-core'),
                    'image'    => esc_html__('Featured Image', 'struktur-core'),
                    'whole_project_info' => esc_html__('Whole Project Info', 'struktur-core'),
                ],
                'default' => 'title'
            ]
        );

        $this->add_control(
            'project_info_title_type_tag',
            [
                'label' => esc_html__("Project Title Tag", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'description' => esc_html__( 'Set title tag for project title element', 'struktur-core' ),
                'default' => 'h4',
                'condition' => [
                    'project_info_type' => array( 'title' )
                ]
            ]
        );

        $this->add_control(
            'project_info_title',
            [
                'label' => esc_html__("Project Info Label", 'struktur-core'),
                'description' => esc_html__( 'Add project info label before project info element/s', 'struktur-core' )
            ]
        );

        $this->add_control(
            'project_info_title_tag',
            [
                'label' => esc_html__("Project Info Label Tag", 'struktur-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => struktur_select_get_title_tag( true, array( 'p' => 'p' ) ),
                'default' => 'h4',
                'condition' => [
                    'project_info_title!' => ''
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'project_id'                  => '',
            'project_info_type'           => 'title',
            'project_info_title_type_tag' => 'h4',
            'project_info_title'          => '',
            'project_info_title_tag'      => 'h4'
        );
        $params = shortcode_atts( $args, $params );

        $project_info_type                     = ! empty( $params['project_info_type'] ) ? $params['project_info_type'] : $args['project_info_type'];
        $params['project_id']                  = ! empty( $params['project_id'] ) ? $params['project_id'] : get_the_ID();
        $params['project_info_title_type_tag'] = ! empty( $params['project_info_title_type_tag'] ) ? $params['project_info_title_type_tag'] : $args['project_info_title_type_tag'];
        $project_info_title_tag                = ! empty( $params['project_info_title_tag'] ) ? $params['project_info_title_tag'] : $args['project_info_title_tag'];

        $html = '<div class="qodef-portfolio-project-info ' . $this->getHolderClasses($params) . '">';

        if ( ! empty( $project_info_title ) ) {
            $html .= '<' . esc_attr( $project_info_title_tag ) . ' class="qodef-ppi-label">' . esc_html( $project_info_title ) . '</' . esc_attr( $project_info_title_tag ) . '>';
        }

        switch ( $project_info_type ) {
            case 'title':
                $html .= $this->getItemTitleHtml( $params );
                break;
            case 'category':
                $html .= $this->getItemCategoryHtml( $params );
                break;
            case 'tag':
                $html .= $this->getItemTagHtml( $params );
                break;
            case 'author':
                $html .= $this->getItemAuthorHtml( $params );
                break;
            case 'date':
                $html .= $this->getItemDateHtml( $params );
                break;
            case 'image':
                $html .= $this->getItemImageHtml( $params );
                break;
            case 'whole_project_info':
                $html .= $this->getWholeItemInfo( $params );
                break;
            default:
                $html .= $this->getItemTitleHtml( $params );
                break;
        }

        $html .= '</div>';

        echo struktur_select_get_module_part($html);
    }

    private function getHolderClasses( $params ) {
        $holderClasses = '';

        if($params['project_info_type'] === 'whole_project_info') {
            $holderClasses = 'qodef-ppi-whole-info-holder';
        } elseif ($params['project_info_type'] === 'tag') {
            $holderClasses = 'qodef-ppi-tag-holder';
        }

        return $holderClasses;
    }

    public function getItemTitleHtml( $params ) {
        $html       = '';
        $project_id = $params['project_id'];
        $title      = get_the_title( $project_id );
        $title_tag  = $params['project_info_title_type_tag'];

        if ( ! empty( $title ) ) {
            $html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="qodef-ppi-title entry-title">';
            $html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . esc_html( $title ) . '</a>';
            $html .= '</' . esc_attr( $title_tag ) . '>';
        }

        return $html;
    }

    public function getItemCategoryHtml( $params ) {
        $html       = '';
        $project_id = $params['project_id'];
        $categories = wp_get_post_terms( $project_id, 'portfolio-category' );

        if ( ! empty( $categories ) ) {
            $html = '<div class="qodef-ppi-category">';
            foreach ( $categories as $cat ) {
                $html .= '<a itemprop="url" class="qodef-ppi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
            }
            $html .= '</div>';
        }

        return $html;
    }

    public function getItemTagHtml( $params ) {
        $html       = '';
        $project_id = $params['project_id'];
        $tags       = wp_get_post_terms( $project_id, 'portfolio-tag' );

        if ( ! empty( $tags ) ) {
            $html = '<div class="qodef-ppi-tag">';
            foreach ( $tags as $tag ) {
                $html .= '<a itemprop="url" class="qodef-ppi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
            }
            $html .= '</div>';
        }

        return $html;
    }

    public function getItemAuthorHtml( $params ) {
        $html         = '';
        $project_id   = $params['project_id'];
        $project_post = get_post( $project_id );
        $autor_id     = $project_post->post_author;
        $author       = get_the_author_meta( 'display_name', $autor_id );

        if ( ! empty( $author ) ) {
            $html = '<div class="qodef-ppi-author">' . esc_html( $author ) . '</div>';
        }

        return $html;
    }

    public function getItemDateHtml( $params ) {
        $html       = '';
        $project_id = $params['project_id'];
        $date       = get_the_time( get_option( 'date_format' ), $project_id );

        if ( ! empty( $date ) ) {
            $html = '<div class="qodef-ppi-date">' . esc_html( $date ) . '</div>';
        }

        return $html;
    }

    public function getItemImageHtml( $params ) {
        $html       = '';
        $project_id = $params['project_id'];
        $image      = get_the_post_thumbnail( $project_id, 'full' );

        if ( ! empty( $image ) ) {
            $html = '<a itemprop="url" class="qodef-ppi-image" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . $image . '</a>';
        }

        return $html;
    }

    public function getWholeItemInfo( $params ) {
        $html       = '';

        $html = struktur_core_get_cpt_shortcode_module_template_part('portfolio','portfolio-project-info', 'custom-fields', '', $params);
        $html .= struktur_core_get_cpt_shortcode_module_template_part('portfolio','portfolio-project-info', 'date', '', $params);
        $html .= struktur_core_get_cpt_shortcode_module_template_part('portfolio','portfolio-project-info', 'share', '', $params);

        return $html;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorPortfolioProjectInfo() );