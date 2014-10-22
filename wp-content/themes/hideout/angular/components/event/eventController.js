angular.module("theHideoutApp")
  .constant('eventListPageCount', 3)
  .constant("productListActiveClass", "btn-primary")
  .controller("eventCtrl", ['$scope', '$filter', 'eventListPageCount', 'eventService', 'productListActiveClass', function ($scope, $filter, eventListPageCount, eventService, productListActiveClass) {




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

    $scope.selectedCategory = "All";
    
    $scope.selectCategory = function (newCategory) {
      
      selectedCategory = newCategory;
      // Make the current category available in the scope. Note $scope.selectedCategory != selectedCategory within the controller
      if (newCategory == undefined) {
        $scope.selectedCategory = "All";
      } else {
      $scope.selectedCategory = selectedCategory;
      }

    }; 

    $scope.categoryFilterFn = function (event) {
      // This will return false if both conditions are false, true otherwise.
      return  selectedCategory == null ||
              event.category == selectedCategory;
    }

    // Return the active class if the item matches the selected category, or return an empty string
    $scope.getCategoryClass = function (category) {
      return (selectedCategory == category) ? productListActiveClass : "";
    }


  // PAGINATION
     $scope.selectedPage = 1;
     $scope.pageSize = eventListPageCount;
 
  }]);



