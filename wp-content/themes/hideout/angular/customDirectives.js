angular.module("theHideoutApp")
  .directive("myDivHeight", function ($window) {

    function setDivHeight(element, attrs) {
      var divHeightClass = attrs["myDivHeight"],
          windowHeight = '',
          pageHeaderHeight = ''
          imageHeight = 0;
      
      if (attrs["minusHeader"] === 'true') {
        pageHeaderHeight = jQuery(".page-header-top").height();
        pageHeaderHeight += jQuery(".page-header-bottom").height();
      } else {
        pageHeaderHeight = 0;
        console.log(pageHeaderHeight);
      }
      if (attrs['minusModuleHeader'] === 'true') {
        pageHeaderHeight += jQuery(".module-header").height();
      }
       var calculateDivHeight = function (divHeightClass) {
        if (divHeightClass == 'full') {
          windowHeight = $window.innerHeight - pageHeaderHeight;
        }
        if (divHeightClass == 'navbar') {
          windowHeight = jQuery(".navbar-container").height();
        }
        return windowHeight;
      }
      imageHeight = calculateDivHeight(divHeightClass);
      element.css('height', imageHeight + "px");
    }
    return {
      link: function (scope, element, attrs) {        
        jQuery(window).load(setDivHeight(element, attrs));
        angular.element($window).on('resize', function () {
          setDivHeight(element, attrs);
        });
      }
    }
  })
  .directive("myVerticalCenter", function () {

    function getPanelMargin(scope, element) {
      var panelMargin = 0;
      var panelMargin = scope.fctn();

      applyCss(panelMargin, element);

    }

    function applyCss(panelMargin, element) {
      var marginTop = panelMargin;
      element.css('margin-top', marginTop + "px")
    }

    return {
      scope: {
        fctn: '&extFunction'
      },
      link: function (scope, element, attrs) {
        jQuery(document).ready(getPanelMargin(scope, element));
        
      }
    }

  })
  .directive("newsBackgroundImage", ['$filter', function ($filter) {

    // get access to the controller scope. 

    function applyCss(scope, element, attrs) {
      var itemNumber = attrs["newsBackgroundImage"] - 1; // reduce by one for array logic
      var url = scope.data.filteredNewsPosts[itemNumber].featured_image.attachment_meta.sizes.eventboard.url;
      console.log(url);
      var urlParam = 'url(' + url + ')';
      // console.log(urlParam);
      // console.log(itemNumber);

      element.css('background-image', urlParam);
      // console.log(urlParam);

    }

    return {
      link: function (scope, element, attrs) {
        scope.dataPromise.success(function() {
          scope.data.filteredNewsPosts = $filter('orderBy')(scope.data.newsPosts, '-date');
          scope.data.filteredNewsPosts = $filter('limitTo')(scope.data.filteredNewsPosts, '4');
          applyCss(scope, element, attrs);
        })
        

      }
    }
  }]);