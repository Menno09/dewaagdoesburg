<?php
$price = FMP()->fmpHtmlPrice( $pID );
$img = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);
?>
<div class="<?php echo esc_attr($grid) . " " . esc_attr($class) . " " . esc_attr($isoFilter); ?> isotope-home-grid">
	<div class="isotope-home">
		<div class="media">
			<div class="pull-left">
				<?php if ( $link ) { ?>
					<a class="<?php echo esc_attr($anchorClass); ?> pull-left" href="<?php the_permalink() ?>"
					   data-id="<?php the_ID() ?>"><?php echo wp_kses_post($img); ?></a>
				<?php } ?>
				<span class="isotop-price">
				<?php if ( in_array( 'price', $items ) ): ?>
					<?php echo wp_kses_post($price); ?> 
				<?php endif; ?>
				</span>
			</div>
			<div class="media-body">			
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
				<?php if ( in_array( 'excerpt', $items ) ): ?>
					<p><?php echo $excerpt; ?><?php //$excerpt = wp_trim_words( get_the_excerpt(), 5 ); // @ parvez
					 echo esc_html($excerpt); ?></p>
					
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>