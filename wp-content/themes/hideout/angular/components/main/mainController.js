angular.module("theHideoutApp")
.controller("mainCtrl", ['$scope', '$filter', '$window', '$log', 'apiService', 'globalService', 'templateDirectory', function ($scope, $filter, $window, $log, apiService, globalService, templateDirectory) {

    console.log("Hello");

    $scope.$watch(function(){
       return $window.innerWidth;
    }, function(value) {
       console.log(value);
   });
    // $scope.setTopBackgroundHeight = function (screenProportion, targetDiv) {
    //   globalService.setTopBackgroundHeight(screenProportion, targetDiv);
    // };



    // $scope.setTopBackgroundHeight("full", ".front-page-top-background");
    // jQuery(window).resize($scope.setTopBackgroundHeight("full", ".front-page-top-background"));

  }]);



