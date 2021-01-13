<?php

if ( ! function_exists( 'struktur_core_register_widgets' ) ) {
	function struktur_core_register_widgets() {
		$widgets = apply_filters( 'struktur_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'struktur_core_register_widgets' );
}