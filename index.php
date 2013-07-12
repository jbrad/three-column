<?php
/**
 * The template for starting The Loop and rendering general content features such as the breadcrumbs, pagination, and sidebars. Uses
 * get_template_part to render the appropriate template based on the current post's format.
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
			
				<?php get_template_part( 'breadcrumbs' ); ?>
				
				<?php if ( is_archive() ) { ?>                 
	                <div id="archive-page-title"> 
	                    <h3> 
	                        <?php _e( 'Archives For ', 'standard' ); ?>
	                        <?php if( standard_is_date_archive() ) { ?>
	                        	<?php echo standard_get_date_archive_label(); ?>
	                    	<?php } elseif ( is_author() ) { ?>
	                    	
	                    		<?php 
	                    			$author_data = standard_is_using_pretty_permalinks() ? 
	                    				get_userdata( get_query_var( 'author' ) )  : 
	                    				get_userdata( user_trailingslashit( get_query_var( 'author' ) ) );
	                    			echo $author_data->display_name; 
	                    		?>
	                        	
	                        <?php } elseif ( '' == single_tag_title( '', false ) ) { ?> 
	                            <?php echo get_cat_name( get_query_var( 'cat' ) ); ?> 
	                        <?php } else { ?> 
	                            <?php echo single_tag_title() ?> 
	                        <?php } // end if/else ?> 
	                    </h3>
	            <?php if( '' != category_description() ) { ?>
	                       <?php echo category_description(); ?>
	                    <?php } // end if ?> 
	                </div> 
	            <?php } // end if ?> 
				
				<?php if ( have_posts() ) { ?>
				
					<?php while ( have_posts() ) { ?>
						<?php the_post(); ?>
						<?php get_template_part( 'loop', get_post_format() ); ?>
					<?php } // end while ?>
	
					<?php get_template_part( 'pagination' ); ?>
					
				<?php } else { ?>
			
					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Page or resource not found', 'standard' ); ?></h1>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<p><?php _e( 'No results were found.', 'standard' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->
					
				<?php } // end if/else ?>
			</div><!-- /#main -->
		
			<?php if ($has_right_sidebar) { ?>
				<div class="sidebar span<?php echo ($has_left_sidebar) ? '3' : '4'?>">
					<?php dynamic_sidebar('right-sidebar'); ?>
				</div>
			<?php } ?>

		</div><!--/row-fluid -->
	</div><!-- /container -->
</div> <!-- /#wrapper -->

<?php get_footer(); ?>