<?php

if ( ! function_exists( 'struktur_select_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function struktur_select_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'struktur' ),
				'description'   => esc_html__( 'Default Sidebar area. In order to display this area you need to enable it through global theme options or on page meta box options.', 'struktur' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'struktur_select_register_sidebars', 1 );
}

if ( ! function_exists( 'struktur_select_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates StrukturSelectClassSidebar object
	 */
	function struktur_select_add_support_custom_sidebar() {
		add_theme_support( 'StrukturSelectClassSidebar' );
		
		if ( get_theme_support( 'StrukturSelectClassSidebar' ) ) {
			new StrukturSelectClassSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'struktur_select_add_support_custom_sidebar' );
}