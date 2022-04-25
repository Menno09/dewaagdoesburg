<?php
$thumb_size = 'rdtheme-size7';
$args = array(
	//'post_type' =>'post',
	'posts_per_page' => $number,
	'category'       => $cat,
	);
$query = new WP_Query( $args );
?>
<div class="recipe-of-the-day2-area post-vc">
	<?php
		if(!empty($background_image)){
			echo wp_get_attachment_image( $background_image, 'full', '', array( 'class' => 'img-responsive section-back' ) );
	 	}
	 ?>

<div class="owl-wrap rt-owl-nav-2 rt-owl-dot-1 rt-owl-class-2 slider-nav-enabled">	 
	 <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $count );
				?>
				<div class="content-box2">
				<?php  
				if ( has_post_thumbnail() ) { ?>
					<ul class="content-box2-social">
						<li><a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
					</ul>                               
					<div class="content-box2-img-holder">                                   
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $thumb_size ,  array( 'class' => 'img-responsive' )  );?>
						</a>
					</div>
				<?php } ?>
					
					<div class="content-box2-bottom-content-holder">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>						
						<ul>
							<li>
							<a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
							<span class="post-date"><?php echo get_the_date('j M, Y');?></span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>
								<span><?php comments_number( '0', '01', '% responses' ); ?></span></a>
							</li>
						</ul>
						<p><?php echo esc_html($content); ?></p> 
					</div>
				</div>
			<?php endwhile;?>
		<?php endif;?>
		<?php wp_reset_query();?>
	</div>
</div>
</div>