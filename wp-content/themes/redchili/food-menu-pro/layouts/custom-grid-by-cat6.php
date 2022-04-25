<?php
extract($arg);$catName ='';
?>
<div class="col-md-<?php echo esc_attr($grid) ." ". esc_attr($class); ?> ">	
	<h2 class="inner-sub-title title-bar-full-width"><?php echo esc_html($catName); ?></h2>	
	<ul>
		<?php
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();
					$id      = get_the_ID();
					$image   = FMP()->getFeatureImage( $id, $imgSize, $defaultImgId, $customImgSize );
					$excerpt = wp_trim_words( get_the_excerpt(), $excerpt_limit ); // @ parvez
					$price   = FMP()->fmpHtmlPrice( $id );
		?>		
		<li>
			<div class="media">
				<a href="<?php the_permalink() ?>" class="pull-left">
					<?php the_post_thumbnail( array(101,101), array( 'class' => 'fmp-feature-img' ) ); ?>
				</a>
				<div class="media-body">
					<div class="title-holder">
						<div class="card-menu-title">
							<?php if(in_array('title', $items)): ?>
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<?php endif; ?>
						</div>
						<div class="card-menu-price">
							<?php if(in_array('price', $items)): ?>
							<span><?php echo wp_kses_post($price); ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="clear"></div>
					<?php if(in_array('excerpt', $items)): ?>
					<p><?php echo esc_html($excerpt); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</li>					
		<?php
				endwhile;
			} else { ?>
				<p><?php esc_html_e( 'No item found', 'food-menu-pro' );?></p>
		<?php }
			wp_reset_postdata();
		?>
	</ul>
</div>