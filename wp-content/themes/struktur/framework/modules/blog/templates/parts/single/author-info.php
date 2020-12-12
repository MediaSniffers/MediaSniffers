<?php
$author_info_box       = esc_attr( struktur_select_options()->getOptionValue( 'blog_author_info' ) );
$author_info_email     = esc_attr( struktur_select_options()->getOptionValue( 'blog_author_info_email' ) );
$author_id             = esc_attr( get_the_author_meta( 'ID' ) );
$social_networks       = struktur_select_is_plugin_installed( 'core' ) ? struktur_select_get_user_custom_fields() : false;
$display_author_social = struktur_select_options()->getOptionValue( 'blog_single_author_social' ) === 'no' ? false : true;
?>
<?php if ( $author_info_box === 'yes' && get_the_author_meta( 'description' ) !== "" ) { ?>
	<div class="qodef-author-description">
		<div class="qodef-author-description-image">
			<a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo struktur_select_kses_img( get_avatar( get_the_author_meta( 'ID' ), 193 ) ); ?>
			</a>
		</div>
		<div class="qodef-author-description-content">
			<span class="qodef-author-label"><?php echo esc_html__('Written By:', 'struktur'); ?></span>
			<h4 class="qodef-author-name vcard author">
				<a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" title="<?php the_title_attribute(); ?>">
					<span class="fn">
						<?php
						if ( get_the_author_meta( 'first_name' ) != "" || get_the_author_meta( 'last_name' ) != "" ) {
							echo esc_html( get_the_author_meta( 'first_name' ) ) . " " . esc_html( get_the_author_meta( 'last_name' ) );
						} else {
							echo esc_html( get_the_author_meta( 'display_name' ) );
						}
						?>
					</span>
				</a>
			</h4>
			<?php if ( $author_info_email === 'yes' && is_email( get_the_author_meta( 'email' ) ) ) { ?>
				<p itemprop="email" class="qodef-author-email"><?php echo sanitize_email( get_the_author_meta( 'email' ) ); ?></p>
			<?php } ?>
			<?php if ( get_the_author_meta( 'description' ) != "" ) { ?>
				<p itemprop="description" class="qodef-author-text"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
			<?php } ?>
			<?php if ( $display_author_social ) { ?>
				<?php if ( is_array( $social_networks ) && count( $social_networks ) ) { ?>
					<div class="qodef-author-social-icons clearfix">
						<?php foreach ( $social_networks as $network ) { ?>
							<a itemprop="url" href="<?php echo esc_attr( $network['link'] ) ?>" target="_blank">
								<?php echo struktur_select_icon_collections()->renderIcon( $network['class'], 'font_awesome' ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>