<?php
$thumb_size = 'rdtheme-size6';
$custom_class = vc_shortcode_custom_css_class( $css );
if ( $imagestyle == 'circle') {
	$image_class = 'img-circle';
} else {
	$image_class = 'imgsquare';
}
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
);
if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}
if ( $showfeatured == 'true' ) {
	$args['tax_query'] = array(
		array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN',
		)
	);
}

$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
?>
<div class="wfmc-area">
	<div class="owl-wrap rt-owl-nav-2 rt-owl-dot-1 <?php echo esc_attr( $slider_nav_class );?>">
		<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
			<?php if ( $query->have_posts() ) :?>
				<?php while ( $query->have_posts() ) : $query->the_post();?>
					<?php
						$id = get_the_ID();
						$content = get_the_content();
						$content = apply_filters( 'the_content', $content );
						$content = wp_trim_words( $content, $count );
						$thumbnail = false;
						if ( has_post_thumbnail() ){
							$thumbnail = get_the_post_thumbnail( null , $thumb_size );
						}
						else {
							if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
								$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
							}
							elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
								$thumbnail = '<img class="attachment-rdtheme-size5 size-rdtheme-size5 wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_370x522.jpg" alt="'.get_the_title().'">';
							}
						}
						global $product;
						global $woocommerce;
						$currency = get_woocommerce_currency_symbol();
						$price = get_post_meta( get_the_ID(), '_regular_price', true);
						$sale = get_post_meta( get_the_ID(), '_sale_price', true);
					?>
					<div class="wfmc-layout-1 <?php echo esc_attr( $image_class ); ?>">
						<div class="fmp-box">
							<?php
							switch ( $product->get_type() ) {								
								case "variable" : ?>
									<span class="fmp-price woocommerce-Price-amount amount"><?php echo show_variable_price( get_the_ID() ); ?></span>
									<?php
								break;
								
								default : ?>
									<span class="fmp-price woocommerce-Price-amount amount">
									<?php if($sale) : ?>
									<span class="product-price-tickr"><del><?php echo esc_html ( $currency ); echo esc_html ( $price ); ?></del> <?php echo esc_html ( $currency ); echo esc_html ( $sale ); ?></span>
									<?php elseif($price) : ?>
									<span class="product-price-tickr"><?php echo esc_html ( $currency ); echo esc_html ( $price ); ?></span>    
									<?php endif; ?>
									</span>
							<?php break; } ?>
							<div class="image-style <?php echo esc_attr( $image_class ); ?>">	
							<?php if ( $showimage == 'true' ) { ?>
							<?php echo wp_kses_post( $thumbnail ); ?>
							<?php } ?>
							</div>
							<div class="wfmc-info-1">
								<div class="wfmc-title" data-titlecolor="<?php echo esc_attr ( $title_color ); ?>" data-titlehover="<?php echo esc_attr ( $title_color_hover ); ?>">
									<h3 class="title-small title-bar-small-center"><a style="color:<?php echo esc_attr ($title_color); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p style="color:<?php echo esc_attr ($content_color); ?>"><?php echo wp_kses_post( $content ); ?></p>
									<div class="buttons">
									<?php if ( $showcart == 'true' ) { ?>
									<?php if ( ! $product->is_in_stock() ) { ?>
									<?php
										// define the woocommerce_variable_add_to_cart callback 
										function action_woocommerce_variable_add_to_cart_4( $woocommerce_variable_add_to_cart, $int ) { 
											// make action magic happen here... 
											
											global $product;
											wp_enqueue_script( 'wc-add-to-cart-variation' );

											// Load the template
											woocommerce_get_template( 'single-product/add-to-cart/variable.php', array(
												'available_variations'  => $product->get_available_variations(),
												'attributes'            => $product->get_variation_attributes(),
												'selected_attributes'   => $product->get_variation_default_attributes()
											) );
										};
										
										// add the action 
										add_action( 'woocommerce_variable_add_to_cart', 'action_woocommerce_variable_add_to_cart_4', 10, 2 );
									?>
									<a href="<?php echo get_permalink($product->get_id()); ?>" class="button"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Read More', 'redchili-core')); ?></a>
									<?php } else { ?>
									<?php
										switch ( $product->get_type() ) {
											case "variable" :
												$link   = get_permalink($product->get_id());
												$label  = apply_filters('variable_add_to_cart_text', __('Select options', 'redchili-core'));
												 ?>												
										<?php break;
											case "grouped" :
												$link   = get_permalink($product->get_id());
												$label  = apply_filters('grouped_add_to_cart_text', __('View options', 'redchili-core'));
											break;
											case "external" :
												$link   = get_permalink($product->get_id());
												$label  = apply_filters('external_add_to_cart_text', __('Read More', 'redchili-core'));
											break;
											default :
												$link   = esc_url( $product->add_to_cart_url() );
												$label  = apply_filters('add_to_cart_text', __('Add to cart', 'redchili-core'));
											break;
										}
										if ( $product->get_type() == 'simple' ) {
											?>
											<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

												<?php woocommerce_quantity_input(); ?>

												<button style="color:<?php echo esc_attr( $button_color ); ?>" type="submit" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
													class="button alt ajax_add_to_cart add_to_cart_button product_type_simple">
													<?php echo esc_html ( $label ); ?>
												</button>
											</form>
											<?php
										} else { ?>
										<a href="<?php the_permalink(); ?>" style="color:<?php echo esc_attr( $button_color ); ?>" type="button"
													class="button alt ajax_add_to_cart add_to_cart_button product_type_simple">
													<?php echo esc_html ( $label ); ?></a>
									<?php }	?>
									<?php } ?>
									<?php } else { ?>
									<a style="color:<?php echo esc_attr( $button_color ); ?>" href="<?php the_permalink(); ?>" class="ghost-semi-color-btn  fmp-btn-read-more"><?php esc_html_e( 'Read More' , 'redchili-core' ); ?></a>
									<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile;?>
			<?php endif;?>
			<?php wp_reset_query();?>
		</div>
	</div>
</div>