angular.module("theHideoutApp")
  .constant('eventListPageCount', 3)
  .controller("eventCtrl", ['$scope', '$filter', 'eventListPageCount', 'eventService', function ($scope, $filter, eventListPageCount, eventService) {

    // GET THE DATA
    eventService.getAllEvents().success(function(events) {
      $scope.events = events;
      console.log($scope.events);
    });


  // FILTER BY CATEGORY

    var selectedCategory = null;


    $scope.selectCategory = function (newCategory) {
      selectedCategory = new Category;
    }; 

    $scope.categoryFilterFn = function (event) {
      // This will return false if both conditions are false, true otherwise.
      return  selectedCategory == null ||
              event.meta.category == selectedCategory;
    }


  // PAGINATION
     $scope.selectedPage = 1;
     $scope.pageSize = eventListPageCount;
 
  }]);



