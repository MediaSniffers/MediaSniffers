<?php

if( defined('WPCF7_VERSION') ){
    class StrukturCoreElementorContactForm7 extends \Elementor\Widget_Base {
        public function get_name() {
            return 'qodef_cf7';
        }

        public function get_title() {
            return esc_html__( 'Contact Form 7', 'struktur-core' );
        }

        public function get_icon() {
            return 'struktur-elementor-custom-icon struktur-elementor-contact-form-7';
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
                'cf7',
                [
                    'label'       => esc_html__( 'Select Contact Form', 'void' ),
                    'description' => esc_html__( 'You need to install and activate Contact Form 7 plugin', 'struktur-core' ),
                    'type'        => \Elementor\Controls_Manager::SELECT2,
                    'multiple'    => false,
                    'label_block' => 1,
                    'options'     => $this->get_contact_form_7_posts(),
                ]
            );

            $this->add_control(
                'html_class',
                [
                    'label'       => esc_html__( 'Select Contact Form Style', 'void' ),
                    'description' => esc_html__( 'Contact form 7 - plugin must be installed and there must be some contact forms made with the contact form 7', 'void' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'options'     => [
                        'default'            => esc_html__( 'Default', 'struktur-core' ),
                        'cf7_custom_style_1' => esc_html__( 'Custom Style 1', 'struktur-core' ),
                        'cf7_custom_style_2' => esc_html__( 'Custom Style 2', 'struktur-core' ),
                        'cf7_custom_style_3' => esc_html__( 'Custom Style 3', 'struktur-core' ),
                    ],
                ]
            );

            $this->end_controls_section();

        }

        protected function render() {
            $params = $this->get_settings_for_display();

            echo struktur_core_get_shortcode_module_template_part('templates/contact-form-7', 'contact-form-7', '', $params);
        }

        protected function get_contact_form_7_posts() {
            $args = array(
                'post_type'      => 'wpcf7_contact_form',
                'posts_per_page' => -1
            );

            $category_list = [];

            if ($categories = get_posts($args)) {
                foreach ($categories as $category) {
                    (int)$category_list[$category->ID] = $category->post_title;
                }
            } else {
                (int)$category_list['0'] = esc_html__('No content from Contact Form 7 found', 'void');
            }
            return $category_list;
        }
    }

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorContactForm7() );
}