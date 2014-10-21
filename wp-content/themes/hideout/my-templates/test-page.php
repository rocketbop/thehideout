<?php
/*
Template Name: Test Page
*/

get_header();  ?>

<div class="content-area  container">
  <div class="row">
    

    <div ng-controller="testCtrl">
    <div ng-repeat="item in events">
         {{item.date}}

    </div>




    </div>

  </div>
</div>