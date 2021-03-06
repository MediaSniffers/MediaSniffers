<?php

class StrukturCoreElementorImageMarquee extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'qodef_image_marquee';
	}
	
	public function get_title() {
		return esc_html__( 'Image Marquee', 'struktur-core' );
	}
	
	public function get_icon() {
		return 'struktur-elementor-custom-icon struktur-elementor-image-marquee';
	}
	
	public function get_categories() {
		return [ 'struktur' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'struktur-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'struktur-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'struktur-core' )
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'image' => '',
		);
		
		if ( ! empty( $params['image'] ) ) {
			$params['image'] = $params['image']['id'];
		}
		
		echo struktur_core_get_shortcode_module_template_part( 'templates/image-marquee-template', 'image-marquee', '', $params );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorImageMarquee() );