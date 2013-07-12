<?php
/**
 * The template for displaying single pages.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.0
 */
?>
<?php get_header(); ?>
<?php $has_left_sidebar = is_active_sidebar('left-sidebar'); ?>
<?php $has_right_sidebar = is_active_sidebar('right-sidebar'); ?>
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
				
					<?php 
					if( ! is_front_page() ) {
						get_template_part( 'breadcrumbs' );
					} // end if
					?>
				
					<?php if ( have_posts() ) { ?>
						<?php while ( have_posts() ) {
							 the_post(); ?>
							<div id="post-<?php the_ID(); ?> format-standard" <?php post_class( 'post' ); ?>>
								<div class="post-header clearfix">
									<h1 class="post-title entry-title"><?php the_title(); ?></h1>	
								</div> <!-- /.post-header -->						
								<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
									<div class="content">
										<?php the_content(); ?>
									</div><!-- /.entry-content -->
								</div><!-- /.entry-content -->
							</div> <!-- /#post --->
						<?php } // end while ?>
					<?php } // end if ?>
					<?php comments_template( '', true ); ?>
				</div><!-- /#main -->
			
				<?php if ($has_right_sidebar) { ?>
					<div class="sidebar span<?php echo ($has_left_sidebar) ? '3' : '4'?>">
						<?php dynamic_sidebar('right-sidebar'); ?>
					</div>
				<?php } ?>
				
		</div><!--/row-fluid -->
	</div><!--/container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>