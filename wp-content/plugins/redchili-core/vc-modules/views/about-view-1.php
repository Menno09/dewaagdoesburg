<div class="about-one-area ">		
	<?php
		if(!empty($background_image)){
			echo wp_get_attachment_image( $background_image, 'full', '', array( 'class' => 'img-responsive section-back' ) );
	 	}
	 ?>
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
			<?php echo wp_get_attachment_image( $image, 'full' ); ?>
		</div>
		<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
			<div class="about-one-area-top">
				<h2 class="about-view1"><?php echo wp_kses_post( $title );?></h2>
			</div>
			<h3 class="title-bar-big-left" style="color:<?php echo esc_attr( $subtitle_color );?>; font-size:<?php echo esc_attr( $sub_title_font_size );?>px;"><?php echo wp_kses_post( $subtitle );?></h3>
			<p><?php echo rawurldecode( base64_decode( strip_tags( $content_text ) ) );?></p>
			<?php if (!empty($buttontext)) { ?>
			<a href="<?php echo esc_url( $buttonurl );?>" class="ghost-color-btn"><?php echo esc_html( $buttontext );?><i class="fa fa-chevron-<?php if ( is_rtl() ) { ?>left<?php } else { ?>right<?php } ?>" aria-hidden="true"></i></a>
			<?php } ?>
		</div>
	</div>
</div>