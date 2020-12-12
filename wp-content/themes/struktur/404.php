<?php get_header(); ?>
				<div class="qodef-page-not-found">
					<?php
					$qodef_title_image_404 = struktur_select_options()->getOptionValue( '404_page_title_image' );
					$qodef_title_404       = struktur_select_options()->getOptionValue( '404_title' );
					$qodef_subtitle_404    = struktur_select_options()->getOptionValue( '404_subtitle' );
					$qodef_text_404        = struktur_select_options()->getOptionValue( '404_text' );
					$qodef_button_label    = struktur_select_options()->getOptionValue( '404_back_to_home' );
					$qodef_button_style    = struktur_select_options()->getOptionValue( '404_button_style' );
					
					if ( ! empty( $qodef_title_image_404 ) ) { ?>
						<div class="qodef-404-title-image">
							<img src="<?php echo esc_url( $qodef_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'struktur' ); ?>" />
						</div>
					<?php } ?>
					
					<h1 class="qodef-404-title">
						<?php if ( ! empty( $qodef_title_404 ) ) {
							echo esc_html( $qodef_title_404 );
						} else {
							esc_html_e( '404', 'struktur' );
						} ?>
					</h1>
					
					<h3 class="qodef-404-subtitle">
						<?php if ( ! empty( $qodef_subtitle_404 ) ) {
							echo esc_html( $qodef_subtitle_404 );
						} else {
							esc_html_e( 'Page not found', 'struktur' );
						} ?>
					</h3>
					
					<p class="qodef-404-text">
						<?php if ( ! empty( $qodef_text_404 ) ) {
							echo esc_html( $qodef_text_404 );
						} else {
							esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'struktur' );
						} ?>
					</p>
					
					<?php
						$button_params = array(
							'link' => esc_url( home_url( '/' ) ),
							'text' => ! empty( $qodef_button_label ) ? $qodef_button_label : esc_html__( 'Back to home', 'struktur' )
						);
					
						if ( $qodef_button_style == 'light-style' ) {
							$button_params['custom_class'] = 'qodef-btn-light-style';
						}
						
						echo struktur_select_return_button_html( $button_params );
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
/**
 * struktur_select_action_before_closing_body_tag hook
 *
 * @see struktur_select_get_side_area() - hooked with 10
 * @see struktur_select_smooth_page_transitions() - hooked with 10
 */
do_action( 'struktur_select_action_before_closing_body_tag' ); ?>
<?php wp_footer(); ?>
</body>
</html>