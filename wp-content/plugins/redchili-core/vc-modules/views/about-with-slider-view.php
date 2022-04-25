<div class="about-page-area">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="about-page-left">	
				<h2 style="color:<?php echo esc_attr( $title_color );?>; font-size:<?php echo esc_attr( $title_font_size );?>px;"><?php echo esc_html( $title );?></h2>
				<p><?php echo wp_kses_post( $content );?></p>	
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="about-page-right">
			<?php if(!empty($image)){ ?>
				<div class="rt-owl-carousel owl-carousel owl-theme" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
					<?php
						$image_ids=explode(',',$image);
						$y = count($image_ids);
						for($i=0;$i<$y;$i++)
						{ 
						 ?>						  
						<div class="about-page-img-holder">
							<?php echo wp_get_attachment_image( $image_ids[$i], 'large', "", array( "class" => "img-responsive" ) );  ?>
						</div>							
						<?php  
						}
					?>		
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>