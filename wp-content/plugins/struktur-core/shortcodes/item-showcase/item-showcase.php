<?php
namespace StrukturCore\CPT\Shortcodes\ItemShowcase;

use StrukturCore\Lib;

class ItemShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_item_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Item Showcase', 'struktur-core' ),
					'base'      => $this->base,
					'category'  => esc_html__( 'by STRUKTUR', 'struktur-core' ),
					'icon'      => 'icon-wpb-item-showcase extended-custom-icon',
					'as_parent' => array( 'only' => 'qodef_item_showcase_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'       => 'attach_image',
							'param_name' => 'item_image',
							'heading'    => esc_html__( 'Image', 'struktur-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_top_offset',
							'heading'     => esc_html__( 'Image Top Offset', 'struktur-core' ),
							'value'       => '-100px',
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'item_image'       => '',
			'image_top_offset' => '',
		);
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$item_image_style = '';
		if ( ! empty( $image_top_offset ) ) {
			$item_image_style = 'margin-top: ' . struktur_select_filter_px( $image_top_offset ) . 'px';
		}
		
		$html = '<div class="qodef-item-showcase-holder clearfix">';
			$html .= do_shortcode( $content );
			if ( ! empty( $item_image ) ) {
				$html .= '<div class="qodef-is-image" ' . struktur_select_get_inline_style( $item_image_style ) . '>';
					$html .= wp_get_attachment_image( $item_image, 'full' );
				$html .= '</div>';
			}
		$html .= '</div>';
		
		return $html;
	}
}