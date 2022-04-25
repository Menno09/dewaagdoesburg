<?php
$price = FMP()->fmpHtmlPrice( $pID );
$image = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);
?>
<div class="<?php echo esc_attr($grid) . " " . esc_attr($class); ?> menu-item food-menu4-area">
	<div class="food-menu4-box">
		<?php echo wp_kses_post($image); ?> 
		<span><span class="fmp-price"><?php echo wp_kses_post($price); ?></span></span>
		<div class="food-menu4-box-title">
			<h3>
				<?php if ( $link ) { ?>
				<a class="<?php echo esc_attr($anchorClass); ?>" href="<?php echo esc_url($pLink); ?>"
				   data-id="<?php echo esc_attr($pID); ?>"><?php echo esc_attr($title); ?></a>
				<?php } else {
					echo esc_html($title);
				} ?>
			</h3>
			<?php if ( in_array( 'excerpt', $items ) ): ?>
				<p><?php echo esc_html($excerpt); ?></p>
			<?php endif; ?>
			<?php if ( in_array( 'read_more', $items ) && $link): ?>
				<a href="<?php the_permalink(); ?>" class="default-btn fmp-btn-read-more"><?php echo esc_attr($read_more); ?></a>
			<?php endif; ?> 
		</div>
	</div>
</div> 
