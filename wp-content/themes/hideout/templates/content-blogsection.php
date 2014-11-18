<div id="content-top" class="blog-section">

    <div dir-paginate="blogPost in data.blogPosts | itemsPerPage: 2" class="blog-item">
      <a href="{{blogPost.link}}"><h2>{{blogPost.title | date: 'medium' }}</h2></a>
      <h6>{{blogPost.date | date: 'medium' }}</h6>
      <!-- <h6>{{stringToDate(blogPost.date) | date: 'medium'}}</h6> <!-- Example of making a function call within angular -->
      <span  ng-bind-html="blogPost.content"></span>
    </div>


    <dir-pagination-controls on-page-change="scrollTo(newPageNumber)"></dir-pagination-controls>
  
</div>