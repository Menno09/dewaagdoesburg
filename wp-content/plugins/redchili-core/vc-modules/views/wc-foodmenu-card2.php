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
$count = 1;
if ( $cat != 0 ) {
	$termObject = get_term_by( 'id', absint( $cat ), 'product_cat' );
	$termName = $termObject->name;
} else {
	$termName = 'Please Select a category';
}

global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;

?>
<div class="wfmc-layout-4 even-grid-item fmp-grid-item">
	<div class="fmp-cat2 fmp-box-wrapper">	
		<span class="top-pattern"></span>
		<span class="bottom-pattern"></span>
		<div class="fmp-cat-title">
			<h2><?php echo esc_html( $termName ); ?></h2>
		</div>
		<div class="fmp-box">
			<ul class="menu-list">			
			<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post();			
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, 40 );
				global $product;
				global $woocommerce;
				$currency = get_woocommerce_currency_symbol();
				$price = get_post_meta( get_the_ID(), '_regular_price', true);
				$sale = get_post_meta( get_the_ID(), '_sale_price', true);
				
			?>
				<li class="<?php if ( $count == $slider_item_number ) { ?> no-border <?php } ?>">
				    <div class="row">					
					<div class="content-holder col-lg-7 col-md-8 col-sm-8 col-xs-12">
						<div class="card-menu-title">
							<h3 class="fmp-title">
								<a class="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</div>
						<p><?php echo wp_kses_post ( $content ); ?></p>
					</div>					
					<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">					
						<div class="card-menu-price">
						<?php
						switch ( $product->get_type() ) {
							case "variable" : 
								echo show_variable_price( get_the_ID() );
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
						</div>
						<div class="buttons">
						<?php if ( $showcart == 'true' ) { ?>
						<?php if ( ! $product->is_in_stock() ) { ?>
						<?php
							// define the woocommerce_variable_add_to_cart callback 
							function action_woocommerce_variable_add_to_cart_2( $woocommerce_variable_add_to_cart, $int ) { 
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
							add_action( 'woocommerce_variable_add_to_cart', 'action_woocommerce_variable_add_to_cart_2', 10, 2 );
						?>
						<a href="<?php echo get_permalink($product->get_id()); ?>" class="button"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Read More', 'redchili-core')); ?></a>
						<?php } else { ?>
						<?php
							switch ( $product->get_type() ) {
								case "variable" :
									$link   = get_permalink($product->get_id());
									?>
									
									<button type="button" class="btn add_to_cart_button isotope-variable" data-toggle="modal" data-target="#<?php the_ID(); ?>-card2"><?php esc_html_e( 'Select Option' , 'redchili-core' ); ?></button>											
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
								<button type="submit" data-quantity="1" data-product_id="<?php echo esc_html ( $product->get_id() ); ?>"
										class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><?php echo esc_html ( $label); ?></button>
								<?php woocommerce_quantity_input(); ?>
								</form>
								<?php
							} else {
								$label  = apply_filters('add_to_cart_text', __('Add to cart', 'redchili-core'));
								printf('<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', $link, $product->get_id(), $product->get_type(), $label);
							}
						?>
						<?php } ?>
						<?php } else { ?>
						<a href="" class="ghost-semi-color-btn  fmp-btn-read-more"><?php esc_html_e( 'Read More' , 'redchili-core' ); ?></a>
						<?php } ?>
						</div>					
					</div></div>
				</li>
			<?php if ( $product->get_type() == 'variable' ) {
					$link = get_permalink($product->get_id());
				?>
				<div style="z-index:9" id="<?php the_ID(); ?>-card2" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><?php the_title(); ?></h4>
							</div>
							<div class="modal-body">
								<div><?php the_excerpt(); ?></div>
								<?php $label  = woocommerce_variable_add_to_cart(); ?>
							</div>
							<div class="clear"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal"><?php esc_html_e( 'Close' , 'redchili-core' ); ?></button>
							</div>
						</div>
					</div>
				</div>						
				<?php } ?>
				<?php $count++; endwhile;?>
				<?php if ( $showpagination == 'true' ) { ?>
				<div class="col-sm-12 col-xs-12"><?php rt_vc_pagination();?></div>
				<?php } ?>
			<?php wp_reset_query();?>
			<?php } else { ?>
				<div class="<?php echo esc_attr( $col_class ); ?>">
					<?php esc_html_e( 'No Food Menu Found' , 'redchili-core' ); ?>
				</div>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>