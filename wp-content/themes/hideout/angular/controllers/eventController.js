angular.module("theHideoutApp")
	.constant("eventUrl", "http://localhost:8888/thehideout/wp-json/posts?filter[category_name]=events")
  .constant("eventListPageCount", 3)
	.controller("eventCtrl", function ($scope, $filter, $http, eventUrl, eventListPageCount) {
	  
  // GET THE DATA
	  $scope.data = {};

	  $http.get(eventUrl)
	  	.success(function (data) {
	  		$scope.data.events = data;

        console.log($scope.data.events);
        for(var i = 0; i < $scope.data.events.length; i++) {
          console.log($scope.data.events[i].meta.date_of_event);

          // Convert json timestamp to date object
          $scope.data.events[i].meta.date_of_event = new Date($scope.data.events[i].meta.date_of_event * 1000);
          console.log(angular.isDate($scope.data.events[i].meta.date_of_event));
          console.log($scope.data.events[i].meta.date_of_event);
        };
	  		
	  	})
	  	.error(function (error) {
	  		$scope.data.error = error;
	  	});

  // FILTER BY CATEGORY

    var selectedCategory = null;


    $scope.selectCategory = function (newCategory) {
      selectedCategory = new Category;
    }; 

    $scope.categoryFilterFn = function () {

    };


	// PAGINATION
     $scope.selectedPage = 1;
     $scope.pageSize = eventListPageCount;

	});
