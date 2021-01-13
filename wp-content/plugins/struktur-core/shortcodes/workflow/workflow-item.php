<?php

namespace StrukturCore\CPT\Shortcodes\WorkflowItem;

use StrukturCore\Lib;

class WorkflowItem implements  Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'qodef_workflow_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    "name"                      => esc_html__('Workflow Item', 'struktur-core'),
                    "base"                      => $this->base,
                    "as_child"                  => array('only' => 'qodef_workflow'),
                    "category"                  => esc_html__( 'by STRUKTUR', 'struktur-core' ),
                    "icon"                      => "icon-wpb-workflow-item extended-custom-icon",
                    "show_settings_on_create"   => true,
                    'params'                    => array_merge(
                        array(
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Title', 'struktur-core'),
                                'param_name' => 'title',
                                'admin_label' => true,
                                'description' => esc_html__('Enter workflow item title.', 'struktur-core')
                            ),
                            array(
                                'type' => 'textarea',
                                'heading' => esc_html__('Text', 'struktur-core'),
                                'param_name' => 'text',
                                'description' => esc_html__('Enter workflow item text.', 'struktur-core')
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => esc_html__('Image', 'struktur-core'),
                                'param_name' => 'image',
                                'description' => esc_html__('Insert workflow item image.', 'struktur-core')
                            ),
                            array(
                                'type' => 'colorpicker',
                                'heading' => esc_html__('Circle border color', 'struktur-core'),
                                'param_name' => 'circle_border_color',
                                'description' => esc_html__('Pick a color for the circle border color.', 'struktur-core')
                            ),
                            array(
                                'type' => 'colorpicker',
                                'heading' => esc_html__('Circle background color', 'struktur-core'),
                                'param_name' => 'circle_background_color',
                                'description' => esc_html__('Pick a color for the circle background color.', 'struktur-core')
                            ),
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'title'                   => '',
            'text'                    => '',
            'image'                   => '',
            'circle_border_color'     => '',
            'circle_background_color' => '',
        ));

        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $output = '';
        $output .= struktur_core_get_shortcode_module_template_part('templates/workflow-item-template', 'workflow', '', $params);

        return $output;
    }

    private function getStyleProperties($params) {

        $style                            = array();
        $style['circle_border_color']     = '';
        $style['circle_background_color'] = '';
        $style['line_color']              = '';

        if($params['circle_border_color'] !== '') {
            $style['circle_border_color'] = 'border-color:'.$params['circle_border_color'].';';
        }
        if($params['circle_background_color'] !== '') {
            $style['circle_background_color'] = 'background-color:'.$params['circle_background_color'].';';
        }

        return $style;
    }
}
