<?php
global $post;
$rc_recipe_pdf				= get_post_meta( get_the_ID(), 'rc_recipe_pdf', true );
$rc_recipe_ingredient_list  = get_post_meta( get_the_ID(), 'rc_recipe_ingredient_list', true );
$rc_recipe_nutritions_list  = get_post_meta( get_the_ID(), 'rc_recipe_nutritions_list', true );
$rc_recipe_prep_time        = get_post_meta( get_the_ID(), 'rc_recipe_prep_time', true );
$rc_recipe_cook_time        = get_post_meta( get_the_ID(), 'rc_recipe_cook_time', true );
$rc_recipe_ready_in         = get_post_meta( get_the_ID(), 'rc_recipe_ready_in', true );
$rc_recipe_serving_people	= get_post_meta( get_the_ID(), 'rc_recipe_serving_people', true );
$rc_recipe_nutrition_serve	= get_post_meta( get_the_ID(), 'rc_recipe_nutrition_serve', true );
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-recipe-inner">
		<?php the_post_thumbnail( 'rdtheme-size1', array( 'class' => 'img-responsive' ) ); ?>
		<?php if( !empty($rc_recipe_prep_time) || !empty($rc_recipe_cook_time) || !empty($rc_recipe_ready_in) ){ ?>
			<ul class="tools-bar">
				<?php if(!empty($rc_recipe_prep_time)){ ?>
				<li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'Prep. Time', 'redchili' );?>: <span>
					<?php echo esc_html($rc_recipe_prep_time); ?></span></a>
				</li>
				<?php } ?>
				<?php if(!empty($rc_recipe_cook_time)){ ?>
				<li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'Cooking Time', 'redchili' );?>: <span>
					<?php echo esc_html($rc_recipe_cook_time); ?></span></a>
				</li>
				<?php } ?>
				<?php if(!empty($rc_recipe_ready_in)){ ?>
				<li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'Ready In', 'redchili' );?>: <span>
					<?php echo esc_html($rc_recipe_ready_in); ?></span></a>
				</li>
				<?php } ?>
			</ul>
		<?php } ?>
		<?php the_content(); ?>
		<div class="row">
		<?php if ( !empty( $rc_recipe_ingredient_list ) ): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ingredients-box">
					<h3><?php esc_html_e( 'Ingredients', 'redchili' );?></h3>					
					<div class="recipe-serving">
						<i class="fa fa-users" aria-hidden="true"></i><?php esc_html_e( 'Serving People', 'redchili' );?>: <span>
						<input name="action" value="redchili_recipe_cal" type="hidden" /> 
						<input name="recipe-id" class="recipe-id" value="<?php the_ID(); ?>" type="hidden" /> 
						<input name="person-number" class="person-number" type="number" value="<?php if(!empty($rc_recipe_serving_people)){ ?><?php echo esc_html($rc_recipe_serving_people); ?><?php } else { esc_html_e( '1', 'redchili' ); } ?>" /> 
						</span>
					</div>					
						<ul>
							<?php 
							$i = 1;
							foreach ( $rc_recipe_ingredient_list as $recipe_ingredient_list ): ?>
							<li id="ingredient_item_number-<?php echo esc_html($i); ?>">
								<i class="fa fa-check" aria-hidden="true"></i>
								<?php echo esc_html($recipe_ingredient_list['ingredient_item']); ?><?php if(!empty($recipe_ingredient_list['ingredient_unit'])){ ?>: <?php } ?><span id="<?php
									if(empty($rc_recipe_serving_people)){
										$rc_recipe_serving_people = 1;
									}
									if(!empty($recipe_ingredient_list['ingredient_quantity'])){
										$single_serve = $recipe_ingredient_list['ingredient_quantity'] / $rc_recipe_serving_people;
										echo esc_html($single_serve);
									}
									 ?>">								
								<?php if(!empty($recipe_ingredient_list['ingredient_quantity'])){ echo esc_html($recipe_ingredient_list['ingredient_quantity']); } ?></span> <?php if(!empty($recipe_ingredient_list['ingredient_unit'])){ echo esc_html($recipe_ingredient_list['ingredient_unit']); } ?>
							</li>
							<?php $i++; endforeach;?>
						</ul>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( !empty( $rc_recipe_nutritions_list ) ): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="ingredients-box">
					<h3><?php esc_html_e( 'Nutrition', 'redchili' );?><?php if(!empty($rc_recipe_nutrition_serve)){ ?><span> /<?php echo esc_html($rc_recipe_nutrition_serve); ?></span><?php } ?></h3>					
						<ul>
							<?php foreach ( $rc_recipe_nutritions_list as $recipe_nutritions_list ): ?>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i><?php echo esc_html($recipe_nutritions_list['nutritions_item']); ?>
								</li>
							<?php endforeach;?>
						</ul>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php if ( !empty( $rc_recipe_pdf ) ) { ?>
		<a href="<?php if ( !empty( $rc_recipe_pdf ) ) { echo wp_get_attachment_url( $rc_recipe_pdf ); } ?>" class="ghost-on-hover-btn"><i class="fa fa-file-text-o" aria-hidden="true" download></i><?php esc_html_e( 'Download PDF', 'redchili' );?></a>
		<?php } ?>
	</div>
</div>