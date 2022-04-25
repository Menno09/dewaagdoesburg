<?php
extract($arg);
wp_enqueue_style( 'redchili-flaticon' );
$catName = $term->name;

?>
<div class="food-menu1-area col-md-<?php echo esc_attr($grid) ." ". esc_attr($class); ?>">
	<div>
		<div class="food-menu1-box">
			<div class="food-menu-title">
				<h2><?php echo esc_html($catName); ?></h2>
				<span><i class="flaticon-technology"></i></span>
			</div>
			<ul>
			<?php
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();
					$id      = get_the_ID();
					$image   = FMP()->getFeatureImage( $id, $imgSize, $defaultImgId, $customImgSize );
					$excerpt = wp_trim_words( get_the_excerpt(), $excerpt_limit );;
					$price   = FMP()->fmpHtmlPrice( $id );
					?>			
				<li>
					<div class="media">					
						<?php if ( $link ) { ?>
							<a class="<?php echo esc_attr($anchorClass); ?> pull-left" href="<?php the_permalink() ?>"
							   data-id="<?php the_ID() ?>"><?php the_post_thumbnail( array(101,101), array( 'class' => 'fmp-feature-img' ) ); ?></a>
						<?php } ?>
						<div class="media-body">
							<div class="title-holder">
								<div class="card-menu-title">
									<?php if ( in_array( 'title', $items ) ): ?>
										<h3 class="fmp-title">
											<?php if ( $link ) { ?>
												<a class="<?php echo esc_attr($anchorClass); ?>"
												   href="<?php the_permalink() ?>"
												   data-id="<?php the_ID() ?>"><?php the_title(); ?></a>
											<?php } else {
												the_title();
											} ?>
										</h3>
									<?php endif; ?>
								</div>
								<div class="card-menu-price">
									<?php if ( in_array( 'price', $items ) ): ?>
										<?php echo wp_kses_post($price); ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="clear"></div>
							<?php if ( in_array( 'excerpt', $items ) ): ?>
								<p><?php echo esc_html($excerpt); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</li>						
			<?php
				endwhile;
			} else { ?>
				<p class="no-menu-card-3"><?php esc_html_e( 'No item found', 'food-menu-pro' );?></p>
			<?php }
			wp_reset_postdata();
			?>				
			</ul>
		</div>
	</div>
</div>