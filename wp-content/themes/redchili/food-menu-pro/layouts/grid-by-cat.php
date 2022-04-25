<?php
extract($arg);$catName ='';
$catDescription = '';
?>
<div class="col-md-<?php echo $col ." ".$class; ?> ">
	<div class='food-menu5-area'>
	<div class="food-menu5-box wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
		<div class="food-menu5-title-area">
		<!--<img src="img/dish/menu5-back1.jpg" alt="Menu Background" class="img-responsive"> -->
			<div class="food-menu5-title-holder">
				<h2><?php echo $catName; ?></h2>
				<?php echo ($catDescription ? "<p class='cat-description'>{$catDescription}</p>" : null); ?>
			</div>
		</div>
			<?php
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();
					$id      = get_the_ID();
					$image   = FMP()->getFeatureImage( $id, $imgSize, $defaultImgId, $customImgSize );
					$excerpt = FMP()->strip_tags_content( get_the_excerpt(), $excerpt_limit );
					$price   = FMP()->fmpHtmlPrice( $id );
					?>

					<div class="food-menu5-box wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
					    
					    <ul>
					        <li>
					        <?php if(in_array('title', $items)): ?>
								<h3><a class="<?php echo $anchorClass; ?>" href="<?php the_permalink() ?>" data-id="<?php the_ID() ?>"><?php the_title(); ?></a></h3>
							<?php endif; ?>
					        <?php if(in_array('excerpt', $items)): ?>
					        	<p><?php echo $excerpt; ?></p>
					        <?php endif; ?>
					        <?php if(in_array('price', $items)): ?>
					        	<span><?php echo $price; ?></span>
					        <?php endif; ?>
					  
					        </li>
					        
					    </ul>
					</div>
					
					<?php
				endwhile;
			} else {
				echo "<p>No item found.</p>";
			}

			wp_reset_postdata();
			?>
		</div>
	</div>
</div>