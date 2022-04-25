<?php
global $product;?>
<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
	<div class="product_meta">
	<?php esc_html_e( 'SKU:', 'redchili' ); ?> <span class="sku"><?php echo esc_html( $sku = $product->get_sku() ) ? $sku : esc_html( 'N/A', 'redchili' ); ?></span>
	</div>
<?php endif;