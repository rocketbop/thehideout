angular.module("theHideoutApp")
  .constant('blogPostListPageCount', 2) // items per page
  .constant("blogPostListActiveClass", "btn-primary")
  .controller("blogCtrl", ['$scope', '$filter', '$q', '$log', 'blogPostListPageCount', 'apiService', 'globalService', 'blogPostListActiveClass', 'templateDirectory', function ($scope, $filter, $q, $log, blogPostListPageCount, apiService, globalService, blogPostListActiveClass, templateDirectory) {



    
    // GET THE DATA

      $scope.dataPromise = apiService.getAllBlogPosts().success(function(blogPosts) {
      $scope.data = {};
      $scope.data.blogPosts = blogPosts;

     
     //  console.log($scope.data.blogPosts);
     //  $scope.data.filteredBlogPosts = $filter('orderBy')($scope.data.blogPosts, 'date');
     //  $scope.data.filteredBlogPosts = $filter('limitTo')($scope.data.filteredBlogPosts, '3');
      

    

        
     // console.log($scope.data.filteredBlogPosts);

    });

      
    // $scope.getPromise = function () {
    //     var promise = $q.defer();

    //     if ($scope.data.filteredBlogPosts) {
    //       promise.resolve($scope.data.filteredBlogPosts)
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



