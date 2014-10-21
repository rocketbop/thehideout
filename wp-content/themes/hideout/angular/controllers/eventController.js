angular.module("theHideoutApp")
	// .constant("eventUrl", "http://localhost:8888/thehideout/wp-json/posts?filter[category_name]=events")
 //  .constant("eventListPageCount", 3)
	.controller("eventCtrl", function ($scope, $filter, $http, eventUrl, eventListPageCount) {
	  
  // THE MODEL
	  $scope.data = {};

	  $http.get(eventUrl)
	  	.success(function (data) {
	  		$scope.data.events = data;
        console.log($scope.data.events);
        //$scope.data.events.push("hello");
        for(var i = 0; i < $scope.data.events.length; i++) {
          if ($scope.data.events[i].meta)
          var metadata = $scope.data.events[i].meta;
          //console.log(typeof meta);
          //console.log(metadata['category']);
          for (key in metadata) {
            console.log("Key is " + key + " Value is " + metadata[key]);
            $scope.data.events[i].push({key: metadata[key]});
          }
        };
       
        console.log("The events object: " + $scope.data.events[0].meta.category);
        for(var i = 0; i < $scope.data.events.length; i++) {

          // Convert json timestamp to date object
          $scope.data.events[i].meta.date_of_event = new Date($scope.data.events[i].meta.date_of_event * 1000);
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

    $scope.categoryFilterFn = function (event) {
      // This will return false if both conditions are false, true otherwise.
      return  selectedCategory == null ||
              event.meta.category == selectedCategory;
    }


	// PAGINATION
     $scope.selectedPage = 1;
     $scope.pageSize = eventListPageCount;

	});
