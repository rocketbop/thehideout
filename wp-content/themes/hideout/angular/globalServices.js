angular.module("theHideoutApp")
  .factory("globalService", function () {

    return {
      checkConsole: function () {
        console.log("Check 1");
      },

      // Takes full or half for screenProprtion, and the css specifier for its second
      setTopBackgroundHeight: function (screenProportion, targetDiv) {

        var heightModifier,
            windowHeight;

        // check how much of the screen should take up
        switch (screenProportion) {
          case "full":
          heightModifier = 1;
          break;
          case "half":
          heightModifier = 0.5;
          break
          default:
          heightModifier = 1;
        }

        windowHeight = jQuery(window).get(0).innerHeight * heightModifier;
        jQuery(targetDiv).css('height', windowHeight);    
      }
    };
  });