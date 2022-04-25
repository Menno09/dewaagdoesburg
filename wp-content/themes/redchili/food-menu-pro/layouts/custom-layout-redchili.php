<?php
$price = FMP()->fmpHtmlPrice( $pID );
?>
<div class="food-menu3-area">
	<div class="<?php echo esc_attr($grid) . " " . esc_attr($class); ?>">
		<div class="fm-title-content">
			<h3 class="title-bar-medium-left">
			<?php if ( $link ) { ?>
				<a class="<?php echo esc_attr($anchorClass); ?>" href="<?php echo esc_url( $pLink ) ?>"
				   data-id="<?php echo absint( $pID ); ?>"><?php echo esc_html( $title ); ?></a>
			<?php } else {
				echo esc_html( $title );
			} ?>
			</h3>
		</div>
		<div class="food-menu3-box">
			<div class="food-menu3-box-content">				
				<div class="food-menu3-box-img">
					<?php if ( $link ) { ?>
						<a href="<?php the_permalink(); ?>" class="">					
							<?php the_post_thumbnail( 'rdtheme-size6', array( 'class' => 'fmp-feature-img' ) ); ?>
						</a>
					<?php } ?>		
					<div class="food-menu-price">
						<?php if ( in_array( 'price', $items ) ): ?>
							<span class="fmp-price"><?php echo wp_kses_post($price);?></span>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( in_array( 'excerpt', $items ) ): ?>
					<p><?php echo esc_html($excerpt); ?>...</p>
				<?php endif; ?>				
			</div>
		</div>
	</div>
</div>