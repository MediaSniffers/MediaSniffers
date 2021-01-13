<?php

if ( class_exists( 'StrukturCoreClassWidget' ) ) {
	class StrukturSelectClassWoocommerceDropdownCart extends StrukturCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_woocommerce_dropdown_cart',
				esc_html__('Struktur Woocommerce Dropdown Cart', 'struktur'),
				array('description' => esc_html__('Display a shop cart icon with a dropdown that shows products that are in the cart', 'struktur'),)
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'        => 'textfield',
					'name'        => 'woocommerce_dropdown_cart_margin',
					'title'       => esc_html__('Icon Margin', 'struktur'),
					'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'struktur')
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$icon_styles = array();
			
			if ( $instance['woocommerce_dropdown_cart_margin'] !== '' ) {
				$icon_styles[] = 'margin: ' . $instance['woocommerce_dropdown_cart_margin'];
			}
			?>
			<div class="qodef-shopping-cart-holder" <?php struktur_select_inline_style( $icon_styles ) ?>>
				<div class="qodef-shopping-cart-inner">
					<?php struktur_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/content', 'woocommerce' ); ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'struktur_select_woocommerce_header_add_to_cart_fragment' ) ) {
	function struktur_select_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<div class="qodef-shopping-cart-inner">
			<?php struktur_select_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/content', 'woocommerce' ); ?>
		</div>
		
		<?php
		$fragments['div.qodef-shopping-cart-inner'] = ob_get_clean();
		
		return $fragments;
	}
	
	add_filter( 'woocommerce_add_to_cart_fragments', 'struktur_select_woocommerce_header_add_to_cart_fragment' );
}
?>