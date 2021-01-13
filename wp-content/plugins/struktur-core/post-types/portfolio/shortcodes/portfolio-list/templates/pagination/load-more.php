<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="qodef-pl-loading">
		<span class="qodef-pl-loading-label"><?php echo esc_html__('Loading', 'struktur-core'); ?></span>
	</div>
	<div class="qodef-pl-load-more-holder">
		<div class="qodef-pl-load-more" <?php struktur_select_inline_style($holder_styles); ?>>
			<?php 
				echo struktur_select_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'type' => 'simple',
					'text' => esc_html__('Load more', 'struktur-core')
				));
			?>
		</div>
	</div>
<?php }