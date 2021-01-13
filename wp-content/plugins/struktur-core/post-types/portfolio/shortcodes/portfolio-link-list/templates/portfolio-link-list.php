<div class="qodef-pll-holder <?php echo esc_html( $holder_classes ) ?>">
	<ul class="pll-items">
		<?php if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post(); ?>
				<li class="pli-item">
                    <span class="pli-item-text" <?php echo struktur_select_get_inline_style( $title_styles ); ?>>
                        <a class="pli-item-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="_blank"><?php the_title(); ?></a>
                    </span>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
	</ul>
</div>