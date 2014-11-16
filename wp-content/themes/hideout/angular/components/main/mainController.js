angular.module("theHideoutApp")
.controller("mainCtrl", ['$scope', '$filter', '$log', 'apiService', 'globalService', 'templateDirectory', function ($scope, $filter, $log, apiService, globalService, templateDirectory) {

    console.log("Hello");
    // $scope.setTopBackgroundHeight = function (screenProportion, targetDiv) {
    //   globalService.setTopBackgroundHeight(screenProportion, targetDiv);
    // };



    // $scope.setTopBackgroundHeight("full", ".front-page-top-background");
    // jQuery(window).resize($scope.setTopBackgroundHeight("full", ".front-page-top-background"));

  }]);



