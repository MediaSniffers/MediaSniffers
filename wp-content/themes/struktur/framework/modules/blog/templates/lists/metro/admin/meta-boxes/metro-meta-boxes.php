<?php

/*** Masonry Gallery Settings ***/

if ( ! function_exists( 'struktur_select_map_metro_meta' ) ) {
	function struktur_select_map_metro_meta( $post_meta_box ) {
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_metro_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Metro List - Dimensions for Fixed Proportion', 'struktur' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Metro blog lists in fixed proportion', 'struktur' ),
				'default_value' => 'small',
				'parent'        => $post_meta_box,
				'options'       => array(
					'small'              => esc_html__( 'Small', 'struktur' ),
					'large-width'        => esc_html__( 'Large Width', 'struktur' ),
					'large-height'       => esc_html__( 'Large Height', 'struktur' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'struktur' )
				)
			)
		);
		
		struktur_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_metro_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Metro List - Dimensions for Original Proportion', 'struktur' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Metro blog lists in original proportion', 'struktur' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'struktur' ),
					'large-width' => esc_html__( 'Large Width', 'struktur' )
				)
			)
		);
	}
	
	add_action( 'struktur_select_action_blog_post_meta', 'struktur_select_map_metro_meta' );
}
