<a itemprop="url" <?php struktur_select_class_attribute( struktur_select_get_dropdown_cart_icon_class() ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="qodef-sc-opener-icon"><?php echo struktur_select_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?></span>
	<span class="qodef-shopping-cart-label"><?php esc_html_e( 'Cart', 'struktur' ); ?></span><span class="qodef-sc-opener-count"><?php echo '(' . WC()->cart->cart_contents_count . ')'; ?></span>
</a>