angular.module("theHideoutApp")
  .directive("myDivHeight", function ($window) {

    function setDivHeight(element, attrs) {
      
      var screenProportion = attrs["myDivHeight"];
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

      windowHeight = $window.innerHeight * heightModifier;
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


