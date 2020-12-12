<?php

if ( ! function_exists( 'struktur_select_register_blog_metro_template_file' ) ) {
	/**
	 * Function that register blog metro template
	 */
	function struktur_select_register_blog_metro_template_file( $templates ) {
		$templates['blog-metro'] = esc_html__( 'Blog: Metro', 'struktur' );
		
		return $templates;
	}
	
	add_filter( 'struktur_select_filter_register_blog_templates', 'struktur_select_register_blog_metro_template_file' );
}

if ( ! function_exists( 'struktur_select_set_blog_metro_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function struktur_select_set_blog_metro_type_global_option( $options ) {
		$options['metro'] = esc_html__( 'Blog: Metro', 'struktur' );
		
		return $options;
	}
	
	add_filter( 'struktur_select_filter_blog_list_type_global_option', 'struktur_select_set_blog_metro_type_global_option' );
}