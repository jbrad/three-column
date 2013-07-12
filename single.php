<?php
/**
 * The template for displaying a single post and its related content as well as author boxes. Uses
 * get_post_format to render the appropriate template based on the post's format.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.0
 */
?>
<?php get_header(); ?>
<?php $has_left_sidebar = (is_active_sidebar('left-sidebar') && !get_post_meta( get_the_ID(), 'standard_seo_post_level_layout', true )); ?>
<?php $has_right_sidebar = (is_active_sidebar('right-sidebar') && !get_post_meta( get_the_ID(), 'standard_seo_post_level_layout', true )); ?>
<?php
	if ($has_left_sidebar && $has_right_sidebar) {
		$main = '6';
	} elseif ($has_left_sidebar) {
		$main = '8';
	} elseif ($has_right_sidebar) {
		$main = '8';
	} else {
		$main = '12';
	}
?>

<div id="wrapper">
	<div class="container">
		<div class="row-fluid">

			<?php if ($has_left_sidebar) { ?>
				<div class="sidebar span<?php echo ($has_right_sidebar) ? '3' : '4'?>">
					<?php dynamic_sidebar('left-sidebar'); ?>
				</div>
			<?php } ?>

			<div id="main" class="span<?php echo $main; ?> clearfix" role="main">
				
				<?php get_template_part( 'breadcrumbs' ); ?>
				
				<?php if ( have_posts() ) { 
						while ( have_posts() ) {
							the_post(); 
							get_template_part( 'loop', get_post_format() );
				?>
	
							<?php $publishing_options = get_option( 'standard_theme_publishing_options' ); ?>
							<?php $display_author_box = isset( $publishing_options['display_author_box'] ) ? $publishing_options['display_author_box'] : ''; ?>
				
							<?php get_template_part( 'pagination '); ?>

							<?php $social_options = get_option( 'standard_theme_social_options' ); ?>
							<?php if( 'always' == $display_author_box ) { ?>
								<div id="author-box" class="well clearfix">
									<div class="author-box-image">
										<?php echo get_avatar( get_the_author_meta( 'user_email', $post->post_author, '80' ) ); ?>
									</div><!-- /.author-box-image -->
									<h4 class="author-box-name"><?php the_author_meta( 'display_name' ); ?></h4>
									<p>
										<a class="author-link author-posts-url" href="<?php echo trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?> <?php _e( 'Posts', 'standard'); ?>"><?php _e( 'Posts', 'standard' ); ?></a>
										
									<?php if( strlen( trim( get_the_author_meta( 'user_url' ) ) ) > 0 ) { ?>
										<a class="author-link author-url" href="<?php echo trailingslashit( the_author_meta( 'user_url' ) ); ?>" title="<?php _e( 'Website', 'standard'); ?>" target="_blank" rel="author"><?php _e( 'Website', 'standard' ); ?></a>
									<?php } // end if ?>
									
									<?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ) ) > 0 ) { ?>
										<a class="author-link icn-twitter" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ); ?>" title="<?php _e( 'Twitter', 'standard'); ?>" target="_blank"><?php _e( 'Twitter', 'standard'); ?></a>
									<?php } // end if ?>

									<?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ) ) > 0 ) { ?>
										<a class="author-link icn-facebook" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ); ?>" title="<?php _e( 'Facebook', 'standard'); ?>" target="_blank"><?php _e( 'Facebook', 'standard'); ?></a>
									<?php } // end if ?>
									
									<?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'google_plus', true ) ) ) > 0 ) { ?>
										<a class="author-link icn-gplus" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'google_plus', true ) ); ?>" title="<?php _e( 'Google+', 'standard'); ?>" target="_blank"><?php _e( 'Google+', 'standard'); ?></a>
									<?php } // end if ?>
									
									</p>
									<?php if( strlen( trim( the_author_meta( 'description' ) ) > 0 ) ) { ?>
										<div class="author-box-description">
											<p><?php the_author_meta( 'description' ); ?></p>
										</div><!-- /.author-box-description -->
									<?php } // end if ?>
								</div><!-- /.author-box -->						
							<?php } // end if ?>
							
							<?php if( is_active_sidebar( 'sidebar-2' ) ) { ?>
								<div id="standard-post-advertisement">
									<?php dynamic_sidebar( 'sidebar-2' ); ?>
								</div><!-- #standard-post-advertisement -->
							<?php } // end if ?>
							
							<?php get_template_part( 'pagination' ); ?>
							
							<?php comments_template( '', true ); ?>	
							
					 	<?php } // end while ?>

				<?php } // end if ?>
			</div><!-- /#main -->
			
			<?php if ($has_right_sidebar) { ?>
				<div class="sidebar span<?php echo ($has_left_sidebar) ? '3' : '4'?>">
					<?php dynamic_sidebar('right-sidebar'); ?>
				</div>
			<?php } ?>
				
		</div> <!--/row-fluid -->
	</div><!-- /container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>