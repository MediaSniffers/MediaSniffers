<?php

if ( ! function_exists( 'struktur_select_logo_options_map' ) ) {
	function struktur_select_logo_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'struktur' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = struktur_select_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'struktur' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'struktur' )
			)
		);
		
		$hide_logo_container = struktur_select_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => STRUKTUR_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'struktur' ),
				'parent'        => $hide_logo_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => STRUKTUR_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'struktur' ),
				'parent'        => $hide_logo_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => STRUKTUR_SELECT_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'struktur' ),
				'parent'        => $hide_logo_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => STRUKTUR_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'struktur' ),
				'parent'        => $hide_logo_container
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => STRUKTUR_SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'struktur' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_logo_options_map', struktur_select_set_options_map_position( 'logo' ) );
}