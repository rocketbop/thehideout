angular.module("theHideoutApp")
	.constant("eventUrl", "http://localhost:8888/thehideout/wp-json/posts?filter[category_name]=events")
	.controller("eventCtrl", function ($scope, $http, eventUrl) {
	  
	  $scope.data = {};

	  $http.get(eventUrl)
	  	.success(function (data) {
	  		$scope.data.events = data;

	  		console.log($scope.data.events);
	  	})
	  	.error(function (error) {
	  		$scope.data.error = error;
	  	});

	  //$scope.	
	});
