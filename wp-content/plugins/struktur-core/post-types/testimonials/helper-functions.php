<?php

if ( ! function_exists( 'struktur_core_testimonials_meta_box_functions' ) ) {
	function struktur_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'struktur_select_filter_meta_box_post_types_save', 'struktur_core_testimonials_meta_box_functions' );
	add_filter( 'struktur_select_filter_meta_box_post_types_remove', 'struktur_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'struktur_core_register_testimonials_cpt' ) ) {
	function struktur_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'StrukturCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'struktur_core_filter_register_custom_post_types', 'struktur_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if ( ! function_exists( 'struktur_core_include_testimonials_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function struktur_core_include_testimonials_shortcodes_files() {
		foreach ( glob( STRUKTUR_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'struktur_core_action_include_shortcodes_file', 'struktur_core_include_testimonials_shortcodes_files' );
}

// Load testimonials elementor widgets
if ( ! function_exists( 'struktur_core_include_testimonials_elementor_widgets_files' ) ) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function struktur_core_include_testimonials_elementor_widgets_files() {
        if ( struktur_core_theme_installed() && struktur_select_is_elementor_installed() ) {
            foreach (glob(STRUKTUR_CORE_CPT_PATH . '/testimonials/shortcodes/*/elementor-*.php') as $shortcode_load) {
                include_once $shortcode_load;
            }
        }
    }
    add_action( 'elementor/widgets/widgets_registered', 'struktur_core_include_testimonials_elementor_widgets_files' );
}