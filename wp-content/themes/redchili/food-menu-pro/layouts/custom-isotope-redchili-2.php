<?php
$price = FMP()->fmpHtmlPrice( $pID );
$img = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);
?>
<div class="<?php echo esc_attr($grid) . " " . esc_attr($class) . " " . esc_attr($isoFilter); ?>">
	<div class="food-menu2-area">
		<div class="food-menu2-box">
			<div class="food-menu2-img-holder">
				<div class="food-menu2-more-holder">
					<?php if ( $link ) { ?>
					<ul>
						<li><a href="<?php the_permalink();?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
					</ul>
					<?php } ?>
				</div>
				<a href="<?php if ( $link ) { the_permalink(); } else { echo '#'; } ?>">
					<?php if ( in_array( 'image', $items ) ){ ?>
						<?php echo wp_kses_post($img); ?>
					<?php } ?>	
				</a>
			</div>
			<div class="food-menu2-title-holder">
				<div class="isotop-price-2">		
					<?php if ( in_array( 'price', $items ) ){?>
						<?php echo wp_kses_post($price);?>
					<?php } ?>
				</div>
				<h3>
					<?php if ( $link ) { ?>
						<a class="<?php echo esc_attr($anchorClass); ?>"
						   href="<?php the_permalink() ?>"
						   data-id="<?php the_ID() ?>"><?php the_title(); ?></a>
					<?php } else {
						the_title();
					} ?> 
				</h3> 
				<?php if ( in_array( 'excerpt', $items ) ): ?>
					<?php echo $excerpt;?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>