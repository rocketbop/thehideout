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
<!-- SOCIAL BUTTONS -->
<div class="sidebar">
<div class="row">
  <div class="col-md-12 col-lg-10 col-lg-offset-1">
    <div class="row">
  <div class="col-md-4">
    <a href="http://www.twitter.com">
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/twitter-2.png"  alt="Twitter">
                    </div>
    </a>
  </div>
    <div class="col-md-4">
    <a href="https://www.facebook.com/pages/Joeys-Hideout/345530658898470">
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/facebook.png" alt="Facebook Page">
                    </div>
                  </a>
  </div>
    <div class="col-md-4">
    <a href="https://www.flickr.com/photos/129749000@N03/">
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/flickr-3.png" alt-"Flickr Gallery">
                    </div>
    </a>
  </div>

</div>
  </div>
</div>

  
</div>
<!-- EVENTS -->
<div class="sidebar sidebar-events visible-links visible-links-cherry" ng-controller="eventCtrl">
  <div class=" section-header background-container-sidebar-header">
    <div class="row">
      <div class="col-md-12 col-lg-10 col-lg-offset-1 ">
        <h3>UPCOMING EVENTS</h3>
      </div>
    </div>
  </div>
    <div class="background-container-sidebar-item" ng-repeat="event in data.events | filter: futureEvents | orderBy: '-date_of_event' | limitTo: 5">
      <a href="{{event.link}}">
        <div class="row item">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
          <div class="item-image-wrapper">
            <img src="{{event.featured_image.attachment_meta.sizes.sidebarimg.url}}">
          </div>
            
          </div>
          <div class="date col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
            <h3 ng-bind-html="event.event_name"></h3>
             <h5>{{event.date_of_event | date: 'EEEE, d MMMM yyyy' }}</h5>
          </div>
        </div> <!-- end item -->
      </a>
    </div>
</div>

<!-- NEWS -->
<div class="sidebar sidebar-news visible-links visible-links-aqua" ng-controller="newsCtrl">
  <div class="section-header background-container-sidebar-header">
    
 
    <div class="row  ">
      <div class="col-lg-10 col-lg-offset-1">
        <h3>HIDEOUT NEWS</h3>
      </div>
    </div>
   </div>

  <div class="background-container-sidebar-item" ng-repeat="newsPost in data.newsPosts | orderBy: '-date' | limitTo: 5">
    <a href="{{newsPost.link}}">
      <div class="row item">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <div class="item-image-wrapper">
          <!-- If there is an image use its thumbnail, else use the default -->
          <img ng-if="newsPost.featured_image.source" src="{{newsPost.featured_image.attachment_meta.sizes.sidebarimg.url}}">
         <img ng-if="!newsPost.featured_image.source" src="{{newsImageDefault210X140}}">
         </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
          <h3 ng-bind-html="newsPost.title"></h3>
          <h5>{{newsPost.date | date: 'EEEE, d MMMM yyyy'  }}</h5>
           
        </div>
      </div> <!-- end item -->
    </a>
  
  </div>
</div>