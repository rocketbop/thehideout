angular.module("theHideoutApp")
  .constant('newsPostListPageCount', 2) // items per page
  .constant("newsPostListActiveClass", "btn-primary")
  .controller("newsCtrl", ['$scope', '$filter', '$q', '$log', 'newsPostListPageCount', 'apiService', 'globalService', 'newsPostListActiveClass', 'templateDirectory', function ($scope, $filter, $q, $log, newsPostListPageCount, apiService, globalService, newsPostListActiveClass, templateDirectory) {



    
    // GET THE DATA

      $scope.dataPromise = apiService.getAllNewsPosts().success(function(newsPosts) {
      $scope.data.newsPosts = newsPosts;

     
      console.log($scope.data.newsPosts);
     //  $scope.data.filterednewsPosts = $filter('orderBy')($scope.data.newsPosts, 'date');
     //  $scope.data.filterednewsPosts = $filter('limitTo')($scope.data.filterednewsPosts, '3');
      

    

        
     // console.log($scope.data.filterednewsPosts);

    });

      
    // $scope.getPromise = function () {
    //     var promise = $q.defer();

    //     if ($scope.data.filterednewsPosts) {
    //       promise.resolve($scope.data.filterednewsPosts)
    //       console.log("Did resolve");
    //     } else {
    //       promise.reject("Didn't resolve");

    //     }
        
    //     return promise.promise;
      
    //    }

    //    $scope.promise = $scope.getPromise();




    $scope.scrollTo = function (newPageNumber) {
      jQuery('html,body').animate({scrollTop: jQuery("#content-top").offset().top-100},'slow');
    }

    $scope.templateDirectory = templateDirectory;
    
    $scope.testUrl = 'http://localhost:8888/wp-content/uploads/2014/10/Christ-The-Redeemer-Statue-Rio-de-Janeiro-Brazil-wide-wallpapers-300x187.jpg';


    // $scope.newsImageDefault = templateDirectory + 'images/design/news-default-image.png';
    $scope.newsImageDefault210X140 = templateDirectory + 'images/design/hideout-2005-210x140.jpg';
     

  }]);



