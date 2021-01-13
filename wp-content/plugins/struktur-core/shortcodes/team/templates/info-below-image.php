<div class="qodef-team-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="qodef-team-image">
                <?php echo wp_get_attachment_image($team_image, 'full'); ?>
				<?php if($overlay_pattern === 'yes') : ?>
					<div class="qodef-pattern-overlay" <?php struktur_select_inline_style($svg_pattern_style); ?>></div>
				<?php endif; ?>
				<?php if ($team_link !== '') { ?>
                    <a class="qodef-team-link" href="<?php echo esc_url($team_link) ?>" target="<?php echo esc_attr($team_target) ?>" ></a>
                <?php } ?>
			</div>
		<?php } ?>
		<div class="qodef-team-info">
			<?php if ($team_name !== '') { ?>
				<<?php echo esc_attr($team_name_tag); ?> class="qodef-team-name" <?php echo struktur_select_get_inline_style($team_name_styles); ?>><?php echo esc_html($team_name); ?></<?php echo esc_attr($team_name_tag); ?>>
			<?php } ?>
			<?php if ($team_position !== "") { ?>
				<h6 class="qodef-team-position" <?php echo struktur_select_get_inline_style($team_position_styles); ?>><?php echo esc_html($team_position); ?></h6>
			<?php } ?>
			<?php if ($team_text !== "") { ?>
				<p class="qodef-team-text" <?php echo struktur_select_get_inline_style($team_text_styles); ?>><?php echo esc_html($team_text); ?></p>
			<?php } ?>
			<?php if (!empty($team_social_icons)) { ?>
				<div class="qodef-team-social-holder">
					<?php foreach( $team_social_icons as $team_social_icon ) { ?>
						<span class="qodef-team-icon"><?php echo wp_kses_post($team_social_icon); ?></span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>