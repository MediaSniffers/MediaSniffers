<?php
namespace StrukturCore\CPT\Shortcodes\CallToAction;

use StrukturCore\Lib;

class CallToAction implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_call_to_action';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Call To Action', 'struktur-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by STRUKTUR', 'struktur-core' ),
					'icon'                      => 'icon-wpb-call-to-action extended-custom-icon',
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
							'param_name'  => 'layout',
							'heading'     => esc_html__( 'Layout', 'struktur-core' ),
							'value'       => array(
								esc_html__( 'Normal', 'struktur-core' ) => 'normal',
								esc_html__( 'Simple', 'struktur-core' ) => 'simple'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'content_in_grid',
							'heading'    => esc_html__( 'Set Content In Grid', 'struktur-core' ),
							'value'      => array_flip( struktur_select_get_yes_no_select_array( false ) ),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'normal' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'content_elements_proportion',
							'heading'    => esc_html__( 'Content Elements Proportion', 'struktur-core' ),
							'value'      => array(
								esc_html__( '80/20', 'struktur-core' ) => '80',
								esc_html__( '75/25', 'struktur-core' ) => '75',
								esc_html__( '66/33', 'struktur-core' ) => '66',
								esc_html__( '50/50', 'struktur-core' ) => '50'
							),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'normal' ) )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background color', 'struktur-core' ),
							'dependency'  => array( 'element' => 'layout', 'value'   => array( 'simple' ) ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'struktur-core' ),
							'value'       => esc_html__( 'Button Text', 'struktur-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px)', 'struktur-core' ),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'simple' ) ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Button Type', 'struktur-core' ),
							'value'       => array(
								esc_html__( 'Solid', 'struktur-core' )   => 'solid',
								esc_html__( 'Outline', 'struktur-core' ) => 'outline',
								esc_html__( 'Simple', 'struktur-core' )  => 'simple'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_size',
							'heading'     => esc_html__( 'Button Size', 'struktur-core' ),
							'value'       => array(
								esc_html__( 'Default', 'struktur-core' ) => '',
								esc_html__( 'Small', 'struktur-core' )   => 'small',
								esc_html__( 'Medium', 'struktur-core' )  => 'medium',
								esc_html__( 'Large', 'struktur-core' )   => 'large'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_type', 'value'   => array( 'solid', 'outline' ) ),
							'group'       => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'struktur-core' ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_target',
							'heading'    => esc_html__( 'Button Link Target', 'struktur-core' ),
							'value'      => array_flip( struktur_select_get_link_target_array() ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_color',
							'heading'    => esc_html__( 'Button Color', 'struktur-core' ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_color',
							'heading'    => esc_html__( 'Button Hover Color', 'struktur-core' ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_background_color',
							'heading'    => esc_html__( 'Button Background Color', 'struktur-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_background_color',
							'heading'    => esc_html__( 'Button Hover Background Color', 'struktur-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_border_color',
							'heading'    => esc_html__( 'Button Border Color', 'struktur-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' , 'outline' ) ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_border_color',
							'heading'    => esc_html__( 'Button Hover Border Color', 'struktur-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' , 'outline' ) ),
							'group'      => esc_html__( 'Button Style', 'struktur-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'struktur-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'content_font_size',
							'heading'    => esc_html__( 'Content Font Size (px)', 'booth-core' ),
							'dependency' => array( 'element' => 'content', 'not_empty' => true )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                  => '',
			'layout'                        => 'normal',
			'content_in_grid'               => 'no',
			'content_elements_proportion'   => '75',
			'content_font_size'             => '',
			'background_color'              => '',
			'button_text'                   => '',
			'button_top_margin'             => '',
			'button_type'                   => 'solid',
			'button_size'                   => 'medium',
			'button_link'                   => '',
			'button_target'                 => '_self',
			'button_color'                  => '',
			'button_hover_color'            => '',
			'button_background_color'       => '',
			'button_hover_background_color' => '',
			'button_border_color'           => '',
			'button_hover_border_color'     => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content'] = $this->wrapWord($content );
		
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['inner_classes']        = $this->getInnerClasses( $params );
		$params['button_holder_styles'] = $this->getButtonHolderStyles( $params );
		$params['button_parameters']    = $this->getButtonParameters( $params );
		$params['svg_pattern_style']    = $this->svgPatternStyle($params);
		$params['holder_background_color'] = !empty($params['background_color']) && $params['layout'] === 'simple' ? 'background-color:'.$params['background_color'] : '';
		
		$html = struktur_core_get_shortcode_module_template_part( 'templates/call-to-action', 'call-to-action', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['layout'] ) ? 'qodef-' . $params['layout'] . '-layout' : '';
		$holderClasses[] = $params['content_in_grid'] === 'yes' && $params['layout'] === 'normal' ? 'qodef-content-in-grid' : '';
		
		$content_elements_proportion = $params['content_elements_proportion'];
		if ( $params['layout'] === 'normal' ) {
			switch ( $content_elements_proportion ):
				case '80':
					$holderClasses[] = 'qodef-four-fifths-columns';
					break;
				case '75':
					$holderClasses[] = 'qodef-three-quarters-columns';
					break;
				case '66':
					$holderClasses[] = 'qodef-two-thirds-columns';
					break;
				case '50':
					$holderClasses[] = 'qodef-two-halves-columns';
					break;
				default:
					$holderClasses[] = 'qodef-three-quarters-columns';
					break;
			endswitch;
		}
		
		return implode( ' ', $holderClasses );
	}
	
	private function getInnerClasses( $params ) {
		$innerClasses = array();
		
		$innerClasses[] = $params['layout'] === 'normal' && $params['content_in_grid'] === 'yes' ? 'qodef-grid' : '';
		
		return implode( ' ', $innerClasses );
	}
	
	private function getButtonHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['button_top_margin'] ) && $params['layout'] === 'simple' ) {
			$styles[] = 'margin-top: ' . struktur_select_filter_px( $params['button_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonParameters( $params ) {
		$button_params_array = array();
		
		if ( ! empty( $params['button_text'] ) ) {
			$button_params_array['text'] = $params['button_text'];
		}
		
		if ( ! empty( $params['button_type'] ) ) {
			$button_params_array['type'] = $params['button_type'];
		}
		
		if ( ! empty( $params['button_size'] ) ) {
			$button_params_array['size'] = $params['button_size'];
		}
		
		if ( ! empty( $params['button_link'] ) ) {
			$button_params_array['link'] = $params['button_link'];
		}
		
		$button_params_array['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';
		
		if ( ! empty( $params['button_color'] ) ) {
			$button_params_array['color'] = $params['button_color'];
		}
		
		if ( ! empty( $params['button_hover_color'] ) ) {
			$button_params_array['hover_color'] = $params['button_hover_color'];
		}
		
		if ( ! empty( $params['button_background_color'] ) ) {
			$button_params_array['background_color'] = $params['button_background_color'];
		}
		
		if ( ! empty( $params['button_hover_background_color'] ) ) {
			$button_params_array['hover_background_color'] = $params['button_hover_background_color'];
		}
		
		if ( ! empty( $params['button_border_color'] ) ) {
			$button_params_array['border_color'] = $params['button_border_color'];
		}
		
		if ( ! empty( $params['button_hover_border_color'] ) ) {
			$button_params_array['hover_border_color'] = $params['button_hover_border_color'];
		}
		
		return $button_params_array;
	}
	
	private function svgPatternStyle( $params ) {
		$itemStyle = array();
		
		$svg = struktur_select_get_svg( 'inverted-pattern', $params['background_color']);
		$itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";
		
		return implode( ';', $itemStyle );
	}

	private function wrapInSpan($str) {
		$re = "/([^\\s>])(?!(?:[^<>]*)?>)/u";
		$subst = "<span class='qodef-char' aria-hidden='true'>$1</span>";
		$result = preg_replace($re, $subst, $str);
		return $result;
	}

	private function wrapWord($str) {
		$words = preg_split('/\s+/', $str);
		$res = '';
		foreach ($words as $word) {
			$res .= '<span class="qodef-word">';
			$res .= $this->wrapInSpan($word);
			$res .= ' </span>';
		}
		return $res;
	}
}