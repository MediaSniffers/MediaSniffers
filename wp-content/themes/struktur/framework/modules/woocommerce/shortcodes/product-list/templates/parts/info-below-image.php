<?php
$switch_image_meta      = get_post_meta( get_the_ID(), 'qodef_product_switch_image', true );
$item_classes           = $this_object->getItemClasses( $params );
if( !empty($switch_image_meta) && $switch_image_meta !== '' ) {
	$item_classes = $item_classes . 'qodef-pli-has-switch-image';
}
$shader_styles          = $this_object->getShaderStyles( $params );
$text_wrapper_styles    = $this_object->getTextWrapperStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="qodef-pli qodef-item-space <?php echo esc_attr( $item_classes ); ?>">
	<div class="qodef-pli-inner">
		<div class="qodef-pli-image">
			<?php struktur_select_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
		</div>
		<?php if( !empty($switch_image_meta) && $switch_image_meta !== '' ) : ?>
			<div class="qodef-pli-switch-image">
				<img src="<?php echo esc_url($switch_image_meta); ?>" alt="switch_image_<?php echo get_the_ID(); ?>">
			</div>
		<?php endif; ?>
		<a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="qodef-pli-text-wrapper" <?php echo struktur_select_get_inline_style( $text_wrapper_styles ); ?>>
		<?php struktur_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
		
		<?php struktur_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
		
		<?php struktur_select_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
		
		<?php struktur_select_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
		
		<?php struktur_select_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
		
		<?php struktur_select_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
	</div>
</div>