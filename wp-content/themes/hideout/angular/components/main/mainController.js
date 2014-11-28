angular.module("theHideoutApp")
.controller("mainCtrl", ['$scope', '$filter', '$window', '$log', 'apiService', 'globalService', 'templateDirectory', function ($scope, $filter, $window, $log, apiService, globalService, templateDirectory) {
  
  $scope.templateDirectory = templateDirectory;

  

  // called by ng-init in templates/content-singlepost.php
  $scope.getSinglePostData = function (postCategory, postID) {

    $scope.singlePostCategory = postCategory;
    $scope.singlePostID = postID;
    console.log($scope.singlePostCategory);

  }
  $scope.sidebarUrl = templateDirectory + "sidebar.php";
  $scope.eventPartial = templateDirectory + "angular/partials/singlepostevent.php";
  $scope.blogPartial = templateDirectory + "angular/partials/singlepostblog.php";


  $scope.getPartial = function () {
    var partial;
    console.log("Didn't match");
    if ($scope.singlePostCategory == 'Events') {
      partial = templateDirectory + "angular/partials/singlepostevent.html";
      console.log("It matced");
    }
    else {
      console.log("Didn't match");
    }
    return partial;
  }

  console.log($scope.singlePostCategory);

  $scope.getScreenHeight = function () {
    var screenHeight = 0;
    screenHeight = $window.innerHeight;
    console.log("Screenheight:"+screenHeight);
    return screenHeight;
  }

  $scope.getPageHeaderHeight = function () {

    var pageHeaderHeight = 0;
    var pageHeaders = jQuery('.page-header');

    jQuery(pageHeaders).each(function () {
      pageHeaderHeight += jQuery(this).height();
    })
    console.log("PageHeaderHeight:"+ pageHeaderHeight);
    return pageHeaderHeight;

  }

  $scope.getNavHeight = function () {

    var navHeight = 0;
    var nav = jQuery('div.navbar-container');

    navHeight = jQuery(nav).height();
    console.log("NavHeight:"+navHeight);

    return navHeight;  

  }

  $scope.getBannerHeight = function () {

    var bannerHeight = 0;
    var screenHeight = $scope.getScreenHeight();
    var pageHeaderHeight = $scope.getPageHeaderHeight();
    var navHeight = $scope.getNavHeight();

    console.log(screenHeight);
    console.log(pageHeaderHeight);
    console.log(navHeight);

    bannerHeight = screenHeight - (navHeight + pageHeaderHeight);
    console.log("BannerHeight:"+bannerHeight);
    return bannerHeight;

  }

  $scope.getPanelHeight = function () {

    var panelHeight = 0;
    var panel = jQuery('div#blurb');

    // panelHeight = jQuery(panel).height();
    panelHeight = document.getElementById('blurb').clientHeight;
      console.log("PanelHeight:"+panelHeight);
    return panelHeight;


  }

  $scope.getPanelMargin = function () {
    // get the margin-top to be applied to keep divs vertically centered in the banner
    var bannerHeight = 0;
    var panelHeight = 0;
    var panelMargin = 0;
    var navHeight = 0;
    var nonPanelBannerHeight = 0;

    bannerHeight = $scope.getBannerHeight();
    panelHeight = $scope.getPanelHeight();
    navHeight = $scope.getNavHeight();

    nonPanelBannerHeight = bannerHeight - panelHeight;
    panelMargin = (nonPanelBannerHeight / 2) + navHeight;
    console.log("PanelMargin:"+panelMargin);
    return panelMargin;

  }

  
  
  }]);



