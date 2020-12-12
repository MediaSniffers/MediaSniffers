<?php

if ( ! function_exists( 'struktur_select_map_woocommerce_meta' ) ) {
	function struktur_select_map_woocommerce_meta() {
		
		$woocommerce_meta_box = struktur_select_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'struktur' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'struktur' ),
				'description' => esc_html__( 'Choose image layout when it appears in Select Product List - Masonry layout shortcode', 'struktur' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'struktur' ),
					'small'              => esc_html__( 'Small', 'struktur' ),
					'large-width'        => esc_html__( 'Large Width', 'struktur' ),
					'large-height'       => esc_html__( 'Large Height', 'struktur' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'struktur' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_product_switch_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Switch Image', 'struktur' ),
				'description' => esc_html__( 'Choose an image that will be used as Switch Image in Product List - Info Bellow Image', 'struktur' ),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'struktur' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'struktur' ),
				'options'       => struktur_select_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'struktur' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_select_map_woocommerce_meta', 99 );
}