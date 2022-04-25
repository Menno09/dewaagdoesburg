<div class="about-page3-area">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="about-2-page-left">
				<div class="about-page-img-holder">
					<?php
						if(!empty($image)){
							echo wp_get_attachment_image( $image, 'full', '', array( 'class' => 'img-responsive' ) );
						}
					 ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="about-2-page-right" style="background-color:<?php echo esc_attr( $box_color );?>;">
				<span class="top-pattern"></span>
				<span class="bottom-pattern"></span>
				<h2 style="color:<?php echo esc_attr( $title_color );?>; font-size:<?php echo esc_attr( $title_font_size );?>px;"><?php echo wp_kses_post( $title_2 );?></h2>
				<p><?php echo rawurldecode( base64_decode( strip_tags( $content_text_2 ) ) );?></p>							
				<?php
				if(!empty($background_image)){
					echo wp_get_attachment_image( $background_image,'full','', array( 'class' =>'img-responsive about-2-page-right-back' ) );
				} 
				?>
			</div>
		</div>
	</div>
</div>