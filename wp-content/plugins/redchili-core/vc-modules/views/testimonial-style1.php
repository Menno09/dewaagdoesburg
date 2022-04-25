<?php
$thumb_size = 'thumbnail';
$args = array(
	'post_type'      => 'rc_testimonial',
	'posts_per_page' => $slider_item_number,
	);
	
$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
?>
<div class="client-area">	
	<div class="owl-wrap rt-owl-nav-2 rt-owl-testi-1 rt-owl-dot-1 <?php echo esc_attr( $slider_nav_class );?>">
		<div class="row">
			<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
			<?php if ( $query->have_posts() ) { ?>
				<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
					$id = get_the_ID();
					$content = get_the_content();
					$rc_testimonial_rating = get_post_meta( $id, 'rc_testimonial_rating', true );
					$rc_testimonial_designation = get_post_meta( $id, 'rc_testimonial_designation', true );
					$rest_testimonial_rating = 5-$rc_testimonial_rating ;				
				?>		
				<div class="client-box">
					<?php the_post_thumbnail( $thumb_size ,  array( 'class' => 'img-responsive' )  );?>
					<?php if ( $display_rating == 'enable' || $display_rating == 'true' ){  ?>
						<ul class="rating">
							<?php for ($i=0; $i < $rc_testimonial_rating; $i++) { ?>
								<li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
							<?php } ?>
							<?php for ($i=0; $i < $rest_testimonial_rating; $i++) {  ?>
								<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<?php } ?>
						</ul>
					<?php } ?>
					<p style="color:<?php echo esc_attr($testi_text_color); ?>"><?php echo esc_html($content); ?></p>
					<h3 class="title-bar-big-center" style="color:<?php echo esc_attr($testi_title_color); ?>"><?php the_title(); ?></h3>
					<?php if(!empty($rc_testimonial_designation)){ ?><p style="padding-top:15px; color:<?php echo esc_attr($testi_designation_color); ?>"><?php echo esc_html($rc_testimonial_designation); ?></p><?php } ?>
				</div>
					<?php endwhile;?>
				<?php } ?>
				<?php wp_reset_query();?>
			</div>
		</div>
	</div>
</div>