<?php

if ( $display_button === 'yes' ) {
	$product = struktur_select_return_woocommerce_global_variable();
	
	$buttonSkinClass = '';
	if ( ! empty( $button_skin ) ) {
		$buttonSkinClass = 'qodef-' . $button_skin . '-skin';
	}
	
	$button_classes = 'button add_to_cart_button ajax_add_to_cart qodef-button';
	
	if ( ! $product->is_in_stock() ) {
		$button_classes = 'button ajax_add_to_cart qodef-button qodef-out-of-stock';
	} else if ( $product->get_type() === 'variable' ) {
		$button_classes = 'button product_type_variable add_to_cart_button qodef-button';
	} else if ( $product->get_type() === 'external' ) {
		$button_classes = 'button product_type_external qodef-button';
	}
	?>
	
	<div class="qodef-<?php echo esc_attr( $class_name ); ?>-add-to-cart <?php echo esc_attr( $buttonSkinClass ); ?>">
		<?php echo apply_filters( 'struktur_select_filter_product_list_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product ); ?>
	</div>
<?php } ?>