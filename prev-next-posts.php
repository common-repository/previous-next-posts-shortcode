<?php
/*
Plugin Name: Previous - Next Posts Shortcode
Description: Adds a shortcode that creates HTML markup with the previous post and the next to the current one the user is viewing.
Version: 0.0.1
Author: The Templace
Author URI: https://www.thetemplace.com
Text Domain: tt
Domain Path: /lang
*/

add_shortcode( 'prev_next', 'prev_next_shortcode' );
function prev_next_shortcode($atts) {
    global $post;
    ob_start(); 
?>
			<div class="flex-wrap post-nav">
				<?php $prevPost = get_previous_post($in_same_term = false);
        if($prevPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $prevPost->ID
            );
            $prevPost = get_posts($args);
            foreach ($prevPost as $post) {
                setup_postdata($post);
				?>
					<div class="post-card prev-post">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
							<div class="post-thumbnail" style="background-image: url('<?php the_post_thumbnail_url('medium_large'); ?>')"></div>
							
							<div class="post-card-content">
								<div class="post-card-inner">
									<header class="entry-header">
										<?php the_title('<h2 class="entry-title">', '</h2>' ); ?>
									</header><!-- .entry-header -->
									<div class="entry-content">
										<?php	the_excerpt(); ?>
									</div><!-- .entry-content -->
									
								</div>
								<a class="post-card-link" href="<?php echo get_permalink(); // clickable post-card ?>" rel="bookmark">Read Post</a>
							</div><!--.post-card-content-->
						</article><!-- #post-## -->
					</div>
				<?php
                wp_reset_postdata();
            } //end foreach
        } else { ?>
					<div class="post-card prev-post empty-post"></div>
				<?php	
				}
         
        $nextPost = get_next_post($in_same_term = false);
        if($nextPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $nextPost->ID
            );
            $nextPost = get_posts($args);
            foreach ($nextPost as $post) {
                setup_postdata($post);
				?>
					<div class="post-card next-post">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="post-thumbnail" style="background-image: url('<?php the_post_thumbnail_url('medium_large'); ?>')"></div>
							
							<div class="post-card-content">
								<div class="post-card-inner">
									<header class="entry-header">
										<?php the_title('<h2 class="entry-title">', '</h2>' ); ?>
									</header><!-- .entry-header -->
									<div class="entry-content">
										<?php	the_excerpt(); ?>
									</div><!-- .entry-content -->
									
								</div>
								<a class="post-card-link" href="<?php echo get_permalink(); // clickable post-card ?>" rel="bookmark">Read Post</a>
							</div><!--.post-card-content-->
						</article><!-- #post-## -->
					</div>
				<?php
                wp_reset_postdata();
            } //end foreach
        } else { ?>
					<div class="post-card prev-post empty-post"></div>
				<?php	
				}
				?>
			</div><!--.flex-wrap-->
				
		<?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}