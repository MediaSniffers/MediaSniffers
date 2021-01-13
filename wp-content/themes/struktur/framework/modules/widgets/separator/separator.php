<?php

if ( class_exists( 'StrukturCoreClassWidget' ) ) {
	class StrukturSelectClassSeparatorWidget extends StrukturCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_separator_widget',
				esc_html__( 'Struktur Separator Widget', 'struktur' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'struktur' ) )
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
						'normal'     => esc_html__( 'Normal', 'struktur' ),
						'full-width' => esc_html__( 'Full Width', 'struktur' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__( 'Position', 'struktur' ),
					'options' => array(
						'center' => esc_html__( 'Center', 'struktur' ),
						'left'   => esc_html__( 'Left', 'struktur' ),
						'right'  => esc_html__( 'Right', 'struktur' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__( 'Style', 'struktur' ),
					'options' => array(
						'solid'  => esc_html__( 'Solid', 'struktur' ),
						'dashed' => esc_html__( 'Dashed', 'struktur' ),
						'dotted' => esc_html__( 'Dotted', 'struktur' )
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'struktur' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__( 'Width (px or %)', 'struktur' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'struktur' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__( 'Top Margin (px or %)', 'struktur' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__( 'Bottom Margin (px or %)', 'struktur' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			//prepare variables
			$params = '';
			
			//is instance empty?
			if ( is_array( $instance ) && count( $instance ) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}
			
			echo '<div class="widget qodef-separator-widget">';
			echo do_shortcode( "[qodef_separator $params]" ); // XSS OK
			echo '</div>';
		}
	}
}