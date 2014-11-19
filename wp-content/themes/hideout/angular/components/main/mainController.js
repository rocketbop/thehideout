angular.module("theHideoutApp")
.controller("mainCtrl", ['$scope', '$filter', '$window', '$log', 'apiService', 'globalService', 'templateDirectory', function ($scope, $filter, $window, $log, apiService, globalService, templateDirectory) {
  
  $scope.templateDirectory = templateDirectory;

  $scope.getScreenHeight = function () {

    return $window.innerHeight;

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
    var nav = jQuery('nav');

    navHeight = jQuery(nav).height();

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

    return bannerHeight;

  }

  
  
  }]);



