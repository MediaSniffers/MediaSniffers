<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
?>
<?php if ( struktur_select_is_plugin_installed( 'core' ) && struktur_select_options()->getOptionValue( 'enable_social_share' ) === 'yes' && struktur_select_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="qodef-blog-share">
		<span class="qodef-blog-share-label"><?php echo esc_html__('Share:', 'struktur'); ?></span>
		<?php echo struktur_select_get_social_share_html( array( 'type' => $share_type ) ); ?>
	</div>
<?php } ?>