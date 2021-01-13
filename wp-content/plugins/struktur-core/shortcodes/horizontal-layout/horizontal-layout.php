<?php

namespace StrukturCore\CPT\Shortcodes\HorizontalLayout;

use StrukturCore\Lib;

class HorizontalLayout implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'qodef_horizontal_layout';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */
    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Horizontal Layout', 'struktur-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__('by STRUKTUR', 'struktur-core'),
                    'icon'                      => 'icon-wpb-horizontal-layout extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type' => 'param_group',
                            'heading' => esc_html__('Items', 'struktur-core'),
                            'param_name' => 'items',
                            'params' => array(
                                array(
                                    'type'       => 'dropdown',
                                    'param_name' => 'media_type',
                                    'heading'    => esc_html__('Media Type', 'struktur-core'),
                                    'value'      => array(
                                        esc_html__('Image', 'struktur-core') => 'image',
                                        esc_html__('Video', 'struktur-core') => 'video'
                                    ),
                                    'admin_label' => true,
                                    'save_always' => true,
                                ),
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'image',
                                    'heading'     => esc_html__('Image', 'struktur-core'),
                                    'dependency'     => array('element' => 'media_type', 'value' => 'image')
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'video_url',
                                    'heading'    => esc_html__('Video Url', 'tonda-core'),
                                    'dependency'     => array('element' => 'media_type', 'value' => 'video')
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'number',
                                    'heading'     => esc_html__('Intro Label', 'struktur-core'),
                                    'admin_label' => true,
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'title',
                                    'heading'     => esc_html__('Title', 'struktur-core'),
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'text',
                                    'heading'     => esc_html__('Text', 'struktur-core'),
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'link',
                                    'heading'     => esc_html__('Link', 'struktur-core'),
                                    'admin_label' => true,
                                ),
                                array(
                                    'type'       => 'dropdown',
                                    'param_name' => 'target',
                                    'heading'    => esc_html__('Link target', 'struktur-core'),
                                    'value'      => array_flip(struktur_select_get_link_target_array()),
                                    'dependency' => array('element' => 'link', 'not_empty' => true)
                                ),
                            )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'content_background_color',
                            'heading'    => esc_html__('Content Background Color', 'struktur-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'cta_title',
                            'heading'     => esc_html__('CTA Title', 'struktur-core'),
                            'group'     => esc_html__('Call To Action', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'cta_link',
                            'heading'     => esc_html__('CTA Link', 'struktur-core'),
                            'group'     => esc_html__('Call To Action', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'cta_link_text',
                            'heading'     => esc_html__('CTA Link Text', 'struktur-core'),
                            'dependency' => array('element' => 'cta_link', 'not_empty' => true),
                            'group'     => esc_html__('Call To Action', 'edge-core')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'cta_link_target',
                            'heading'    => esc_html__('CTA Link target', 'struktur-core'),
                            'value'      => array_flip(struktur_select_get_link_target_array()),
                            'dependency' => array('element' => 'cta_link', 'not_empty' => true),
                            'group'     => esc_html__('Call To Action', 'edge-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'cta_widget_area',
                            'heading'     => esc_html__('CTA Widget Area', 'edge-core'),
                            'value'       => array_merge(
                                array(
                                    '' => ''
                                ),
                                array_flip(struktur_select_get_custom_sidebars())
                            ),
                            'group'     => esc_html__('Call To Action', 'edge-core')
                        )
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null)
    {
        $args = array(
            'items'             => '',
            'cta_title'         => '',
            'cta_link'          => '',
            'cta_link_text'     => '',
            'cta_link_target'   => '',
            'cta_widget_area'   => '',
            'content_background_color' => '#fff'
        );

        $params = shortcode_atts($args, $atts);
        $params['content'] = $content;
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);
        $params['items'] = json_decode(urldecode($params['items']), true);

        $html = struktur_core_get_shortcode_module_template_part('templates/horizontal-layout-template', 'horizontal-layout', '', $params);

        return $html;
    }

    private function svgPatternStyle($params)
    {
        $itemStyle = array();

        $svg = struktur_select_get_svg('inverted-pattern', $params['content_background_color']);
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode($svg) . "')";

        return implode(';', $itemStyle);
    }
}
