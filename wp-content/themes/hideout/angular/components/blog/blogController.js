angular.module("theHideoutApp")
  .constant('blogListPageCount', 2) // items per page
  .constant("blogListActiveClass", "btn-primary")
  .controller("blogCtrl", ['$scope', '$filter', '$log', 'blogListPageCount', 'apiService', 'globalService', 'blogListActiveClass', 'templateDirectory', function ($scope, $filter, $log, blogListPageCount, apiService, globalService, blogListActiveClass, templateDirectory) {

    // GET THE DATA

    apiService.getAllBlogPosts().success(function(blogPosts) {
      $scope.data = {};
      $scope.data.blogPosts = blogPosts;
     
     console.log($scope.data.blogPosts);
     //console.log($scope.data.blogPosts[0].featured_image.attachment_meta.sizes.thumbnail.url)

    });

    $scope.checkConsole = function () {
      globalService.checkConsole();
    };

    $scope.setTopBackgroundHeight = function (screenProportion, targetDiv) {
      globalService.setTopBackgroundHeight(screenProportion, targetDiv);
    };

    // Set up the BlogPage view
    $scope.viewBlogPage = function () {

        $scope.setTopBackgroundHeight("half", ".background-container");
        jQuery(window).resize($scope.setTopBackgroundHeight("half", ".background-container"));
    };

    $scope.logMe = function (message) {
      console.log(message);
      // console.log(message.large)
    };
     // $scope.$log = $log;

     $scope.stringToDate = function (message) {
      var date = new Date(message);
      return date;
     };

    // $scope.newsImageDefault = templateDirectory + 'images/design/news-default-image.png';
    $scope.newsImageDefault210X140 = templateDirectory + 'images/design/hideout-2005-210x140.jpg';
     

  // FILTER BY CATEGORY

  //   var selectedCategory = null; // no filtering applied until one of the category buttons is clicked: see categoryFilterFn

  //   $scope.selectedCategory = "All";
    
  //   $scope.selectCategory = function (newCategory) {

  //     selectedCategory = newCategory;
  //     $scope.selectedPage = 1; // Go to page 1 on new category selection
  //     // Make the current category available in the scope. Note $scope.selectedCategory != selectedCategory within the controller
  //     if (newCategory == undefined) {
  //       $scope.selectedCategory = "All";
  //     } else {
  //     $scope.selectedCategory = selectedCategory;
  //     }

  //   }; 

  //   $scope.selectPage = function (newPage) {
  //     $scope.selectedPage = newPage;
  //   }

  //   $scope.categoryFilterFn = function (event) {
  //     // This will return false if both conditions are false, true otherwise.
  //     return  selectedCategory == null ||
  //             event.category == selectedCategory;
  //   }

  //   // Return the active class if the item matches the selected category, or return an empty string
  //   $scope.getCategoryClass = function (category) {
  //     return (selectedCategory == category) ? eventListActiveClass : "";
  //   }

  //   $scope.getPageClass = function (page) {
  //     return $scope.selectedPage == page ? eventListActiveClass : "";
  //   }


  // // PAGINATION
  //    $scope.selectedPage = 1; // Initial, or on page reload
  //    $scope.pageSize = eventListPageCount;

  }]);



