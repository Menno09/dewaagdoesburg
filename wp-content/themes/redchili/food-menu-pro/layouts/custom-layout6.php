<?php $price = FMP()->fmpHtmlPrice( $pID );
$img = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);
?>
<div class="<?php echo esc_attr($grid) . " " . esc_attr($class); ?>">
	<div class="fmp-layout2 fmp-box-wrapper">
		<div class="fmp-box">
			<div class="media">
				<?php if ( $link ) { ?>
					<a class="pull-left <?php echo esc_attr($anchorClass); ?>" href="<?php echo esc_url($pLink) ?>" data-id="<?php echo absint($pID) ?>">
				<?php } echo $img; ?></a> 
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
		</div>
	</div>
</div>