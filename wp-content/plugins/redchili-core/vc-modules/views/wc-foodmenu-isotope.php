<?php
$thumb_size = 'rdtheme-size7';
$custom_class = vc_shortcode_custom_css_class( $css );
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

$posts = get_posts( $args );

$gallery = array();
$cats    = array();

foreach ( $posts as $post ) {
    $terms = get_the_terms( $post, 'product_cat' );
    $terms_html = '';
	
	if ( $terms ) {
		foreach ( $terms as $term ) {
			$terms_html .= ' ' . $term->slug;
			if ( !isset( $cats[$term->slug] ) ) {
				$cats[$term->slug] = $term->name;
			}
		}
	}
	$gallery[] = array(
		'cats'  => $terms_html,
	);
}
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_mobile";

?>
<div class="fmp-layout-custom-isotope-redchili-core-2 fmp-even" id="inner-isotope">
	<div class="fmp-iso-filter">
		<div class="fmp-isotope-buttons button-group filter-button-group option-set rt-food-menu-tab">		
			<?php /*<button data-filter="*" class="current"><?php esc_html_e( 'Show all' , 'redchili-core' ); ?></button> */ ?>
			<?php foreach ( $cats as $key => $value): ?>
				<button data-filter=".<?php echo esc_attr( $key );?>" class=""><?php echo esc_html( $value );?></button>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="row auto-clear rt-isotope1 featuredContainer">
		<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();			
			$id = get_the_ID();
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, $count );
			$thumbnail = '';
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( null, $thumb_size , array( 'class' => 'img-responsive' ) );
			}
			
			global $product;
			global $woocommerce;
			$currency = get_woocommerce_currency_symbol();
			$price = get_post_meta( get_the_ID(), '_regular_price', true);
			$sale = get_post_meta( get_the_ID(), '_sale_price', true);
			
			$terms = get_the_terms( get_the_ID(), 'product_cat' );
		?>
		<?php
			if ( $terms && ! is_wp_error( $terms ) ) : 
				$term_links = array(); 
				foreach ( $terms as $term ) {
					$term_links[] = $term->slug;
				}
				$term_list = join( " ", $term_links );
			endif;
		?>	
		<div class="<?php echo esc_attr( $col_class );?> <?php if ( !empty( $term_list ) ) { echo esc_html( $term_list ); } ?> fmp-isotope" >
			<div class="food-menu2-area" data-url="<?php echo site_url(); ?>">
				<div class="food-menu2-box">
					<div class="food-menu2-img-holder">
						<div class="food-menu2-more-holder">
							<ul>
								<li>
									<a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
								</li>
							</ul>
						</div>
						<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
					</div>
					<div class="food-menu2-title-holder">
						<div class="isotop-price-2">
						<?php
						switch ( $product->get_type() ) {
							case "variable" : 
								echo show_variable_price( get_the_ID() );
							break; 					
							default : ?>								
								<span class="fmp-price">
								<?php if($sale) : ?>
								<span class="product-price-tickr"><del><?php echo esc_html( $currency ); echo esc_html ( $price ); ?></del> <?php echo esc_html ( $currency ); echo esc_html ( $sale ); ?></span>
								<?php elseif($price) : ?>
								<span class="product-price-tickr"><?php echo esc_html ( $currency ); echo esc_html ( $price ); ?></span>    
								<?php endif; ?>
								</span>
						<?php break; 
						} ?>
						</div>
						<h3><a class="fmp-popup" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
				</div>
				<div class="buttons">
				<?php if ( $showcart == 'true' ) { ?>
				<?php if ( ! $product->is_in_stock() ) { ?>
				<?php
				// define the woocommerce_variable_add_to_cart callback 
				function action_woocommerce_variable_add_to_cart_3( $woocommerce_variable_add_to_cart, $int ) { 
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
				add_action( 'woocommerce_variable_add_to_cart', 'action_woocommerce_variable_add_to_cart_3', 10, 2 );
				?>
				<a href="<?php echo get_permalink($product->get_id()); ?>" class="button"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Read More', 'redchili-core')); ?></a>
				<?php } else { ?>
				<?php
					switch ( $product->get_type() ) {
						case "variable" :
							$link   = get_permalink($product->get_id());							
							 ?>
							<button type="button" class="btn add_to_cart_button btn-lg isotope-variable" data-toggle="modal" data-target="#<?php the_ID(); ?>-isotop"><?php esc_html_e( 'Select Option' , 'redchili-core' ); ?></button>
							<div style="z-index:9" id="<?php the_ID(); ?>-isotop" class="modal fade" role="dialog">
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

							<button type="submit" data-quantity="1" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
								class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><?php echo esc_attr ( $label ); ?></button>

						</form>
						<?php
					} else {
						printf('<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', $link, $product->get_id(), $product->get_type(), $label);
					}
				?>
				<?php } ?>
				<?php } else { ?>
				<a href="<?php echo get_permalink( $product->get_id() ); ?>" class="ghost-semi-color-btn  fmp-btn-read-more"><?php esc_html_e( 'Read More' , 'redchili-core' ); ?></a>
				<?php } ?>
				</div>
			</div>
		</div>
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