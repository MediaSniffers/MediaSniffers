<?php

if ( ! function_exists( 'struktur_select_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function struktur_select_reset_options_map() {
		
		struktur_select_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'struktur' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = struktur_select_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'struktur' )
			)
		);
		
		struktur_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'struktur' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'struktur' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'struktur_select_action_options_map', 'struktur_select_reset_options_map', struktur_select_set_options_map_position( 'reset' ) );
}