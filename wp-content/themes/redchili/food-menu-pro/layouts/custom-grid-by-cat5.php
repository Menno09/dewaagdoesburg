<?php
extract($arg);$catName ='';
$grid_class = '';
if ( $grid == 'fmp-col-lg-12 fmp-col-md-12 fmp-col-sm-6 fmp-col-xs-12' ){
	$grid_class = 'column-two';
?>
<div class="col-md-<?php echo esc_attr($grid) ." ". esc_attr($class) ." " . esc_attr( $grid_class ) ; ?> ">		
	<h2 class="inner-sub-title title-bar-full-width"><?php echo esc_html($catName); ?></h2>	
	<ul>
		<?php
			$count =1;
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();
					$id      = get_the_ID();
					$image   = FMP()->getFeatureImage( $id, $imgSize, $defaultImgId, $customImgSize );
					$excerpt = FMP()->strip_tags_content( get_the_excerpt(), $excerpt_limit );
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
		<?php $count++;
				endwhile;
			} else { ?>
				<p><?php esc_html_e( 'No item found', 'food-menu-pro' );?></p>
		<?php }
			wp_reset_postdata();
		?>
	</ul>
</div>

<?php
} elseif ( $grid == 'fmp-col-lg-6 fmp-col-md-6 fmp-col-sm-6 fmp-col-xs-12' ) { 
	$grid_class = 'column-one';
		
		$the_query = new WP_Query( array(
			'post_type' => 'food-menu',
			'tax_query' => array(
				array(
					'taxonomy' => 'food-menu-cat',
					'field' => 'name',
					'terms' => $catName
				)
			)
		) );
		$total_food_menu = $the_query->found_posts;		
	?>
	
	<div class="fmp-col-lg-12 fmp-col-md-12 fmp-col-sm-6 fmp-col-xs-12 <?php echo esc_attr($class) ." " . esc_attr( $grid_class ) ; ?> auto-clear row ">		
		<ul class="<?php if ( $total_food_menu > 2  ) { echo 'col-lg-6 col-md-6 col-sm-12'; } ?>">
			<?php
				$count = 0;
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
			<?php if ( $total_food_menu %2 == 0  ) { ?>
			</ul><ul class="col-lg-6 col-md-6 col-sm-12  <?php if ( $count %2 == 0 ) { echo 'right_fix';  } ?>">
			<?php }  ?>
			
			<?php $count++;
					endwhile;
			
				} else { ?>
					<p><?php esc_html_e( 'No item found', 'food-menu-pro' );?></p>
			
			
			<?php }	
			
			
			wp_reset_postdata(); ?>
		</ul>
	</div>
	
	
<?php } ?>