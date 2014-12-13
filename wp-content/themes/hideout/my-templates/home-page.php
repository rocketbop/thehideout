<?php
/*
Template Name: Home Page
*/

get_header(); ?>

		

	<div id="primary" class="content-area front-page">
		<div class="container-fluid">
    	<div class="row">
        <div class="background-container col-xs-12 col-sm-12 col-md-12 col-lg-12" data-my-div-height="full" minus-header="true">

	        <div class="row">
	          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
	            <div class="row">
	             
	              <div id="blurb" class="blurb col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3" data-my-vertical-center ext-function="getPanelMargin()">
	                <h1>KILCULLEN'S BAR</h1>
				          <h3>Music, Good Foods, and Friends</h3>
				         <div class="fb-like" data-href="http://www.theguardian.com/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
	              </div>

	            </div>
	          </div>
	        </div>
        </div>
      </div>
    </div>  <!-- end continer-fluid -->

		
			<div class="news-module" ng-controller="newsCtrl">
				<?php get_template_part( 'templates/content', 'newsmodule' ); ?>
			</div>
	


		<div class="events music-module" ng-controller="eventCtrl">
			<?php get_template_part( 'templates/content', 'musicmodule' ); ?>
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