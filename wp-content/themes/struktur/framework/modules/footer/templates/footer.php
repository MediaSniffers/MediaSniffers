<?php do_action( 'struktur_select_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="qodef-page-footer <?php echo esc_attr($holder_classes); ?>">
				<?php
					if($display_footer_top) {
						struktur_select_get_footer_top();
					}
					if($display_footer_bottom) {
						struktur_select_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.qodef-wrapper-inner  -->
</div> <!-- close div.qodef-wrapper -->
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