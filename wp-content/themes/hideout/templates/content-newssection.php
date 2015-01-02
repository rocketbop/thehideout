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
          <div class="col-md-9 col-md-offset-3 col-lg-9">
          <a href="{{newsPost.link}}"><h2>{{newsPost.title | date: 'medium' }}</h2></a>
        </div>
        </div>
      </div>
    </div>

      </a>
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-9">
          
          <strong><h5 class="date">Posted: {{newsPost.date | date: 'medium' }}</h5></strong>
          <span  ng-bind-html="newsPost.content"></span>
          <img class="separator" ng-src="{{templateDirectory}}images/design/pint-separator.png">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-9 col-xs-offset-3">
        <dir-pagination-controls on-page-change="scrollTo(newPageNumber)"></dir-pagination-controls>
        
      </div>
    </div>

  
</div>