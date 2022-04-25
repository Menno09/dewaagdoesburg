<?php
global $post;
$current_post = get_the_ID();
$thumb_size = 'rdtheme-size5';
$responsive = array(
	'0'    => array( 'items' => 1 ),
	'480'  => array( 'items' => 2 ),
	'768'  => array( 'items' => 2 ),
	'992'  => array( 'items' => 3 ),
);
$owl_data = array( 
	'nav'                => false,
	'dots'               => false,
	'autoplay'           => true,
	'autoplayTimeout'    => '5000',
	'autoplaySpeed'      => '200',
	'autoplayHoverPause' => true,
	'loop'               => true,
	'margin'             => 20,
	'responsive'         => $responsive
	);
$owl_data = json_encode( $owl_data );

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_style( 'owl-theme-default' );
wp_enqueue_script( 'owl-carousel' );

$query = new WP_Query( array( 'post_type' => 'rc_chef', 'post__not_in' => array( $current_post ) ) );
if ( $query->have_posts() ) {
?>
<div class="single-chef-bottom-area">
	<div class="container">
		<div class="owl-wrap rt-owl-nav-3 related products">
			<h2 class="owl-custom-nav-title title-bar-big-left-close"><?php esc_html_e( 'Other Chefs', 'redchili' );?></h2>
			<div class="owl-custom-nav">
				<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
			</div> 
			<div class="owl-custom-nav-bar"></div>
			<div class="clear"></div>
			<div class="rt-owl-carousel owl-carousel owl-theme" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
				<?php
				while ( $query->have_posts() ) { 
					$query->the_post();
					$rc_chef_designation  = get_post_meta( get_the_ID(), 'rc_chef_designation', true );
					$rc_chef_skill		  = get_post_meta( get_the_ID(), 'rc_chef_skill', true );
					$redchili_chef_social = get_post_meta( get_the_ID(), 'redchili_chef_social', true );
					$thumbnail = false;
					if ( has_post_thumbnail() ){
						$thumbnail = get_the_post_thumbnail( null, $thumb_size );
					}
					else {
						if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
							$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
						}
						elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
							$thumbnail = '<img class="img-responsive wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_370x522.jpg" alt="'.get_the_title().'">';
						}
					}
				?>
					<div class="chef-box">
							<a href="<?php the_permalink(); ?>">
								<?php echo wp_kses_post($thumbnail); ?>
							</a>						
						<div class="chef-box-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( !empty($rc_chef_designation) ){ ?>
							<p><?php echo esc_html( $rc_chef_designation );?></p>
							<?php } ?>						
							<?php if ( !empty( $redchili_chef_social ) ){ ?>
							<div class="chef-social-wrap">
								<div class="chef-sep"></div>		
								<ul class="chef-social">
									<?php foreach ( $redchili_chef_social as $redchili_key => $redchili_social ): ?>
										<?php if ( !empty( $redchili_social ) ): ?>
											<li><a target="_blank" href="<?php echo esc_attr( $redchili_social );?>"><i class="fa <?php echo esc_attr( RDTheme::$redchili_chef_social[$redchili_key]['icon'] );?>"></i></a></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>								
							</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>			
			</div>
		</div>
	</div>
</div>
<?php } wp_reset_postdata();?>