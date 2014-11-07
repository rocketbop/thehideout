<div class="blog-section">

    <div ng-repeat="blogPost in blogPosts" class="blog-item">
      <h2>{{blogPost.title | date: 'medium' }}</h2>
      <h6>{{blogPost.date | stringToDate:blogPost.date | date: 'medium' }}</h6>
      <!-- <h6>{{stringToDate(blogPost.date) | date: 'medium'}}</h6> <!-- Example of making a function call within angular --> -->
      <!-- <p>{{blogPost.content | ng-bind-html}}</p> -->
      <span ng-bind-html="blogPost.content"></span>
    </div>
  
</div>