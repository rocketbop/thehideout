angular.module("theHideoutApp")
.controller("mainCtrl", ['$scope', '$filter', '$window', '$log', 'apiService', 'globalService', 'templateDirectory', 'Facebook', function ($scope, $filter, $window, $log, apiService, globalService, templateDirectory, Facebook) {
  
  $scope.templateDirectory = templateDirectory;

  // init these on each load so false unless called from the app
  $scope.singlePostCategory = '';
  $scope.singlePostID = '';
  
  // called by ng-init in templates/content-singlepost.php
  $scope.getSinglePostData = function (postCategory, postID) {
    $scope.singlePostCategory = postCategory;
    $scope.singlePostID = postID;
  }
  
  $scope.sidebarUrl = templateDirectory + "sidebar.php";
  
  // used in ng-switch statement in templates/content-singlepost.php
  $scope.eventPartial = templateDirectory + "angular/partials/singlepostevent.php";
  $scope.newsPartial = templateDirectory + "angular/partials/singlepostnews.php";

  $scope.getScreenHeight = function () {
    var screenHeight = 0;
    screenHeight = $window.innerHeight;
    return screenHeight;
  }

  $scope.getPageHeaderHeight = function () {
    var pageHeaderHeight = 0;
    var pageHeaders = jQuery('.page-header');
    jQuery(pageHeaders).each(function () {
      pageHeaderHeight += jQuery(this).height();
    })
    return pageHeaderHeight;
  }

  $scope.getNavHeight = function () {
    var navHeight = 0;
    var nav = jQuery('div.navbar-container');
    navHeight = jQuery(nav).height();
    return navHeight;  
  }

  $scope.getBannerHeight = function () {
    var bannerHeight = 0;
    var screenHeight = $scope.getScreenHeight();
    var pageHeaderHeight = $scope.getPageHeaderHeight();
    var navHeight = $scope.getNavHeight();
    bannerHeight = screenHeight - (navHeight + pageHeaderHeight);
    return bannerHeight;
  }

  $scope.getPanelHeight = function () {
    var panelHeight = 0;
    var panel = jQuery('div#blurb');
    panelHeight = document.getElementById('blurb').clientHeight;
    return panelHeight;
  }

  $scope.getPanelMargin = function () {

    // get the margin-top to be applied to keep divs vertically centered in the banner
    var bannerHeight,
        panelHeight,
        panelMargin,
        navHeight,
        nonPanelBannerHeight = 0;

    bannerHeight = $scope.getBannerHeight();
    panelHeight = $scope.getPanelHeight();
    navHeight = $scope.getNavHeight();
    nonPanelBannerHeight = bannerHeight - panelHeight;
    panelMargin = (nonPanelBannerHeight / 2) + navHeight;
    return panelMargin;
  }

   $scope.login = function() {

      // From now on you can use the Facebook service just as Facebook api says
      Facebook.login(function(response) {
        // Do something with response.
        console.log(response);
      });
    };

    $scope.data = {};
    $scope.data.myTestURL= 'http://www.theguardian.com';
    
  }]);



