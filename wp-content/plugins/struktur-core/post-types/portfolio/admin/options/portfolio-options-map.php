<?php

if ( ! function_exists( 'struktur_select_portfolio_options_map' ) ) {
	function struktur_select_portfolio_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'struktur-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = struktur_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'struktur-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'struktur-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'struktur-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'struktur-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'struktur-core' ),
				'parent'        => $panel_archive,
				'options'       => struktur_select_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'struktur-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'struktur-core' ),
				'default_value' => 'normal',
				'options'       => struktur_select_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'struktur-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'struktur-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'struktur-core' ),
					'landscape' => esc_html__( 'Landscape', 'struktur-core' ),
					'portrait'  => esc_html__( 'Portrait', 'struktur-core' ),
					'square'    => esc_html__( 'Square', 'struktur-core' )
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'struktur-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Grayscale', 'struktur-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Grayscale', 'struktur-core' ),
					'standard-switch-images' => esc_html__( 'Standard - Info Below', 'struktur-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Custom Cursor', 'struktur-core' )
				)
			)
		);
		
		$panel = struktur_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'struktur-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'struktur-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'struktur-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'struktur-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'struktur-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => struktur_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'struktur-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'struktur-core' ),
				'default_value' => 'normal',
				'options'       => struktur_select_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'struktur-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'struktur-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => struktur_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'struktur-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'struktur-core' ),
				'default_value' => 'normal',
				'options'       => struktur_select_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'struktur-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'struktur-core' ),
					'yes' => esc_html__( 'Yes', 'struktur-core' ),
					'no'  => esc_html__( 'No', 'struktur-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'struktur-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = struktur_select_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'struktur-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'struktur-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'struktur-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'struktur-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_portfolio_options_map', struktur_select_set_options_map_position( 'portfolio' ) );
}