<?php

if ( class_exists( 'StrukturCoreClassWidget' ) ) {
	class StrukturSelectClassButtonWidget extends StrukturCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_button_widget',
				esc_html__( 'Struktur Button Widget', 'struktur' ),
				array( 'description' => esc_html__( 'Add button element to widget areas', 'struktur' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'struktur' ),
					'options' => array(
						'solid'   => esc_html__( 'Solid', 'struktur' ),
						'outline' => esc_html__( 'Outline', 'struktur' ),
						'simple'  => esc_html__( 'Simple', 'struktur' )
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'struktur' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'struktur' ),
						'medium' => esc_html__( 'Medium', 'struktur' ),
						'large'  => esc_html__( 'Large', 'struktur' ),
						'huge'   => esc_html__( 'Huge', 'struktur' )
					),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'struktur' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'struktur' ),
					'default' => esc_html__( 'Button Text', 'struktur' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'struktur' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'struktur' ),
					'options' => struktur_select_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'struktur' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'struktur' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'struktur' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'struktur' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'struktur' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'struktur' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'struktur' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'struktur' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'struktur' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'struktur' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'struktur' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'struktur' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$params = '';
			
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			// Filter out all empty params
			$instance = array_filter( $instance, function ( $array_value ) {
				return trim( $array_value ) != '';
			} );
			
			// Default values
			if ( ! isset( $instance['text'] ) ) {
				$instance['text'] = 'Button Text';
			}
			
			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
			
			echo '<div class="widget qodef-button-widget">';
			echo do_shortcode( "[qodef_button $params]" ); // XSS OK
			echo '</div>';
		}
	}
}