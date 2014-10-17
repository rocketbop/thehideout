<?php
/*
Template Name: Events Page
*/

get_header(); ?>

<div id="primary" class="content-area container ">
  <div ng-controller="eventCtrl">
  	<div class="row">

    <div class ="col-md-3">
      <h1>Select Category</h1>
      <a ng-click="selectCategory()"
        class="btn btn-block btn-default btn-lg">All</a>
        <!-- The unique filter will mean categories with more than one event will not be generated in duplicate -->
      <a ng-repeat="event in data.events | orderBy: 'meta.category' | unique: 'meta.category' " ng-click="selectCategory(event.meta.category)" class=" btn btn-block btn-default btn-lg">{{event.meta.category}}Hello</a>  

    </div>
    <div class="col-md-9">
      
      	<h1>Events</h1>
      	<div ng-repeat="event in data.events | orderBy: '-meta.date_of_event'">

      		<p>{{event.content}}</p>
      		<!-- <p><strong>Date Created</strong>{{event.date | date:'EEEE, dd MM yyyy, h:mm'}}</p> -->
          <p><strong>Date of Event:</strong>{{event.meta.date_of_event | date: 'medium'}}</p>
          <p><strong>Name of Event:</strong>{{event.meta.event_name}}</p>
          <p><strong>Category:</strong>{{event.meta.category}}</p>
          <img src="{{event.meta.event_image.url}}">

      	</div>
     </div>
    </div>
  </div>  
</div>