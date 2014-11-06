<?php
/*
Template Name: Home Page
*/

get_header(); ?>

		

	<div id="primary" class="content-area front-page">


		<div class="container-fluid"> 
			<div class="row news-module">
				<?php get_template_part( 'templates/content', 'newsmodule' ); ?>
			</div>
		</div>

				<div class="container-fluid"> 
		<div class="row music-module">
			<?php get_template_part( 'templates/content', 'musicmodule' ); ?>
		</div>
		</div>

		<div class="container-fluid"> 
		<div class="row food-module">
			<?php get_template_part( 'templates/content', 'foodmodule' ); ?>
		</div>
		</div>

		<div class="container-fluid"> 
				<div class="row introduction-module">
			<?php get_template_part( 'templates/content', 'introductionmodule' ); ?>
		</div>
		</div>


			
	</div><!-- #primary -->


<?php get_footer(); ?>