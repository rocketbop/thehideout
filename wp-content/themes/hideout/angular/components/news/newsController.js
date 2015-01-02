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

      

    $scope.scrollTo = function (newPageNumber) {
      jQuery('html,body').animate({scrollTop: jQuery("#content-top").offset().top-100},'slow');
    }

    $scope.templateDirectory = templateDirectory;
    
    $scope.testUrl = 'http://localhost:8888/wp-content/uploads/2014/10/Christ-The-Redeemer-Statue-Rio-de-Janeiro-Brazil-wide-wallpapers-300x187.jpg';


    // $scope.newsImageDefault = templateDirectory + 'images/design/news-default-image.png';
    $scope.newsImageDefault210X140 = templateDirectory + 'images/design/hideout-2005-210x140.jpg';

      // SINGLE POSTS

    $scope.getSinglePostArrayNumber = function () {
      for (var i = 0; i < $scope.data.newsPosts.length; i++) {
        if ($scope.data.newsPosts[i].ID == $scope.singlePostID) {
          var arrayNumber = i;
        }
      }
      return arrayNumber;
    }

    $scope.getSinglePost = function () {

      // expose the singlepost object to the view
      $scope.dataPromise.success(function () {
        $scope.singlePostArrayNumber = $scope.getSinglePostArrayNumber();
        $scope.singlePost = $scope.data.newsPosts[$scope.singlePostArrayNumber]; 
      })
    }

    // Will only be a number on single app page calls
    if (angular.isNumber($scope.singlePostID)) {
      $scope.getSinglePost();
    } else {
      // console.log("single post ID not received");
    }
     

  }]);



