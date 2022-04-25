<?php
$thumb_size = 'rdtheme-size6';

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$custom_class = vc_shortcode_custom_css_class( $css );

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
	'paged'          => $paged,
	'post_status'    => 'publish'
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

global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;

$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";
?>
<!-- this is start -->
<div class="wfmc-layout-3 fmp-container-fluid fmp-wrapper fmp">
	<div class="row fmp-layout-custom-layout6 fmp-even" data-url="<?php echo esc_url( site_url() ); ?>">
		<div class="even-grid-item fmp-grid-item fmp-img-circle">
			<div class="fmp-layout2 fmp-box-wrapper">
				<?php if ( $query->have_posts() ) { ?>
				<?php while ( $query->have_posts() ) : $query->the_post();
					$id = get_the_ID();
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = wp_trim_words( $content, $count );
					$thumbnail = false;
					if ( has_post_thumbnail() ){
						$thumbnail = get_the_post_thumbnail( null, $thumb_size , array( 'class' => 'img-responsive' ) );
					}
					else {
						if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
							$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
						}
						elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
							$thumbnail = '<img class="attachment-rdtheme-size5 size-rdtheme-size5 wp-post-image" src="'.RDTHEME_IMG_URL.'noimage.jpg" alt="'.get_the_title().'">';
						}
					}
					
					global $product;
					global $woocommerce;
					$currency = get_woocommerce_currency_symbol();
					$price = get_post_meta( get_the_ID(), '_regular_price', true);
					$sale = get_post_meta( get_the_ID(), '_sale_price', true);
					
					$terms = get_the_terms( get_the_ID(), 'product_cat' );
					
					if ( $showimage == 'false' && $content == '' ) {
						$box_class = 'no-img-con';
					} else {
						$box_class = '';
					}					
				?>
				<div class="fmp-box <?php echo esc_attr ( $box_class ); ?>">
					<div class="media">
						<?php if ( $showimage == 'true' ) { ?>
							<?php if( $showlink == 'true' ){ ?>
							<a class="pull-left" href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
							<?php } else { ?>
							<?php echo wp_kses_post( $thumbnail ); ?>
							<?php } ?>
						<?php } ?>
						<div class="media-body"><div class="container">
							<div class="row">
							<div class="col-lg-7 col-md-6 <?php if ( ! $product->is_in_stock() ) { ?>out-of-stock-header<?php } ?> <?php if ($product->get_type() == 'variable') { ?>col-sm-4 variable-title<?php } else { ?>col-sm-8<?php } ?> col-xs-12 text-part">
								<div class="title-holder">
									<div class="card-menu-title">
										<?php if( $showlink == 'true' ) { ?>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php } else { ?>
										<h3><?php the_title(); ?></h3>
										<?php } ?>
									</div>
								</div>
								<div class="clear"></div>
								<?php if ( !empty( $content ) ) { ?>
								<p><?php echo wp_kses_post( $content ); ?></p>
								<?php } ?>
							</div>
							<div class="col-lg-5 col-md-6 <?php if ($product->get_type() == 'variable') { ?>col-sm-8 variable-content<?php } else { ?>col-sm-4<?php } ?> col-xs-12 no-pad button-part">
								<div class="buttons">
									<div class="rt-menu-price hidden-lg visible-sm-block visible-xs-block">
									<?php
									switch ( $product->get_type() ) {
										case "variable" :										
										break;
										default : ?>
											<span class="fmp-price woocommerce-Price-amount amount">
											<?php if($sale) : ?>
											<span class="product-price-tickr"><del><?php echo esc_html( $currency ); echo esc_html( $price ); ?></del> <?php echo esc_html( $currency ); echo esc_html( $sale); ?></span>
											<?php elseif( $price ) : ?>
											<span class="product-price-tickr"><?php echo esc_html( $currency ); echo esc_html( $price ); ?></span>    
											<?php endif; ?>
											</span>
									<?php break; } ?>
									</div>
									<div class="rt-add-to-cart <?php if ($product->get_type() == 'variable') { ?>variable<?php } ?>">
									<?php if ( $showcart == 'true' ) { ?>
									<?php if ( ! $product->is_in_stock() ) { ?>
									<?php
										// define the woocommerce_variable_add_to_cart callback 
										function action_woocommerce_variable_add_to_cart( $woocommerce_variable_add_to_cart, $int ) { 
											// make action magic happen here... 
											
											global $product;

											// Enqueue variation scripts
											wp_enqueue_script( 'wc-add-to-cart-variation' );

											// Load the template
											woocommerce_get_template( 'single-product/add-to-cart/variable.php', array(
												'available_variations'  => $product->get_available_variations(),
												'attributes'            => $product->get_variation_attributes(),
												'selected_attributes'   => $product->get_variation_default_attributes()
											) );
											
										};
												 
										// add the action 
										add_action( 'woocommerce_variable_add_to_cart', 'action_woocommerce_variable_add_to_cart', 10, 2 );
										
										/*function woocommerce_variable_add_to_cart() {
											global $product;

											// Enqueue variation scripts
											wp_enqueue_script( 'wc-add-to-cart-variation' );

											// Load the template
											woocommerce_get_template( 'single-product/add-to-cart/variable.php', array(
												'available_variations'  => $product->get_available_variations(),
												'attributes'            => $product->get_variation_attributes(),
												'selected_attributes'   => $product->get_variation_default_attributes()
											) );
										}*/
									?>
									<a href="<?php echo get_permalink($product->get_id()); ?>" class="button"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Out of Stock', 'redchili-core')); ?></a>
									<?php } else { ?>
									
									<?php
										switch ( $product->get_type() ) {
											case "variable" : 
																						
											$link = get_permalink($product->get_id());
											global $product, $post;
											$variations = $product->get_available_variations();
											
											foreach ($variations as $key => $value) {												
											$variation_id = $value['variation_id'];
												
											$variable_product = wc_get_product($variation_id);

											$price = $variable_product->get_price();
												 
										?>
										<div class="rt-variable-price-box ">
										<?php
										foreach ($value['attributes'] as $attr_key => $attr_value) {
										echo '<div class="rt-variation-name">' . esc_html( $attr_value ) . '</div>';
										}
										?>
											<div class="rt-menu-price">
												<span class="fmp-price woocommerce-Price-amount amount">
												<?php if( $sale ) : ?>
												<span class="product-price-tickr"><del><?php echo esc_html( $currency ); echo esc_html( $price ); ?></del> <?php echo esc_html( $currency ); echo esc_html( $sale ); ?></span>
												<?php elseif( $price ) : ?>
												<span class="product-price-tickr"><?php echo esc_html( $currency ); echo esc_html( $price ); ?></span>    
												<?php endif; ?>
												</span>
											</div>
											<?php woocommerce_quantity_input(); ?>
											<a class="button alt ajax_add_to_cart add_to_cart_button product_type_simple" data-product-id="<?php echo esc_attr ( $product->get_id()); ?>" data-variation-id="<?php echo esc_attr( $variation_id ); ?>" data-attribute-name="<?php echo esc_attr( $attr_key ); ?>" data-attribute-value="<?php echo esc_attr( $attr_value ); ?>"><?php esc_html_e( 'Add To Cart' , 'redchili-core' ); ?></a>
										</div>
										<?php } ?>
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
										} ?>	
									<?php if ( $product->get_type() == 'simple' ) {
											?>
											<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

												<?php woocommerce_quantity_input(); ?>

												<button type="submit" data-quantity="1" data-product_id="<?php echo esc_attr( $product->get_id()) ; ?>"
													class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><?php echo esc_html ( $label ); ?></button>

											</form>
											<?php
										} 
									?>
									<?php } ?>
									<?php } else { ?>
									<a href="" class="ghost-semi-color-btn  fmp-btn-read-more"><?php esc_html_e( 'Read More' , 'redchili-core' ); ?></a>
									<?php } ?>
									</div>
									<?php if ( $product->get_type() != 'variable' ) { ?>
									<div class="rt-menu-price hidden-xs hidden-sm visible-md-block visible-lg-block">
									<?php
									switch ( $product->get_type() ) {
										case "variable" :
										break;
										default : ?>
											<span class="fmp-price woocommerce-Price-amount amount">
											<?php if($sale) : ?>
											<span class="product-price-tickr"><del><?php echo esc_html( $currency ); echo esc_html ( $price ); ?></del> <?php echo esc_html ( $currency ); echo esc_html ( $sale ); ?></span>
											<?php elseif($price) : ?>
											<span class="product-price-tickr"><?php echo esc_html ( $currency ); echo esc_html ( $price ); ?></span>    
											<?php endif; ?>
											</span>
									<?php break; } ?>
									</div>
									<?php } ?>
								</div>
							</div></div></div>
						</div>
					</div>
				</div>
			<?php
				if ( $product->get_type() == 'variable' ) {
					$link = get_permalink($product->get_id());
					?>
					<div style="z-index:9" id="<?php the_ID(); ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><?php the_title(); ?></h4>
								</div>
								<div class="modal-body">
									<div><?php the_excerpt(); ?></div>
									<?php $label = woocommerce_variable_add_to_cart(); ?>
								</div>
								<div class="clear"></div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><?php esc_html_e( 'Close' , 'redchili-core' ); ?></button>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php endwhile;?>
				<?php if ( $showpagination == 'true' ) { ?>
				<div class="col-sm-12 col-xs-12"><?php rt_vc_pagination();?></div>
				<?php } ?>
			<?php wp_reset_query();?>
			<?php } else { ?>
				<div class="<?php echo esc_attr( $col_class ); ?>">
					<?php esc_html_e( 'No Food Menu Found' , 'redchili-core' ); ?>
				</div>
			<?php } ?>				
			</div>
		</div>
	</div>
</div>