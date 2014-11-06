<?php
/*
Template Name: Home Page
*/

get_header(); ?>

		

	<div id="primary" class="content-area ">



		<div class="row">
			<?php get_template_part( 'templates/content', 'newsmodule' ); ?>
		</div>

		
		<div class="row">
			<?php get_template_part( 'templates/content', 'musicmodule' ); ?>
		</div>


		<div class="row">
			<?php get_template_part( 'templates/content', 'foodmodule' ); ?>
		</div>

				<div class="row">
			<?php get_template_part( 'templates/content', 'introductionmodule' ); ?>
		</div>


			
	</div><!-- #primary -->


<?php get_footer(); ?>