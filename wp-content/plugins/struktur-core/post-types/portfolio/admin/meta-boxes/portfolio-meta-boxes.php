<?php

if ( ! function_exists( 'struktur_core_map_portfolio_meta' ) ) {
	function struktur_core_map_portfolio_meta() {
		global $struktur_select_global_Framework;
		
		$struktur_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$struktur_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$struktur_portfolio_images = new StrukturSelectClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'struktur-core' ), '', '', 'portfolio_images' );
		$struktur_select_global_Framework->qodeMetaBoxes->addMetaBox( 'portfolio_images', $struktur_portfolio_images );
		
		$struktur_portfolio_image_gallery = new StrukturSelectClassMultipleImages( 'qodef-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'struktur-core' ), esc_html__( 'Choose your portfolio images', 'struktur-core' ) );
		$struktur_portfolio_images->addChild( 'qodef-portfolio-image-gallery', $struktur_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$struktur_portfolio_images_videos = struktur_select_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'struktur-core' ),
				'name'  => 'qodef_portfolio_images_videos'
			)
		);
		struktur_select_add_repeater_field(
			array(
				'name'        => 'qodef_portfolio_single_upload',
				'parent'      => $struktur_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'struktur-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'struktur-core' ),
						'options' => array(
							'image' => esc_html__('Image','struktur-core'),
							'video' => esc_html__('Video','struktur-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'struktur-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'struktur-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'struktur-core'),
							'vimeo' => esc_html__('Vimeo', 'struktur-core'),
							'self' => esc_html__('Self Hosted', 'struktur-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'struktur-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'struktur-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'struktur-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$struktur_additional_sidebar_items = struktur_select_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'struktur-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		struktur_select_add_repeater_field(
			array(
				'name'        => 'qodef_portfolio_properties',
				'parent'      => $struktur_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'struktur-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'struktur-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'struktur-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'struktur-core' )
					)
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_meta_boxes_map', 'struktur_core_map_portfolio_meta', 40 );
}