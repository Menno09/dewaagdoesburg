<?php
$icon_style  = $icon_color ? "color:{$icon_color};" : '';
$icon_style .= $icon_size ? "font-size:{$icon_size}px;" : '';
$title_color_style = $title_color ? "color:{$title_color};" : '';
?>
<div class="info-box-1" data-hover="<?php echo esc_attr( $hovercolor );?>" data-color="<?php echo esc_attr( $icon_color );?>">
	<div class="media">
		<div class="infobox-style1-left" style="margin-bottom:<?php echo esc_attr($icon_margin_bottom); ?>px;">
			<?php if ( $icon_choice == 'image' ){ ?>
				<span style="display: block;">
					<?php echo wp_get_attachment_image( $icon_image, array($icon_image_size, $icon_image_size), '', array( 'class' => 'img-responsive' ) ); ?>
				</span>
			<?php } else { ?>
				<i style="<?php echo esc_attr( $icon_style );?> margin-bottom:<?php echo esc_attr($icon_margin_bottom); ?>px;" class="<?php echo esc_attr( $icon );?>" aria-hidden="true"></i>
			<?php } ?>
		</div>
		<div class="infobox-style1-right media-body">	
			<h2 style="font-size:<?php echo esc_attr($title_font_size); ?>px;">
				<?php if(!empty($title_url)){ ?>
					<a style="<?php echo esc_attr($title_color_style); ?>" href="<?php echo esc_attr($title_url); ?>"><?php echo esc_html($title);?></a>
				<?php } else { ?>
					<?php echo esc_html($title);?>
				<?php } ?>
			</h2>
			<p style="color:<?php echo esc_attr( $info_color );?>;font-size:<?php echo esc_attr($info_font_size); ?>px;"><?php echo wp_kses_post( $content ); ?></p>	
		</div>
	</div>
</div>