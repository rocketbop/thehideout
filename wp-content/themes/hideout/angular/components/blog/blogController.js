angular.module("theHideoutApp")
  .constant('blogPostListPageCount', 2) // items per page
  .constant("blogPostListActiveClass", "btn-primary")
  .controller("blogCtrl", ['$scope', '$filter', '$log', 'blogPostListPageCount', 'apiService', 'globalService', 'blogPostListActiveClass', 'templateDirectory', function ($scope, $filter, $log, blogPostListPageCount, apiService, globalService, blogPostListActiveClass, templateDirectory) {

    // GET THE DATA

    apiService.getAllBlogPosts().success(function(blogPosts) {
      $scope.data = {};
      $scope.data.blogPosts = blogPosts;
     
     console.log($scope.data.blogPosts);
     //console.log($scope.data.blogPosts[0].featured_image.attachment_meta.sizes.thumbnail.url)

    });

    $scope.scrollTo = function (newPageNumber) {
      jQuery('html,body').animate({scrollTop: jQuery("#content-top").offset().top-100},'slow');
    }


    // $scope.newsImageDefault = templateDirectory + 'images/design/news-default-image.png';
    $scope.newsImageDefault210X140 = templateDirectory + 'images/design/hideout-2005-210x140.jpg';
     

  }]);



