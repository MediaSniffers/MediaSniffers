<?php
get_header();
struktur_select_get_title();
do_action( 'struktur_select_action_before_main_content' ); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action( 'struktur_select_action_after_container_open' ); ?>
	<div class="qodef-container-inner clearfix">
		<?php
			$struktur_taxonomy_id   = get_queried_object_id();
			$struktur_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$struktur_taxonomy      = ! empty( $struktur_taxonomy_id ) ? get_term_by( 'id', $struktur_taxonomy_id, $struktur_taxonomy_type ) : '';
			$struktur_taxonomy_slug = ! empty( $struktur_taxonomy ) ? $struktur_taxonomy->slug : '';
			$struktur_taxonomy_name = ! empty( $struktur_taxonomy ) ? $struktur_taxonomy->taxonomy : '';
			
			struktur_core_get_archive_portfolio_list( $struktur_taxonomy_slug, $struktur_taxonomy_name );
		?>
	</div>
	<?php do_action( 'struktur_select_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
