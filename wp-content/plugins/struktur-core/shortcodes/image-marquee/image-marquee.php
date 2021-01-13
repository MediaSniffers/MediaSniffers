<?php
namespace StrukturCore\CPT\Shortcodes\imageMarquee;

use StrukturCore\Lib;

class imageMarquee implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_image_marquee';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image Marquee', 'struktur-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by STRUKTUR', 'struktur-core' ),
					'icon'                      => 'icon-wpb-image-marquee extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
							array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'struktur-core' ),
							'description' => esc_html__( 'Select image from media library', 'struktur-core' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image' => '',
		);
		
		$params = shortcode_atts( $args, $atts );
		$html = struktur_core_get_shortcode_module_template_part( 'templates/image-marquee-template', 'image-marquee', '', $params );
		
		return $html;
	}
}