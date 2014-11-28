angular.module("theHideoutApp")
  .constant('eventListPageCount', 2) // items per page
  .constant("eventListActiveClass", "btn-primary")
  .controller("eventCtrl", ['$scope', '$filter', 'eventListPageCount', 'apiService', 'eventListActiveClass', function ($scope, $filter, eventListPageCount, apiService, eventListActiveClass) {

    // GET THE DATA
    $scope.dataPromise = apiService.getAllEvents().success(function(data) {
      $scope.data = {}; // create the data object
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
      $scope.scrollTo("entries");
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

    $scope.scrollTo = function (id) {
      jQuery('html,body').animate({scrollTop: jQuery("#" + id).offset().top},'slow');
    }


  // PAGINATION
    $scope.selectedPage = 1; // Initial, or on page reload
    $scope.pageSize = eventListPageCount;

  // SINGLE POSTS

    $scope.getSinglePostArrayNumber = function () {

      for (var i = 0; i < $scope.data.events.length; i++) {
        if ($scope.data.events[i].ID == $scope.singlePostID) {
          var arrayNumber = i;
        }
      }
      return arrayNumber;
    }

    // Will only be a number on single app page calls
    if (angular.isNumber($scope.singlePostID)) {
      $scope.dataPromise.success(function () {
        $scope.singlePostArrayNumber = $scope.getSinglePostArrayNumber();
        console.log($scope.singlePostArrayNumber);
        $scope.singlePostEventName = $scope.data.events[$scope.singlePostArrayNumber].event_name;
      })
      
    } else {
      console.log("Why me");
    }
    


  }]);



