angular.module("theHideoutApp")
  .constant('eventListPageCount', 2) // items per page
  .constant("eventListActiveClass", "btn-primary")
  .controller("eventCtrl", ['$scope', '$filter', 'eventListPageCount', 'apiService', 'eventListActiveClass', function ($scope, $filter, eventListPageCount, apiService, eventListActiveClass) {

    // GET THE DATA
    apiService.getAllEvents().success(function(data) {
      $scope.data = {};
      $scope.data.events = data;

      //Convert the timestamp to millseconds
      for (var i = 0; i < $scope.data.events.length; i++) {
        $scope.data.events[i].date_of_event = $scope.data.events[i].date_of_event * 1000;
      };
     
     console.log($scope.data.events);
    });


  // FILTER BY CATEGORY

    var selectedCategory = null; // no filtering applied until one of the category buttons is clicked: see categoryFilterFn

    $scope.selectedCategory = "All";
    
    $scope.selectCategory = function (newCategory) {

      selectedCategory = newCategory;
      $scope.selectedPage = 1; // Go to page 1 on new category selection
      // Make the current category available in the scope. Note $scope.selectedCategory != selectedCategory within the controller
      if (newCategory == undefined) {
        $scope.selectedCategory = "All";
      } else {
      $scope.selectedCategory = selectedCategory;
      }

    }; 

    $scope.selectPage = function (newPage) {
      $scope.selectedPage = newPage;
    }

    $scope.categoryFilterFn = function (event) {
      // This will return false if both conditions are false, true otherwise.
      return  selectedCategory == null ||
              event.category == selectedCategory;
    }

    // Return the active class if the item matches the selected category, or return an empty string
    $scope.getCategoryClass = function (category) {
      return (selectedCategory == category) ? eventListActiveClass : "";
    }

    $scope.getPageClass = function (page) {
      return $scope.selectedPage == page ? eventListActiveClass : "";
    }


  // PAGINATION
     $scope.selectedPage = 1; // Initial, or on page reload
     $scope.pageSize = eventListPageCount;

  }]);



