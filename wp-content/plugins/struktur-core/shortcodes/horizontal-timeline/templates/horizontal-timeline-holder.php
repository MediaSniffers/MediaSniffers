<div class="qodef-horizontal-timeline" data-distance="<?php echo esc_attr( $distance ); ?>">
	<div class="qodef-ht-nav">
		<div class="qodef-ht-nav-wrapper">
			<div class="qodef-ht-nav-inner">
				<ol>
					<?php foreach ( $dates as $date ) { ?>
						<li>
							<a href="#" data-date="<?php echo esc_attr( $date['formatted'] ); ?>"><?php echo esc_html( $date['date_label'] ); ?></a>
						</li>
					<?php } ?>
				</ol>
				<span class="qodef-ht-nav-filling-line" aria-hidden="true"></span>
			</div>
		</div>
		<ul class="qodef-ht-nav-navigation">
			<li><a href="#" class="qodef-prev qodef-inactive"></a></li>
			<li><a href="#" class="qodef-next"></a></li>
		</ul>
	</div>
	<div class="qodef-ht-content">
		<ol>
			<?php echo do_shortcode( $content ); ?>
		</ol>
	</div>
</div>