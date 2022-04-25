<?php
$thumb_size = 'thumbnail';
$count=1;
$args = array(
	'post_type'      => 'rc_testimonial',
	'posts_per_page' => $slider_item_number,
	);
$query = new WP_Query( $args );

$title_color_style = $title_color ? "color:{$title_color}" : '' ;
?>
<div class="client-reviews-area">
	<div class="client-reviews-right">
	<?php if(!empty($title)){ ?>
		<h2 style="<?php echo esc_attr( $title_color_style );?>">
			<?php echo esc_html( $title );?>		
		</h2>
	<?php } ?>
	<?php if(!empty($subtitle)){ ?>
	<p style="color:<?php echo esc_attr( $subtitle_color );?>;"><?php echo wp_kses_post( $subtitle );?></p>	<?php } ?>	
		<div class="rt-owl-testimonial-half rt-owl-carousel owl-carousel owl-theme" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
			<ul>
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$id = get_the_ID();
				$content = get_the_content();
				$rc_testimonial_rating = get_post_meta( $id, 'rc_testimonial_rating', true );
				
				$rc_testimonial_designation = get_post_meta( $id, 'rc_testimonial_designation', true );
				$rest_testimonial_rating = 5-$rc_testimonial_rating ;
			?>
			<li>
				<div class="media">
					<a href="<?php the_permalink(); ?>" class="pull-left">
						<?php the_post_thumbnail( $thumb_size ,  array( 'class' => 'img-responsive img-circle' )  );?>
					</a>
					<div class="media-body">
						<h3 style="color:<?php echo esc_attr($testi_title_color); ?>"><?php the_title(); ?></h3>
						<?php if(!empty($rc_testimonial_designation)){ ?><div class="designation" style="color:<?php echo esc_attr($testi_designation_color); ?>"><?php echo esc_html( $rc_testimonial_designation );?></div><?php } ?>
						
						<?php if($display_rating == 'enable' || $display_rating == 'true'){ ?>
							<ul class="rating">
								<?php for ($i=0; $i < $rc_testimonial_rating; $i++) { ?>
									<li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
								<?php } ?>			
								<?php for ($i=0; $i < $rest_testimonial_rating; $i++) { ?>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								<?php } ?>
							</ul>
						<?php } ?>
						<p style="color:<?php echo esc_attr($testi_text_color); ?>"><?php echo esc_html($content); ?></p>
					</div>
				</div>
			</li>
			<?php 
			if (($count % 2) == 0){ ?>
				</ul> 
				<?php  if ( $query->current_post + 1 < $query->post_count ) {  ?>
				<ul>
			<?php }
				}  
			 $count++; ?>					
			<?php endwhile;?>
			<?php endif;?>
			<?php wp_reset_query();?>					
		</div>
	</div>
</div>