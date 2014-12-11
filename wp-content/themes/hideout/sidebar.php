<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Hideout
 */

// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
// 	return;
// }
?>

<!-- EVENTS -->
<div class="sidebar sidebar-events visible-links visible-links-cherry" ng-controller="eventCtrl">
  <div class=" section-header background-container-sidebar-header">
    
    
    <div class="row">
      <div class="col-md-12 col-lg-10 col-lg-offset-1 ">
        <h3>UPCOMING EVENTS</h3>
      </div>
    </div>
  </div>
  

  <div class="background-container-sidebar-item" ng-repeat="event in data.events | orderBy: '-date_of_event' | limitTo: 5">
    <a href="{{event.link}}">
      <div class="row item">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
          <!-- <img src="{{event.event_image.url}}"> -->
          <img src="{{event.featured_image.attachment_meta.sizes.sidebarimg.url}}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
          <h3 ng-bind-html="event.event_name"></h3>
           <h5>{{event.date_of_event | date: 'EEEE, d MMMM yyyy' }}</h5>
        </div>
      </div> <!-- end item -->
    </a>
  
  </div>
</div>

<!-- NEWS -->
<div class="sidebar sidebar-blog visible-links visible-links-aqua" ng-controller="blogCtrl">
  <div class="section-header background-container-sidebar-header">
    
 
    <div class="row  ">
      <div class="col-lg-10 col-lg-offset-1">
        <h3>HIDEOUT NEWS</h3>
      </div>
    </div>
   </div>

  <div class="background-container-sidebar-item" ng-repeat="blogPost in data.blogPosts | orderBy: '-date' | limitTo: 5">
    <a href="{{event.link}}">
      <div class="row item">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
          <!-- If there is an image use its thumbnail, else use the default -->
          <img ng-if="blogPost.featured_image.source" src="{{blogPost.featured_image.attachment_meta.sizes.sidebarimg.url}}">
         <img ng-if="!blogPost.featured_image.source" src="{{newsImageDefault210X140}}">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
          <h3 ng-bind-html="blogPost.title"></h3>
          <h5>{{blogPost.date | date: 'EEEE, d MMMM yyyy'  }}</h5>
           
        </div>
      </div> <!-- end item -->
    </a>
  
  </div>
</div>