<?php
$icon_color_style = $icon_color ? "color:{$icon_color};" : '';
?>
<div class="award1-area-box">
	<div class="media">
		<div class="counter-right-1" style="margin-bottom:<?php echo esc_attr($icon_margin_bottom); ?>px;">
			<?php
				if($icon_choice == 'image'){					
					echo wp_get_attachment_image( $icon_image, array($icon_image_size, $icon_image_size), '', array( 'class' => 'img-responsive' ) ); ?>
			<?php } else { ?>
				<i style="<?php echo esc_attr( $icon_color_style ); ?>font-size:<?php echo esc_attr( $icon_size );?>px; margin-bottom:<?php echo esc_attr($icon_margin_bottom); ?>px;" class="<?php echo esc_attr( $icon );?>" aria-hidden="true"></i>	
			<?php } ?>
		</div>	
		<div class="media-body">	
			<h2 style="color:<?php echo esc_attr($number_color); ?>;font-size:<?php echo esc_attr($number_font_size); ?>px;" class="about-counter" data-num="<?php echo esc_html($counter_number);?>"><?php echo esc_html($counter_number);?></h2>
			<p style="color:<?php echo esc_attr( $title_color );?>;font-size:<?php echo esc_attr($title_font_size); ?>px;"><?php echo esc_html( $title );?></p>
		</div>
	</div>
</div>