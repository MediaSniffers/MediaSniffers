<?php

if ( ! function_exists( 'struktur_select_portfolio_category_additional_fields' ) ) {
	function struktur_select_portfolio_category_additional_fields() {
		
		$fields = struktur_select_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		struktur_select_add_taxonomy_field(
			array(
				'name'   => 'qodef_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'struktur-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'struktur_select_action_custom_taxonomy_fields', 'struktur_select_portfolio_category_additional_fields' );
}