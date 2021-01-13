<?php
namespace StrukturCore\CPT\Shortcodes\VerticalShowcase;

use StrukturCore\Lib;

class VerticalShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_vertical_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

	}

	protected function setParams() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = esc_html__( 'No contact forms found', 'struktur' );
		}

		$formatted_cf_array = array();
		
		if ( is_array( $contact_forms ) && count( $contact_forms ) ) {
			foreach ( $contact_forms as $key=>$value ) {
				$formatted_cf_array[ $value ] = $key;
			}
		}


		return $formatted_cf_array;


	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Vertical Showcase', 'struktur-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by STRUKTUR', 'struktur-core' ),
					'icon'     => 'icon-wpb-vertical-showcase extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'param_group',
							'param_name' => 'link_items',
							'heading'    => esc_html__( 'Link Items', 'struktur-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'title_after_number',
									'heading'    => esc_html__( 'Title after Number', 'struktur-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'slide_text',
									'heading'    => esc_html__( 'Slide Text', 'struktur-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'title',
									'heading'    => esc_html__( 'Slide Title', 'struktur-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'subtitle',
									'heading'    => esc_html__( 'Slide Subtitle', 'struktur-core' ),
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'struktur-core' ),
									'description' => esc_html__( 'Select image from media library', 'struktur-core' )
								)
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'contact_form_title',
							'heading'    => esc_html__( 'Contact Form Title', 'struktur-core' ),
							'group'     => esc_html__( 'Last Slide', 'struktur-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'contact_form_subtitle',
							'heading'    => esc_html__( 'Contact Form Subtitle', 'struktur-core' ),
							'group'     => esc_html__( 'Last Slide', 'struktur-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'contact_form',
							'heading'     => esc_html__( 'Select Contact Form 7', 'struktur' ),
							'value'       => $this->setParams(),
							'save_always' => true,
							'group'     => esc_html__( 'Last Slide', 'struktur-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'dotted_text',
							'heading'     => esc_html__( 'Dotted Text', 'struktur-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_phone_frame',
							'heading'     => esc_html__( 'Enable Phone Frame', 'struktur-core' ),
							'value'       => array_flip( struktur_select_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_app_store_link',
							'heading'     => esc_html__( 'Enable App Store Link', 'struktur-core' ),
							'value'       => array_flip( struktur_select_get_yes_no_select_array( false ) ),
							'save_always' => true,
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'app_store_link',
							'heading'     => esc_html__( 'Link Address', 'struktur-core' ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_app_store_link', 'value' => array( 'yes' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_play_store_link',
							'heading'     => esc_html__( 'Enable Google Play Store Link', 'struktur-core' ),
							'value'       => array_flip( struktur_select_get_yes_no_select_array( false ) ),
							'save_always' => true,
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'play_store_link',
							'heading'     => esc_html__( 'Link Address', 'struktur-core' ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_play_store_link', 'value' => array( 'yes' ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'link_items'       		 => '',
			'contact_form'		     => '',
			'contact_form_title'	 => '',
			'contact_form_subtitle'	 => '',
			'widget_area'			 => '',
			'dotted_text'	         => '',
			'enable_phone_frame'	 => 'yes',
			'enable_app_store_link'  => 'no',
			'app_store_link' 		 => '#',
			'enable_play_store_link' => 'no',
			'play_store_link'		 => '#'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['svg_pattern_style_left'] = $this->svgPatternStyleLeft($params);
		$params['svg_pattern_style_right'] = $this->svgPatternStyleRight($params);
		$params['link_items']          = json_decode( urldecode( $params['link_items'] ), true );
		
		$html = struktur_core_get_shortcode_module_template_part( 'templates/vertical-showcase', 'vertical-showcase', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();

		$holderClasses[] = $params['enable_phone_frame'] == "no" ? 'qodef-vs-no-frame' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function svgPatternStyleLeft( $params ) {
		$itemStyle = array();
		
		$svg = struktur_select_get_svg( 'inverted-pattern', '#fa5151');
		$itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";
		
		return implode( ';', $itemStyle );
	}
	
	private function svgPatternStyleRight( $params ) {
		$itemStyle = array();
		
		$svg = struktur_select_get_svg( 'inverted-pattern', '#e73d3d');
		$itemStyle[] = "background-image: url('data:image/svg+xml;base64," . base64_encode( $svg ) . "')";
		
		return implode( ';', $itemStyle );
	}

}