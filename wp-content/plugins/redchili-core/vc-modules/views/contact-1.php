<?php
$class = vc_shortcode_custom_css_class( $css );
$rdtheme_socials = RDTheme_Helper::socials();
?>
<div class="contact-us-left <?php echo esc_attr( $class );?>">   
	<h2 class="title-bar-medium-left inner-sub-title" style="color:<?php echo esc_attr( $title_color );?>; font-size:<?php echo esc_attr( $rt_vc_font_size );?>px;">
		<?php echo esc_html( $title );?>		
	</h2>    
	<ul>
		<?php if($rt_vc_contact_phone=='true' && !empty(RDTheme::$options['phone'])){ ?>		
		<li>
			<i class="fa fa-phone" aria-hidden="true"></i>
			<h3><?php _e('Phone', 'redchili-core'); ?></h3>
			<p><?php echo RDTheme::$options['phone']; ?></p>   
		</li>
		<?php } ?>
		<?php if($rt_vc_contact_address=='true' && !empty(RDTheme::$options['address'])){ ?>
		<li>
			<i class="fa fa-map-marker" aria-hidden="true"></i>
			<h3><?php _e('Address', 'redchili-core'); ?></h3>
			<p><?php echo RDTheme::$options['address']; ?></p> 
		</li>		
		<?php } ?>
		<?php if($rt_vc_contact_email=='true' && !empty(RDTheme::$options['email'])){ ?>
		<li>
			<i class="fa fa-envelope-o" aria-hidden="true"></i>
			<h3><?php _e('E-mail', 'redchili-core'); ?></h3>
			<p><?php echo RDTheme::$options['email']; ?></p>
		</li>		
		<?php } ?>
		<?php if($rt_vc_contact_social=='true' && !empty($rdtheme_socials)){ ?>
		<li>
			<i class="fa fa-share-alt" aria-hidden="true"></i>
			<h3><?php _e('Follow Us', 'redchili-core'); ?></h3>
			<?php if($rdtheme_socials){ ?>
			<ul class="contact-social">
				<?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
					<li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] );?>"><i class="fa <?php echo esc_attr( $rdtheme_social['icon'] );?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
			<?php } ?>
		</li>		
		<?php } ?>  
	</ul>
</div>