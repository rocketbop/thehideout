<div id="content-top" class="news-section">

    <div dir-paginate="newsPost in data.newsPosts | itemsPerPage: 2" class="news-item">
    <div class="image-title">
      <div class="item-image-wrapper">
        <a href="{{newsPost.link}}">
          <img class="featured-image" ng-src="{{newsPost.featured_image.attachment_meta.sizes.eventboard.url}}">
        </a>
      </div>
      <div class="title">
        <div class="row">
          <div class="col-md-8 col-md-offset-4 col-lg-8">
          <a href="{{newsPost.link}}"><h2>{{newsPost.title | date: 'medium' }}</h2></a>
        </div>
        </div>
      </div>
    </div>

      </a>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4 col-lg-8">
          
          <h5>Posted: {{newsPost.date | date: 'medium' }}</h5>
          <span  ng-bind-html="newsPost.content"></span>
          <img class="separator" ng-src="{{templateDirectory}}images/design/pint-separator.png">
        </div>
      </div>
    </div>

    <dir-pagination-controls on-page-change="scrollTo(newPageNumber)"></dir-pagination-controls>
  
</div>