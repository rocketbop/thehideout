<?php
/*
Template Name: Events Page
*/

get_header(); ?>

<p>This is the events page</p>
<div ng-controller="eventCtrl">
	<h1>Events</h1>
	<div ng-repeat="event in data.events | orderBy: 'date'">

		

		
		<h2>{{event.title}}</h2>
		<p>{{event.content}}</p>
		<p>{{event.date | date:'EEEE, dd MM yyyy, h:mm'}}</p>

	</div>
</div>