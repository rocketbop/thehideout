<div class="blog-section">

    <div ng-repeat="blogPost in data.blogPosts" class="blog-item">
      <a href="{{blogPost.link}}"><h2>{{blogPost.title | date: 'medium' }}</h2></a>
      <h6>{{blogPost.date | date: 'medium' }}</h6>
      <!-- <h6>{{stringToDate(blogPost.date) | date: 'medium'}}</h6> <!-- Example of making a function call within angular -->
      <span ng-bind-html="blogPost.content"></span>
    </div>
  
</div>