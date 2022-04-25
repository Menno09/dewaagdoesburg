<?php

get_header();

while ( have_posts() ) : the_post();
	?>
	<main id="main" class="site-main" rol="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class('fmp'); ?>>
			<div class="fmp-container fmp-wrapper fmp-single-food">
				<div class="fmp-row">
					<?php do_action('fmp_single_summery');?>
				</div><!-- fmp-row  -->
                <?php
                /**
                 * @fmp_single_details
                 *
                 * 1. fmp_single_before_details 10
                 * 2. fmp_single_tab 20
                 * 3. fmp_single_after_details 30
                 *
                 */
                do_action( 'fmp_single_details' );
                ?>
			</div> <!-- fmp-wrapper  -->
		</article>
	</main>
	<?php
endwhile;
get_footer();