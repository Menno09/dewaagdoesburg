<div class="rc-food-popup single-menu-area">
	<div class="row">
		<?php
		global $post;
		$html = null;
		$html .= '<div class="fmp-col-md-12 fmp-col-lg-12 fmp-col-sm-12 fmp-images">';
		$html .= '<div id="images">';

		$attachments = get_post_meta( $post->ID, '_fmp_image_gallery', true );
		$attachments = is_array( $attachments ) ? $attachments : array();
		if ( has_post_thumbnail() ) {
			array_unshift( $attachments, get_post_thumbnail_id( $post->ID ) );
		}

		if ( ! empty( $attachments ) ) {
			if ( count( $attachments ) > 1 ) {
				$thumbnails = null;
				$slides     = null;
				foreach ( $attachments as $attachment ) {
					$slides .= "<li class='fmp-slide'>" . TLPFoodMenu()->getAttachedImage( $attachment,
						'full' ) . "</li>";
					$thumbnails .= "<li class='fmp-slide-thumb'>" . TLPFoodMenu()->getAttachedImage( $attachment,
						'thumbnail' ) . "</li>";
				}

				$slider = null;
				$slider .= "<div id='fmp-slide-wrapper'>";
				$slider .= "<div id=\"slider\" class=\"flexslider\"><ul class=\"slides\">{$slides}</ul></div>";
				if ( is_singular( TLPFoodMenu()->post_type ) ) {
					$slider .= "<div id=\"carousel\" class=\"flexslider\"><ul class=\"slides\">{$thumbnails}</ul></div>";
				}
					$slider .= "</div>"; // #end fmp-slider

					$html .= $slider;

				} else {
					$html .= "<div class='fmp-single-food-img-wrapper'>";
					$html .= TLPFoodMenu()->getAttachedImage( $attachments[0] );
					$html .="</div>";
				}
			} else {
				$imgSrc = TLPFoodMenu()->placeholder_img_src();
				$html .= "<div class='fmp-single-food-img-wrapper'>";
				$html .= "<img class='fmp-single-food-img' alt='Place holder image' src='{$imgSrc}' />";
				$html .="</div>";
			}
			$html .= '</div>'; // #images
		$html .= '</div>'; // fmp-images
		echo wp_kses_post($html);
		?>
		<div class="single-menu-inner">				
			<div class="single-menu-inner-content">
				<h2 class="inner-sub-title"><?php the_title(); ?></h2>						
				<ul class="tools-bar">
				</ul>
				<?php $gTotal = FMP()->fmpHtmlPrice(); ?>
				<div class="offers"><span class="price"><?php echo wp_kses_post($gTotal); ?></span></div>
				<?php the_content(); ?>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="ingredients-box">
						<h3><?php esc_html_e('Ingredients', 'redchili'); ?></h3>
						<?php 
						$post_id = absint(get_the_ID());
						if(!$post_id){
							global $post;
							$post_id = $post->ID;
						}
						$html = null;
						$ingredients    = get_post_meta( $post_id, '_ingredient' );
						if(!empty($ingredients)){
							$html .= "<ul>";
							foreach ($ingredients as $ingredient){
								$ing = !empty($ingredient['id']) ? get_term($ingredient['id'], TLPFoodMenu()->taxonomies['ingredient']) : null;
								$unit = !empty($ingredient['unit_id']) ? get_term($ingredient['unit_id'], TLPFoodMenu()->taxonomies['unit']) : null;
								$value = !empty($ingredient['value']) ? ' '.$ingredient['value'] : null;
								if(is_object($unit) && $unit->name && $value){
									$unit = " ( {$unit->name} )";
								}else{
									$unit = null;
								}
								if(is_object($ing)){
									$html .= "<li><i class='fa fa-check' aria-hidden='true'></i>{$ing->name}{$value}{$unit}</li>";
								}

							}
							$html .= "</ul>";
						};
						echo wp_kses_post($html);
						?>
					</div>
				</div>				
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="ingredients-box">
						<h3><?php esc_html_e('Nutritions', 'redchili'); ?></h3>
						<?php
						$post_id = absint(get_the_ID());
						if(!$post_id){
							global $post;
							$post_id = $post->ID;
						}
						$html = null;
						$nutrition = get_post_meta( $post_id, '_nutrition' );
						if(!empty($nutrition)){
							$html .= "<ul>";
							foreach ($nutrition as $nutrition){
								$nut = !empty($nutrition['id']) ? get_term($nutrition['id'], TLPFoodMenu()->taxonomies['nutrition']) : null;
								$unit = !empty($nutrition['unit_id']) ? get_term($nutrition['unit_id'], TLPFoodMenu()->taxonomies['unit']) : null;
								$value = !empty($nutrition['value']) ? ' '.$nutrition['value'] : null;
								if(is_object($unit) && !empty($unit->name) && $value){
									$unit = " ( {$unit->name} )";
								}else{
									$unit = null;
								}
								if(is_object($nut)){
									$html .= "<li><i class='fa fa-check' aria-hidden='true'></i>{$nut->name}{$value}{$unit}</li>";
								}
							}
							$html .= "</ul>";
						};
						echo wp_kses_post($html);
						?>
					</div>
				</div>				
			</div>							
		</div>	
	</div>
</div>