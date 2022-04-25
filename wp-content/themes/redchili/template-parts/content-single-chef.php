<?php
global $post;
$rc_chef_designation    = get_post_meta( $post->ID, 'rc_chef_designation', true );
$rc_chef_skill        	= get_post_meta( $post->ID, 'rc_chef_skill', true );
$redchili_chef_social   = get_post_meta( $post->ID, 'redchili_chef_social', true );
?>
<div class="container">
<div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="single-chef-top-img">
			<?php the_post_thumbnail( 'rdtheme-size4', array( 'class' => 'img-responsive' ) ); ?>
		</div>
	</div> 
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="single-chef-top-content">
			<h2><?php the_title();?></h2>
			<span class="title-bar-big-left-close"><?php echo esc_html( $rc_chef_designation );?></span>
			<?php the_content();?>
			<?php if ( !empty( $rc_chef_skill ) ){ ?>
			<h3><?php esc_html_e( 'Skills', 'redchili' );?>:</h3>
			<div class="skill-area">
				
				<?php foreach ( $rc_chef_skill as $chef_skill ): ?>
					<?php
					if ( empty( $chef_skill['skill_name'] ) || empty( $chef_skill['skill_value'] ) ) {
						continue;
					}
					?>
					<?php $chef_skill_value = (int) $chef_skill['skill_value'];?>
					<div class="progress">
						<div class="lead"><?php echo esc_html( $chef_skill['skill_name'] );?></div>
						<div style="width:<?php echo esc_attr( $chef_skill_value );?>%; visibility: visible;" data-progress="<?php echo esc_attr( $chef_skill_value );?>%" class="progress-bar"> <span><?php echo esc_attr( $chef_skill_value );?>%</span></div>
					</div>  				
				<?php endforeach;?>
				

			</div>
			<?php } ?>
			<?php if ( !empty( $redchili_chef_social ) ){ ?>
			<h3><?php esc_html_e( 'Follow Me On', 'redchili' );?>:</h3>			
			<ul class="single-chef-social">
				<?php foreach ( $redchili_chef_social as $redchili_key => $redchili_social ): ?>
					<?php if ( !empty( $redchili_social ) ): ?>
						<li><a target="_blank" href="<?php echo esc_attr( $redchili_social );?>"><i class="fa <?php echo esc_attr( RDTheme::$redchili_chef_social[$redchili_key]['icon'] );?>"></i></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>						
			<?php } ?>
		</div> 
	</div>
</div></div>