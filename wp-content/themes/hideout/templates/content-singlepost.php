<!-- Pass some PHP data on the current post to Angular -->
<div ng-init="getSinglePostData('<?php echo $thisCategory; ?>', <?php echo $thisPostID; ?> )"></div>

<div ng-switch="singlePostCategory">
  <div ng-switch-when="Events">
    <div ng-include src="eventPartial">
    </div>
  </div>

  <div ng-switch-when="News">
    <div ng-include src="newsPartial">
    </div>
  </div>
  
</div>


