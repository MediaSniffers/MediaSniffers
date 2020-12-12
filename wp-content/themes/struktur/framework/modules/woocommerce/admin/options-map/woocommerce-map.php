<?php

if ( ! function_exists( 'struktur_select_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function struktur_select_woocommerce_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'struktur' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = struktur_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'woo_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'struktur' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for main shop page', 'struktur' ),
				'options'     => struktur_select_get_space_between_items_array( true ),
				'parent'      => $panel_product_list
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'struktur' ),
				'default_value' => 'qodef-woocommerce-columns-3',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'struktur' ),
				'options'       => array(
					'qodef-woocommerce-columns-3' => esc_html__( '3 Columns', 'struktur' ),
					'qodef-woocommerce-columns-4' => esc_html__( '4 Columns', 'struktur' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'struktur' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'struktur' ),
				'default_value' => 'normal',
				'options'       => struktur_select_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'struktur' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'struktur' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'struktur' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'struktur' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'struktur' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'struktur' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'struktur' ),
				'default_value' => 'h4',
				'options'       => struktur_select_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'struktur' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = struktur_select_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'struktur' ),
				'parent'        => $panel_single_product,
				'options'       => struktur_select_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_single_product_title_tag',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'struktur' ),
				'options'       => struktur_select_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '4',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'struktur' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'struktur' ),
					'3' => esc_html__( 'Three', 'struktur' ),
					'2' => esc_html__( 'Two', 'struktur' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'below-image',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'struktur' ),
				'options'       => array(
					'below-image'  => esc_html__( 'Below Featured Image', 'struktur' ),
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'struktur' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'struktur' ),
				'parent'        => $panel_single_product,
				'options'       => struktur_select_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'struktur' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'struktur' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'struktur' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'struktur' ),
				'default_value' => 'qodef-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'struktur' ),
				'options'       => array(
					'qodef-woocommerce-columns-3' => esc_html__( '3 Columns', 'struktur' ),
					'qodef-woocommerce-columns-4' => esc_html__( '4 Columns', 'struktur' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action('struktur_select_woocommerce_additional_options_map');
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_woocommerce_options_map', struktur_select_set_options_map_position( 'woocommerce' ) );
}