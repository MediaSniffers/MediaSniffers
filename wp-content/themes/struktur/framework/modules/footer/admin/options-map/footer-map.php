<?php

if ( ! function_exists( 'struktur_select_footer_options_map' ) ) {
	function struktur_select_footer_options_map() {

		struktur_select_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'struktur' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = struktur_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'struktur' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		struktur_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'struktur' ),
				'parent'        => $footer_panel
			)
		);

        struktur_select_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'struktur' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'struktur' ),
                'parent'        => $footer_panel
            )
        );

		struktur_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'struktur' ),
				'parent'        => $footer_panel
			)
		);
		
		$show_footer_top_container = struktur_select_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'struktur' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'struktur' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'struktur' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'struktur' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'struktur' ),
					'left'   => esc_html__( 'Left', 'struktur' ),
					'center' => esc_html__( 'Center', 'struktur' ),
					'right'  => esc_html__( 'Right', 'struktur' )
				),
				'parent'        => $show_footer_top_container
			)
		);
		
		$footer_top_styles_group = struktur_select_add_admin_group(
			array(
				'name'        => 'footer_top_styles_group',
				'title'       => esc_html__( 'Footer Top Styles', 'struktur' ),
				'description' => esc_html__( 'Define style for footer top area', 'struktur' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		$footer_top_styles_row_1 = struktur_select_add_admin_row(
			array(
				'name'   => 'footer_top_styles_row_1',
				'parent' => $footer_top_styles_group
			)
		);
		
			struktur_select_add_admin_field(
				array(
					'name'   => 'footer_top_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'struktur' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			struktur_select_add_admin_field(
				array(
					'name'   => 'footer_top_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'struktur' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			struktur_select_add_admin_field(
				array(
					'name'   => 'footer_top_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'struktur' ),
					'parent' => $footer_top_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

		struktur_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'struktur' ),
				'parent'        => $footer_panel
			)
		);

		$show_footer_bottom_container = struktur_select_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		struktur_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'struktur' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'struktur' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_group = struktur_select_add_admin_group(
			array(
				'name'        => 'footer_bottom_styles_group',
				'title'       => esc_html__( 'Footer Bottom Styles', 'struktur' ),
				'description' => esc_html__( 'Define style for footer bottom area', 'struktur' ),
				'parent'      => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_row_1 = struktur_select_add_admin_row(
			array(
				'name'   => 'footer_bottom_styles_row_1',
				'parent' => $footer_bottom_styles_group
			)
		);
		
			struktur_select_add_admin_field(
				array(
					'name'   => 'footer_bottom_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'struktur' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			struktur_select_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'struktur' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			struktur_select_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'struktur' ),
					'parent' => $footer_bottom_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);
	}

	add_action( 'struktur_select_action_options_map', 'struktur_select_footer_options_map', struktur_select_set_options_map_position( 'footer' ) );
}