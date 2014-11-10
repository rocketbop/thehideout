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
  <h4>Upcoming Events</h4>

  <div ng-repeat="event in data.events | orderBy: '-date_of_event' | limitTo: 5">
    <div class="row item">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <img src="{{event.event_image.url}}">
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
  <h4>News</h4>

  <div ng-repeat="blogPost in data.blogPosts | orderBy: 'date' | limitTo: 5">
    <div class="row item">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <img ng-if="blogPost.featured_image.source" src="{{blogPost.featured_image.source}}">
        <img ng-if="!blogPost.featured_image.source" src="{{newsImageDefault}}">
      </div>






      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="{{blogPost.link}}"><h4>{{blogPost.title}}</h4></a>
         
      </div>
    </div>
  
  </div>
</div>