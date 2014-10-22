angular.module("theHideoutApp")
  .constant('eventListPageCount', 3)
  .controller("eventCtrl", ['$scope', '$filter', 'eventListPageCount', 'eventService', function ($scope, $filter, eventListPageCount, eventService) {




    // GET THE DATA
    eventService.getAllEvents().success(function(events) {
      $scope.events = events;

      //Convert the timestamp to millseconds
      for (var i = 0; i < $scope.events.length; i++) {
        $scope.events[i].date_of_event = $scope.events[i].date_of_event * 1000;
      };
     
    });


  // FILTER BY CATEGORY

    var selectedCategory = null; // no filtering applied until one of the category buttons is clicked: see categoryFilterFn


    $scope.selectCategory = function (newCategory) {
      selectedCategory = newCategory;
      console.log(selectedCategory);
    }; 

    $scope.categoryFilterFn = function (event) {
      // This will return false if both conditions are false, true otherwise.
      console.log (event.category);
      console.log(selectedCategory);
      return  selectedCategory == null ||
              event.category == selectedCategory;
    }


  // PAGINATION
     $scope.selectedPage = 1;
     $scope.pageSize = eventListPageCount;
 
  }]);



