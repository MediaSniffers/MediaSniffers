<?php

if ( ! function_exists( 'struktur_core_reviews_map' ) ) {
	function struktur_core_reviews_map() {
		
		$reviews_panel = struktur_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'struktur-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'struktur-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'struktur-core' ),
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'struktur-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'struktur-core' ),
			)
		);
	}
	
	add_action( 'struktur_select_action_additional_page_options_map', 'struktur_core_reviews_map', 75 ); //one after elements
}