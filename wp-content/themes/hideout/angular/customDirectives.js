angular.module("theHideoutApp")
  .directive("myDivHeight", function ($window) {

    function setDivHeight(element, attrs) {
      
      var screenProportion = attrs["myDivHeight"];
      console.log(attrs["myDivHeight"]);
      var windowHeight;
      
      switch (screenProportion) {
        case "fullScreen":
        heightModifier = 1;
        break;
        case "half":
        heightModifier = 0.5;
        break
          default:
          heightModifier = 1;
      }

      // windowHeight = jQuery(window).get(0).innerHeight * heightModifier;
      windowHeight = $window.innerHeight * heightModifier;
      console.log(heightModifier);
      console.log(windowHeight);
      element.css('height', windowHeight + "px");

    }

    return {
      link: function (scope, element, attrs) {
        setDivHeight(element, attrs);
   
        angular.element($window).on('resize', function () {
          setDivHeight(element, attrs);
        });

      }
    }


  });


