<?php

class StrukturCoreElementorItemShowcase extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'qodef_item_showcase';
	}
	
	public function get_title() {
		return esc_html__( 'Item Showcase', 'struktur-core' );
	}
	
	public function get_icon() {
		return 'struktur-elementor-custom-icon struktur-elementor-item-showcase';
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
			'item_image',
			[
				'label' => esc_html__( 'Image', 'struktur-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'image_top_offset',
			[
				'label'   => esc_html__( 'Image Top Offset', 'struktur-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '-100px'
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_position',
			[
				'label'   => esc_html__( 'Item Position', 'struktur-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left'  => esc_html__( 'Left', 'struktur-core' ),
					'right' => esc_html__( 'Right', 'struktur-core' )
				],
				'default' => 'left'
			]
		);
		
		$repeater->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Item Title', 'struktur-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'item_link',
			[
				'label'     => esc_html__( 'Item Link', 'struktur-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'item_title!' => ''
				],
			]
		);
		
		$repeater->add_control(
			'item_target',
			[
				'label'   => esc_html__( 'Item Target', 'struktur-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => struktur_select_get_link_target_array(),
				'default' => '_self'
			]
		);
		
		$repeater->add_control(
			'item_title_tag',
			[
				'label'   => esc_html__( 'Item Title Tag', 'struktur-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => struktur_select_get_title_tag( true ),
				'default' => 'h4'
			]
		);
		
		$repeater->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'struktur-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'item_title!' => ''
				],
			]
		);
		
		$repeater->add_control(
			'item_text',
			[
				'label' => esc_html__( 'Item Text', 'struktur-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Item Text Color', 'struktur-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'item_text!' => ''
				],
			]
		);
		
		$this->add_control(
			'item_showcase_list_item',
			[
				'label'       => esc_html__( 'Item Showcase List Items', 'struktur-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Item Showcase List Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'item_image'       => '',
			'image_top_offset' => '',
		);
		
		$params['item_image_style'] = '';
		if ( ! empty( $params['image_top_offset'] ) ) {
			$params['item_image_style'] = 'margin-top: ' . struktur_select_filter_px( $params['image_top_offset'] ) . 'px';
		}
		
		if ( ! empty( $params['item_image'] ) ) {
			$params['item_image'] = $params['item_image']['id'];
		}
		
		?>
		
		<div class="qodef-item-showcase-holder clearfix">
			
			<?php foreach ( $params['item_showcase_list_item'] as $isli ) {

				$isli['showcase_item_class'] = $this->getShowcaseItemClasses( $isli );
				$isli['item_target']         = ! empty( $isli['item_target'] ) ? $isli['item_target'] : '_self';
				$isli['item_title_tag']      = ! empty( $isli['item_title_tag'] ) ? $isli['item_title_tag'] : 'h4';
				$isli['item_title_styles']   = $this->getTitleStyles( $isli );
				$isli['item_text_styles']    = $this->getTextStyles( $isli );
				
				echo struktur_core_get_shortcode_module_template_part( 'templates/item-showcase-item', 'item-showcase', '', $isli );
			} ?>
			
			<?php if ( ! empty( $params['item_image'] ) ) { ?>
				<div class="qodef-is-image" <?php echo struktur_select_get_inline_style( $params['item_image_style'] ) ?>>
					<?php echo wp_get_attachment_image( $params['item_image'], 'full' ); ?>
				</div>
			<?php } ?>
		</div>
		
		<?php
	}

	private function getShowcaseItemClasses( $isli ) {
		$itemClass = array();

		if ( ! empty( $isli['item_position'] ) ) {
            $itemClass[] = 'qodef-is-' . $isli['item_position'];
		}

		return implode( ' ', $itemClass );
	}
	
	private function getTitleStyles( $isli ) {
		$styles = array();
		
		if ( ! empty( $isli['item_title_color'] ) ) {
			$styles[] = 'color: ' . $isli['item_title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $isli ) {
		$styles = array();
		
		if ( ! empty( $isli['item_text_color'] ) ) {
			$styles[] = 'color: ' . $isli['item_text_color'];
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorItemShowcase() );