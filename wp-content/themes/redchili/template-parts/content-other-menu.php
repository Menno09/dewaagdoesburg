<?php
global $post;
$current_post = get_the_ID();

if ( RDTheme::$layout == 'full-width' ) {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'480'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 3 ),
		'992'  => array( 'items' => 4 ),
		);
}
else {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'480'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 2 ),
		'992'  => array( 'items' => 3 ),
		);
}

$owl_data = array( 
	'nav'                => false,
	'dots'               => false,
	'autoplay'           => true,
	'autoplayTimeout'    => '5000',
	'autoplaySpeed'      => '200',
	'autoplayHoverPause' => true,
	'loop'               => true,
	'margin'             => 30,
	'responsive'         => $responsive
	);

$owl_data = json_encode( $owl_data );

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_style( 'owl-theme-default' );
wp_enqueue_script( 'owl-carousel' );
?>
<?php
$query = new WP_Query( array( 'post_type' => 'food-menu', 'post__not_in' => array( $current_post ) ) );
if ( $query->have_posts() ) { ?>
	<div class="owl-wrap rt-owl-nav-3 related-products other-menu">
		<h2 class="inner-sub-title title-bar-big-left-close"><?php esc_html_e( 'You may Also like', 'redchili' );?></h2>
		<div class="owl-custom-nav">
			<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
		</div>
		<div class="owl-custom-nav-bar"></div>
		<div class="clear"></div>
		<div class="rt-owl-carousel owl-carousel owl-theme" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
			<?php
			while ( $query->have_posts() ) { 
				$query->the_post(); ?>
				<div class="food-menu2-box">
					<div class="food-menu2-img-holder">
						<div class="food-menu2-more-holder">
							<ul>
								<li><a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'rdtheme-size7', array( 'class' => 'img-responsive' ) ); ?>
						</a>
					</div>
					<div class="food-menu2-title-holder">
						<span>
							<?php $gTotal = FMP()->fmpHtmlPrice(); ?>
							<div class="offers"><?php echo wp_kses_post($gTotal); ?></div>
						</span>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
				</div>			
			<?php } ?>	
		</div>
	</div>
<?php } wp_reset_postdata();?>