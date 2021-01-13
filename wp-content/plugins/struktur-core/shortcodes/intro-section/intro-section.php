<?php

namespace StrukturCore\CPT\Shortcodes\IntroSection;

use StrukturCore\Lib;

class IntroSection implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'qodef_intro_section';

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
                    'name'                      => esc_html__('Intro Section', 'struktur-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__('by STRUKTUR', 'struktur-core'),
                    'icon'                      => 'icon-wpb-intro-section extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'loading_title',
                            'heading'     => esc_html__('Title', 'struktur-core'),
                            'group'     => esc_html__('Loading Screen', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'loading_subtitle',
                            'heading'     => esc_html__('Subtitle', 'struktur-core'),
                            'group'     => esc_html__('Loading Screen', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'loading_tagline',
                            'heading'     => esc_html__('Tagline', 'struktur-core'),
                            'group'     => esc_html__('Loading Screen', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'first_title',
                            'heading'     => esc_html__('First Title', 'struktur-core'),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
							'type'        => 'textfield',
							'param_name'  => 'first_title_emphasize_words',
							'heading'     => esc_html__('Emphasize Words', 'struktur-core'),
							'description' => esc_html__('Enter the positions of the words you would like to Emphasize. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to be emphasized, you would enter "1,3,4")', 'struktur-core'),
							'dependency'  => array('element' => 'first_title', 'not_empty' => true),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
							'type'        => 'textfield',
							'param_name'  => 'first_title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'struktur-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'struktur-core' ),
							'dependency'  => array( 'element' => 'first_title', 'not_empty' => true ),
							'group'       => esc_html__( 'Main Screen', 'struktur-core' )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'second_title',
                            'heading'     => esc_html__('Second Title', 'struktur-core'),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
							'type'        => 'textfield',
							'param_name'  => 'second_title_emphasize_words',
							'heading'     => esc_html__('Emphasize Words', 'struktur-core'),
							'description' => esc_html__('Enter the positions of the words you would like to Emphasize. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to be emphasized, you would enter "1,3,4")', 'struktur-core'),
							'dependency'  => array('element' => 'second_title', 'not_empty' => true),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
							'type'        => 'textfield',
							'param_name'  => 'second_title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'struktur-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'struktur-core' ),
							'dependency'  => array( 'element' => 'second_title', 'not_empty' => true ),
							'group'       => esc_html__( 'Main Screen', 'struktur-core' )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'video_url',
                            'heading'    => esc_html__('Video Url', 'tonda-core'),
                            'dependency'     => array('element' => 'media_type', 'value' => 'video'),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'link',
                            'heading'     => esc_html__('Link', 'struktur-core'),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'link_text',
                            'heading'     => esc_html__('Link Text', 'struktur-core'),
                            'dependency' => array('element' => 'link', 'not_empty' => true),
                            'group'     => esc_html__('Main Screen', 'edge-core')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'link_target',
                            'heading'    => esc_html__('Link target', 'struktur-core'),
                            'value'      => array_flip(struktur_select_get_link_target_array()),
                            'dependency' => array('element' => 'link', 'not_empty' => true),
                            'group'     => esc_html__('Main Screen', 'edge-core')
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
            'loading_title'     => '',
            'loading_subtitle'  => '',
            'loading_tagline'   => '',
            'first_title'       => '',
            'first_title_emphasize_words'  => '',
            'first_title_break_words'  => '',
            'second_title'      => '',
            'second_title_emphasize_words'  => '',
            'second_title_break_words'  => '',
            'video_url'         => '',
            'link'              => '',
            'link_text'         => '',
            'link_target'       => '',
        );

        $params = shortcode_atts($args, $atts);
        $params['content'] = $content;
		$params['first_title'] = $this->getModifiedTitle( $params['first_title'], $params['first_title_emphasize_words'], $params['first_title_break_words'] );
		$params['second_title'] = $this->getModifiedTitle( $params['second_title'], $params['second_title_emphasize_words'], $params['second_title_break_words'] );
        $params['svg_pattern_style'] = $this->svgPatternStyle($params);

        $html = struktur_core_get_shortcode_module_template_part('templates/intro-section-template', 'intro-section', '', $params);

        return $html;
    }

    private function getModifiedTitle( $title, $emphasize_words, $break_words  ) {
		$title_emphasize_words = str_replace(' ', '', $emphasize_words);
		$title_break_words = str_replace( ' ', '', $break_words );
		
		if ( ! empty( $title ) ) {
			$emphasize_words = explode(',', $title_emphasize_words);
			$split_title = explode( ' ', $title );
			
			if (!empty($title_emphasize_words)) {
				foreach ($emphasize_words as $value) {
					if (!empty($split_title[$value - 1])) {
						$split_title[$value - 1] = '<span class="qodef-st-title-emphasize"><span>' . $split_title[$value - 1] . '</span></span>';
					}
				}
			}
			
			if ( ! empty( $title_break_words ) ) {
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}

    private function svgPatternStyle($params) {
        $itemStyle = array();

        $svg = struktur_select_get_svg('inverted-pattern', '#181818');
        $itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode($svg) . "')";

        return implode(';', $itemStyle);
    }
}
