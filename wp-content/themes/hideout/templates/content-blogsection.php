<div class="blog-section">

    <div ng-repeat="blogPost in blogPosts" class="blog-item">
      <h2>{{blogPost.title}}</h2>
      <h6>{{blogPost.date}}</h6>
      <p>{{blogPost.content}}</p>
    </div>
  
</div>