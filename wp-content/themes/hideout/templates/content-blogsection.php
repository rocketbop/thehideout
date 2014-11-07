<div class="blog-section">

    <div ng-repeat="blogPost in blogPosts" class="blog-item">
      <h2>{{blogPost.title}}</h2>
      <h6>{{blogPost.date}}</h6>
      <!-- <p>{{blogPost.content | ng-bind-html}}</p> -->
      <span ng-bind-html="blogPost.content"></span>
    </div>
  
</div>