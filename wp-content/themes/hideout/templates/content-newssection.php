<div id="content-top" class="news-section">

    <div dir-paginate="newsPost in data.newsPosts | itemsPerPage: 2" class="news-item">
      <img class="featured-image" ng-src="{{newsPost.featured_image.attachment_meta.sizes.eventboard.url}}">
      <a href="{{newsPost.link}}"><h2>{{newsPost.title | date: 'medium' }}</h2></a>
      <h6>{{newsPost.date | date: 'medium' }}</h6>
      <!-- <h6>{{stringToDate(blogPost.date) | date: 'medium'}}</h6> <!-- Example of making a function call within angular -->
      <span  ng-bind-html="newsPost.content"></span>
      <img class="separator" ng-src="{{templateDirectory}}images/design/pint-separator.png">
    </div>


    <dir-pagination-controls on-page-change="scrollTo(newPageNumber)"></dir-pagination-controls>
  
</div>