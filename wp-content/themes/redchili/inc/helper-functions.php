<?php
if ( !class_exists( 'RDTheme_Helper' ) ) {
	
	class RDTheme_Helper {

		public static function pagination() {

			if( is_singular() )
				return;

			global $wp_query;

			/** Stop execution if there's only 1 page */
			if( $wp_query->max_num_pages <= 1 )
				return;

			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			$max   = intval( $wp_query->max_num_pages );

			/**	Add current page to the array */
			if ( $paged >= 1 )
				$links[] = $paged;

			/**	Add the pages around the current page to the array */
			if ( $paged >= 3 ) {
				$links[] = $paged - 1;
				$links[] = $paged - 2;
			}

			if ( ( $paged + 2 ) <= $max ) {
				$links[] = $paged + 2;
				$links[] = $paged + 1;
			}

			echo '<div class="pagination-area"><ul>' . "\n";

			/**	Previous Post Link */
			if ( get_previous_posts_link() )
				printf( '<li>%s</li>' . "\n", get_previous_posts_link( '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' ) );

			/**	Link to first page, plus ellipses if necessary */
			if ( ! in_array( 1, $links ) ) {
				$class = 1 == $paged ? ' class="active"' : '';

				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

				if ( ! in_array( 2, $links ) )
					echo '<li>...</li>';
			}

			/**	Link to current page, plus 2 pages in either direction if necessary */
			sort( $links );
			foreach ( (array) $links as $link ) {
				$class = $paged == $link ? ' class="active"' : '';
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
			}

			/**	Link to last page, plus ellipses if necessary */
			if ( ! in_array( $max, $links ) ) {
				if ( ! in_array( $max - 1, $links ) )
					echo '<li>...</li>' . "\n";

				$class = $paged == $max ? ' class="active"' : '';
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
			}

			/**	Next Post Link */
			if ( get_next_posts_link() )
				printf( '<li>%s</li>' . "\n", get_next_posts_link( '<i class="fa fa-angle-double-right" aria-hidden="true"></i>' ) );

			echo '</ul></div>' . "\n";
		}		
		
		public static function fonts_url(){
			$fonts_url = '';
			if ( 'off' !== _x( 'on', 'Google fonts - Open Sans and Poppins : on or off', 'redchili' ) ) {
				$fonts_url = add_query_arg( 'family', urlencode( 'Oswald:400,700|Roboto Slab:400,700' ), "//fonts.googleapis.com/css" );
			}
			return $fonts_url;
		}
		
		//@rtl
		public static function maybe_rtl( $css ){
			if ( is_rtl() ) {
				return RDTHEME_AUTORTL_URL . $css;
			}
			else {
				return RDTHEME_CSS_URL . $css;
			}
		}
		
		// query reset object
		public static function wp_set_temp_query( $query ) {
			global $wp_query;
			$temp = $wp_query;
			$wp_query = $query;
			return $temp;
		}
		
		public static function comments_callback( $comment, $args, $depth ){
			$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
			?>
			<<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent main-comments' : 'main-comments', $comment ); ?>>
			<div id="respond-<?php comment_ID(); ?>" class="each-comment">
				<div class="pull-left imgholder">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], "", false, array( 'class'=>'media-object' ) ); ?>
				</div>

				<div class="media-body comments-body">
					<h4 class="media-heading"><?php echo get_comment_author_link( $comment );?></h4>
					<p class="comment-time"><?php printf( '%1$s @ %2$s' , get_comment_date( '', $comment ), get_comment_time() );?></p>
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'redchili' ); ?></p>
						<?php endif; ?>
					<?php comment_text(); ?>
					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'respond',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="replay-area">',
						'after'     => '</div>'
						) ) );
					?>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php
		}

		public static function hex2rgb($hex) {
			$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgb = "$r, $g, $b";
			return $rgb;
		}

		public static function filter_social( $args ){ return ( $args['url'] != '' ); }

		public static function socials(){
			$rdtheme_socials = array(
				'social_facebook' => array(
					'icon' => 'fa-facebook',
					'url'  => RDTheme::$options['social_facebook'],
				),
				'social_twitter' => array(
					'icon' => 'fa-twitter',
					'url'  => RDTheme::$options['social_twitter'],
				),
				'social_gplus' => array(
					'icon' => 'fa-google-plus',
					'url'  => RDTheme::$options['social_gplus'],
				),
				'social_linkedin' => array(
					'icon' => 'fa-linkedin',
					'url'  => RDTheme::$options['social_linkedin'],
				),
				'social_youtube' => array(
					'icon' => 'fa-youtube',
					'url'  => RDTheme::$options['social_youtube'],
				),
				'social_pinterest' => array(
					'icon' => 'fa-pinterest',
					'url'  => RDTheme::$options['social_pinterest'],
				),
				'social_instagram' => array(
					'icon' => 'fa-instagram',
					'url'  => RDTheme::$options['social_instagram'],
				),
				'social_skype' => array(
					'icon' => 'fa-skype',
					'url'  => RDTheme::$options['social_skype'],
				),
				'social_rss' => array(
					'icon' => 'fa-rss',
					'url'  => RDTheme::$options['social_rss'],
				),
			);
			return array_filter( $rdtheme_socials, array( 'RDTheme_Helper' , 'filter_social' ) );
		}

		public static function nav_menu_args(){
			$rdtheme_pagemenu = false;
			if ( ( is_single() || is_page() ) ) {
				$rdtheme_menuid = get_post_meta( get_the_id(), 'redchili_page_menu', true );
				if ( !empty( $rdtheme_menuid ) && $rdtheme_menuid != 'default' ) {
					$rdtheme_pagemenu = $rdtheme_menuid;
				}
			}
			if ( $rdtheme_pagemenu ) {
				$nav_menu_args = array( 'menu' => $rdtheme_pagemenu,'container' => 'nav' );
			}
			else {
				$nav_menu_args = array( 'theme_location' => 'primary','container' => 'nav' );
			}
			return $nav_menu_args;		
		}
		
		public static function has_footer(){
			if ( !RDTheme::$options['footer_area'] ) {
				return false;
			}
			$footer_column = RDTheme::$options['footer_column'];
			for ( $i = 1; $i <= $footer_column; $i++ ) {
				if ( is_active_sidebar( 'footer-'. $i ) ) {
					return true;
				}
			}
			return false;
		}
		
		public static function custom_sidebar_fields(){
			$sidebar_fields = array();

			$sidebar_fields['sidebar'] = __( 'Sidebar', 'redchili' );

			$sidebars = get_option( 'redchili_custom_sidebars', array() );
			if ( $sidebars ) {
				foreach ( $sidebars as $sidebar ) {
					$sidebar_fields[$sidebar['id']] = $sidebar['name'];
				}
			}

			return $sidebar_fields;
		}		
		
		/*food menu popup*/
		public static function rtoverride(){
			if ( !empty($_REQUEST['id']) && $id = absint($_REQUEST['id']) ) {

				global $post;
				$post = get_post( absint( $id ) );
				
					ob_start();
					get_template_part( 'template-parts/content', 'food-menu-popup');
					$content = ob_get_contents();
					ob_clean();
					
				wp_reset_postdata();
			}
			wp_send_json( array( 'html' => $content ) );
			die();
		}
	}
}