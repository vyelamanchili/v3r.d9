<?php
/**
 * @version 6.4.3
 */
get_header(); ?>
	<div id="content" class="small-12 large-8 cell" role="main">
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"> <ul class="breadcrumbs">','</ul>'); } ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
