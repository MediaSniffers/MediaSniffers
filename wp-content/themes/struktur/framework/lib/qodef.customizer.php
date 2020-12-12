<?php
/**
 * Adds options to the customizer.
 */
defined( 'ABSPATH' ) || exit;

/**
 * StrukturSelectClassCustomizer class.
 */
class StrukturSelectClassCustomizer {
	
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'add_sections' ) );
	}
	
	/**
	 * Get item name.
	 */
	public function get_item_name( $item ) {
		return ucwords( str_replace( '-', ' ', basename( $item ) ) );
	}
	
	/**
	 * Get item class name.
	 */
	public function get_item_class( $item ) {
		return str_replace( '-', '_', basename( $item ) );
	}
	
	/**
	 * Sanitize callback function for checkbox
	 */
	public function sanitize_checkbox( $checked ) {
		return isset( $checked ) && $checked === true;
	}
	
	/**
	 * Add settings to the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_sections( $wp_customize ) {
		
		$wp_customize->add_panel(
			'struktur_performance',
			array(
				'priority' => 250,
				'title'    => esc_html__( 'Struktur Performance', 'struktur' )
			)
		);
		
		$wp_customize->add_section(
			'struktur_performance_icon_packs_section',
			array(
				'panel'       => 'struktur_performance',
				'priority'    => 10,
				'title'       => esc_html__( 'Icon Packs', 'struktur' ),
				'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionalities which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'struktur' )
			)
		);
		
		foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_ICONS_ROOT_DIR . '/*', GLOB_ONLYDIR ) as $item ) {
			$wp_customize->add_setting(
				'struktur_performance_disable_icon_pack_' . $this->get_item_class( $item ),
				array(
					'default'           => false,
					'type'              => 'option',
					'sanitize_callback' => array( $this, 'sanitize_checkbox' )
				)
			);
			
			$wp_customize->add_control(
				'struktur_performance_disable_icon_pack_' . $this->get_item_class( $item ),
				array(
					'section'  => 'struktur_performance_icon_packs_section',
					'settings' => 'struktur_performance_disable_icon_pack_' . $this->get_item_class( $item ),
					'type'     => 'checkbox',
					'label'    => $this->get_item_name( $item ),
				)
			);
		}
		
		if ( struktur_select_is_plugin_installed( 'core' ) ) {
			$wp_customize->add_section(
				'struktur_performance_cpt_section',
				array(
					'panel'       => 'struktur_performance',
					'priority'    => 20,
					'title'       => esc_html__( 'Custom Post Types', 'struktur' ),
					'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionalities which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'struktur' )
				)
			);
			
			foreach ( glob( STRUKTUR_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $item ) {
				$wp_customize->add_setting(
					'struktur_performance_disable_cpt_' . $this->get_item_class( $item ),
					array(
						'default'           => false,
						'type'              => 'option',
						'sanitize_callback' => array( $this, 'sanitize_checkbox' )
					)
				);
				
				$wp_customize->add_control(
					'struktur_performance_disable_cpt_' . $this->get_item_class( $item ),
					array(
						'section'  => 'struktur_performance_cpt_section',
						'settings' => 'struktur_performance_disable_cpt_' . $this->get_item_class( $item ),
						'type'     => 'checkbox',
						'label'    => $this->get_item_name( $item ),
					)
				);
			}
			
			$wp_customize->add_section(
				'struktur_performance_shortcodes_section',
				array(
					'panel'       => 'struktur_performance',
					'priority'    => 30,
					'title'       => esc_html__( 'Shortcodes', 'struktur' ),
					'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionalities which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'struktur' )
				)
			);
			
			$shortcodes = array();
			
			foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*', GLOB_ONLYDIR ) as $item ) {
				$shortcodes[ $this->get_item_class( $item ) ] = $this->get_item_name( $item );
			}
			
			if ( struktur_select_is_plugin_installed( 'woocommerce' ) ) {
				foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*', GLOB_ONLYDIR ) as $item ) {
					$shortcodes[ $this->get_item_class( $item ) ] = $this->get_item_name( $item );
				}
			}
			
			foreach ( glob( STRUKTUR_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $item ) {
				$shortcodes[ $this->get_item_class( $item ) ] = $this->get_item_name( $item );
			}
			
			if ( ! empty( $shortcodes ) ) {
				ksort( $shortcodes );
				
				foreach ( $shortcodes as $key => $value ) {
					$wp_customize->add_setting(
						'struktur_performance_disable_shortcode_' . $key,
						array(
							'default'           => false,
							'type'              => 'option',
							'sanitize_callback' => array( $this, 'sanitize_checkbox' )
						)
					);
					
					$wp_customize->add_control(
						'struktur_performance_disable_cpt_' . $key,
						array(
							'section'  => 'struktur_performance_shortcodes_section',
							'settings' => 'struktur_performance_disable_shortcode_' . $key,
							'type'     => 'checkbox',
							'label'    => $value,
						)
					);
				}
			}
		}
	}
}

new StrukturSelectClassCustomizer();
