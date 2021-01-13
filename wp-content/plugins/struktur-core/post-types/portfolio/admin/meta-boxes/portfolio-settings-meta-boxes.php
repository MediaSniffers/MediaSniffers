<?php

if ( ! function_exists( 'struktur_core_map_portfolio_settings_meta' ) ) {
	function struktur_core_map_portfolio_settings_meta() {
		$meta_box = struktur_select_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'struktur-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		struktur_select_create_meta_box_field( array(
			'name'        => 'qodef_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'struktur-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'struktur-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'struktur-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'struktur-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'struktur-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'struktur-core' ),
				'slider'            => esc_html__( 'Portfolio Full Width Slider', 'struktur-core' ),
				'big-slider'        => esc_html__( 'Portfolio Big Slider', 'struktur-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'struktur-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'struktur-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'struktur-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'struktur-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'struktur-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'struktur-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'struktur-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = struktur_select_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'qodef_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'struktur-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'struktur-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => struktur_select_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'struktur-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'struktur-core' ),
				'default_value' => '',
				'options'       => struktur_select_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = struktur_select_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'qodef_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'struktur-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'struktur-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => struktur_select_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'struktur-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'struktur-core' ),
				'default_value' => '',
				'options'       => struktur_select_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'struktur-core' ),
				'parent'        => $meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'struktur-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'struktur-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'struktur-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'struktur-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_featured_image_for_portfolio_list_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'struktur-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio List and Portfolio Slider', 'struktur-core' ),
				'parent'      => $meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'        => 'qodef_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image - Switch Images', 'struktur-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'struktur-core' ),
				'parent'      => $meta_box
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'struktur-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'struktur-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'struktur-core' ),
					'small'              => esc_html__( 'Small', 'struktur-core' ),
					'large-width'        => esc_html__( 'Large Width', 'struktur-core' ),
					'large-height'       => esc_html__( 'Large Height', 'struktur-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'struktur-core' )
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'struktur-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'struktur-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'struktur-core' ),
					'large-width' => esc_html__( 'Large Width', 'struktur-core' )
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_hide_pagination_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Hide Pagination', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'struktur-core' ),
				'parent'        => $meta_box,
				'options'       => struktur_select_get_yes_no_select_array()
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_core_map_portfolio_settings_meta', 41 );
}