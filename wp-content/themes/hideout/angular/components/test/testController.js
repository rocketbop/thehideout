angular.module("theHideoutApp")
  .controller("testCtrl", ['$scope', 'eventService', function ($scope, eventService) {

    //$scope.events = eventService.getAllEvents()
    var myArray = [{ item: 50 }, { item: 30 }];
    eventService.getAllEvents().success(function(events) {
      $scope.events = events;
      console.log($scope.events);
    });

 
  }]);