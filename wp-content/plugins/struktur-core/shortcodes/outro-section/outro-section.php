<?php

namespace StrukturCore\CPT\Shortcodes\OutroSection;

use StrukturCore\Lib;

class OutroSection implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'qodef_outro_section';

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
                    'name'                      => esc_html__('Outro Section', 'struktur-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__('by STRUKTUR', 'struktur-core'),
                    'icon'                      => 'icon-wpb-outro-section extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title',
                            'heading'     => esc_html__('Title', 'struktur-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'subtitle',
                            'heading'     => esc_html__('Subtitle', 'struktur-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'tagline',
                            'heading'     => esc_html__('Tagline', 'struktur-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'link',
                            'heading'     => esc_html__('Link', 'struktur-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'link_text',
                            'heading'     => esc_html__('Link Text', 'struktur-core'),
                            'dependency' => array('element' => 'link', 'not_empty' => true),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'link_target',
                            'heading'    => esc_html__('Link target', 'struktur-core'),
                            'value'      => array_flip(struktur_select_get_link_target_array()),
                            'dependency' => array('element' => 'link', 'not_empty' => true),
                        ),
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
            'title'     => '',
            'subtitle'  => '',
            'tagline'   => '',
            'link'              => '',
            'link_text'         => '',
            'link_target'       => '',
        );

        $params = shortcode_atts($args, $atts);
        $params['content'] = $content;
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);

        $html = struktur_core_get_shortcode_module_template_part('templates/outro-section-template', 'outro-section', '', $params);

        return $html;
    }

    private function svgPatternStyle($params) {
        $itemStyle = array();

        $svg = struktur_select_get_svg('inverted-pattern', '#181818');
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode($svg) . "')";

        return implode(';', $itemStyle);
    }
}
