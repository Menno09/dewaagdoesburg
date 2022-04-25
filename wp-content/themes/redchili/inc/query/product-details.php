<?php
	global $woocommerce;
	$thumbnail = false;
	$pro_id = $product->ID;
	$thumbnail = get_the_post_thumbnail( $product->ID, 'full' , array( 'class' => 'img-responsive' ) );
	if ( empty ( $thumbnail ) ) {
		if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
			$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
		}
		elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
			$thumbnail = '<img class="attachment-rdtheme-size5 size-rdtheme-size5 wp-post-image" src="'.RDTHEME_IMG_URL.'noimage.jpg" alt="'.get_the_title().'">';
		}
	}
?>
	<div>
		<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
	</div>
	<br>
	<div class="text-left"><?php echo get_the_excerpt( $product->ID ); ?></div>
				
	<div class="buttons">
		
	<?php if ( $showcart == '1' ) { ?>
	<form action="<?php echo site_url(); ?>/?add-to-cart=<?php echo esc_attr( $pro_id ); ?>&quantity=1" class="cart" method="post" enctype='multipart/form-data'>
		<button type="submit" data-quantity="1" data-product_id="<?php echo esc_attr( $pro_id ); ?>"
	class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><?php esc_html_e ( 'Add To Cart' , 'redchili' ); ?></button>
	</form>
	<?php 
	} ?>
	</div>