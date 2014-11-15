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
<div class="sidebar sidebar-events" ng-controller="eventCtrl">
  <h2>Upcoming Events</h2>

  <div ng-repeat="event in data.events | orderBy: '-date_of_event' | limitTo: 5">
    <div class="row item">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- <img src="{{event.event_image.url}}"> -->
        <img src="{{event.featured_image.attachment_meta.sizes.sidebarimg.url}}">
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="{{event.link}}"><h4>{{event.event_name}}</h4></a>
         <h5>{{event.date_of_event | date: 'short'}}</h5>
      </div>
    </div>
  
  </div>
</div>

<!-- NEWS -->
<div class="sidebar sidebar-blog" ng-controller="blogCtrl">
  <h2>News</h2>

  <div ng-repeat="blogPost in data.blogPosts | orderBy: 'date' | limitTo: 5">
    <div class="row item">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- If there is an image use its thumbnail, else use the default -->
        <a href="{{blogPost.link}}"><img ng-if="blogPost.featured_image.source" src="{{blogPost.featured_image.attachment_meta.sizes.sidebarimg.url}}"></a>
       <a href="{{blogPost.link}}"><img ng-if="!blogPost.featured_image.source" src="{{newsImageDefault210X140}}"></a>
      </div>






      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="{{blogPost.link}}"><h4>{{blogPost.title}}</h4></a>
         
      </div>
    </div>
  
  </div>
</div>