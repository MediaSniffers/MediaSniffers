<?php
namespace StrukturCore\CPT\Shortcodes\TextWithNumber;

use StrukturCore\Lib;

class TextWithNumber implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_text_with_number';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Text With Number', 'struktur-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by STRUKTUR', 'struktur-core' ),
					'icon'                      => 'icon-wpb-text-with-number extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'struktur-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'struktur-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'struktur-core' ),
							'value'       => array(
								esc_html__( 'Number Above Text', 'struktur-core' )  => 'number_above_text',
								esc_html__( 'With Separators', 'struktur-core' )    => 'with_separators',
							)
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'struktur-core' ),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'type', 'value' => 'number_above_text' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number',
							'heading'     => esc_html__( 'Number', 'struktur-core' ),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'type', 'value' => 'number_above_text' )
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'text',
							'heading'     => esc_html__( 'Text', 'struktur-core' ),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'type', 'value' => 'number_above_text' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'struktur-core' ),
							'value'       => array(
								esc_html__( 'Three', 'struktur-core' ) => '3',
								esc_html__( 'Four', 'struktur-core' )  => '4',
							),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'struktur-core' ),
							'value'       => array_flip( struktur_select_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_font_size',
							'heading'    => esc_html__( 'Number Font Size (px)', 'booth-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'struktur-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_one',
							'heading'     => esc_html__( 'Title 1', 'struktur-core' ),
							'admin_label' => true,
							'group'       => esc_html__( 'Items', 'struktur-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_one',
							'heading'     => esc_html__( 'Number 1', 'struktur-core' ),
							'admin_label' => true,
							'group'       => esc_html__( 'Items', 'struktur-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_two',
							'heading'     => esc_html__( 'Title 2', 'struktur-core' ),
							'admin_label' => true,
							'group'       => esc_html__( 'Items', 'struktur-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_two',
							'heading'     => esc_html__( 'Number 2', 'struktur-core' ),
							'admin_label' => true,
							'group'       => esc_html__( 'Items', 'struktur-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_three',
							'heading'     => esc_html__( 'Title 3', 'struktur-core' ),
							'admin_label' => true,
							'group'       => esc_html__( 'Items', 'struktur-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_three',
							'heading'     => esc_html__( 'Number 3', 'struktur-core' ),
							'admin_label' => true,
							'group'       => esc_html__( 'Items', 'struktur-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => 'with_separators' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_four',
							'heading'     => esc_html__( 'Title 4', 'struktur-core' ),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'number_of_columns', 'value' => '4' ),
							'group'       => esc_html__( 'Items', 'struktur-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_four',
							'heading'     => esc_html__( 'Number 4', 'struktur-core' ),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'number_of_columns', 'value' => '4' ),
							'group'       => esc_html__( 'Items', 'struktur-core' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'type'                => 'number_above_text',
			'title'               => '',
			'number'              => '',
			'text'                => '',
			'number_of_columns'   => '3',
			'title_one'           => '',
			'title_two'           => '',
			'title_three'         => '',
			'title_four'          => '',
			'title_tag'           => 'h3',
			'number_font_size'    => '',
			'color'               => '',
			'background_color'    => '',
			'number_one'          => '',
			'number_two'          => '',
			'number_three'        => '',
			'number_four'         => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']      = $this->getTitleStyles( $params );
		$params['number_styles']     = $this->getNumberStyles( $params );
		$params['separator_styles']  = ! empty( $params['color'] ) ? 'background-color:'.$params['color'] : '';
		$params['svg_pattern_style'] = $this->svgPatternStyle($params);
		
		$params['items'] = array(
			 array(
				'title'  => $params['title_one'],
				'number' => $params['number_one']
			),
			 array(
				'title'  => $params['title_two'],
				'number' => $params['number_two']
			),
			array(
				'title'  => $params['title_three'],
				'number' => $params['number_three']
			),
			array(
				'title'  => $params['title_four'],
				'number' => $params['number_four']
			),
		);
		
		if($params['type'] === 'number_above_text') {
			$html = struktur_core_get_shortcode_module_template_part( 'templates/number-above-text', 'text-with-number', '', $params );
		} else {
			$html = struktur_core_get_shortcode_module_template_part( 'templates/with-separators', 'text-with-number', '', $params );
		}
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getNumberStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['number_font_size'] ) ) {
			$styles[] = 'font-size: ' . struktur_select_filter_px( $params['number_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function svgPatternStyle( $params ) {
		$itemStyle = array();
		
		$svg = struktur_select_get_svg( 'inverted-pattern', $params['background_color']);
		$itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";
		
		return implode( ';', $itemStyle );
	}
}