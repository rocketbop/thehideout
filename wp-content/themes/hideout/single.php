<?php
/**
 * The template for displaying all single posts.
 *
 * @package Hideout
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				// Get the category and ID for this post
				$category = get_the_category();
				$thisCategory = $category[0]->cat_name;
				$thisPostID = get_the_ID();
			?>
			
			<?php 
				// Prefer below to get_template_part, as need to pass a variable, to pass to Angular.
				include(locate_template('templates/content-singlepost.php'));
			?>
		
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				// if ( comments_open() || '0' != get_comments_number() ) :
				// 	comments_template();
				// endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>