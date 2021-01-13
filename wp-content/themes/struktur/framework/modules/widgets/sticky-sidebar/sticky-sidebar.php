<?php

if ( class_exists( 'StrukturCoreClassWidget' ) ) {
	class StrukturSelectClassStickySidebar extends StrukturCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_sticky_sidebar',
				esc_html__( 'Struktur Sticky Sidebar Widget', 'struktur' ),
				array( 'description' => esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar.', 'struktur' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
		}
		
		public function widget( $args, $instance ) {
			echo '<div class="widget qodef-widget-sticky-sidebar"></div>';
		}
	}
}
