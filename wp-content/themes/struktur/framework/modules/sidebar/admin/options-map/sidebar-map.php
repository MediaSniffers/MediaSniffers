<?php

if ( ! function_exists( 'struktur_select_sidebar_options_map' ) ) {
	function struktur_select_sidebar_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'struktur' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = struktur_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'struktur' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		struktur_select_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'struktur' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'struktur' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => struktur_select_get_custom_sidebars_options()
		) );
		
		$struktur_custom_sidebars = struktur_select_get_custom_sidebars();
		if ( count( $struktur_custom_sidebars ) > 0 ) {
			struktur_select_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'struktur' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'struktur' ),
				'parent'      => $sidebar_panel,
				'options'     => $struktur_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_sidebar_options_map', struktur_select_set_options_map_position( 'sidebar' ) );
}