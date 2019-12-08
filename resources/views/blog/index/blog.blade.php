<!DOCTYPE html>
<html>
<head lang="en">
  @include("/blog/Base/meta")
</head>
<body>

{{--header部分--}}
@include("/blog/Base/header")

<div class="am-g am-g-fixed blog-g-fixed">
  <div class="col-md-8">
    @foreach($articles as $article)
        <article class="blog-main" style="height: 280px; margin-bottom:100px;">
          <h3 class="am-article-title blog-title">
            <a href="/blog/show/{{$article['id']}}">{{$article['title']}}</a>
          </h3>
          <h4 class="am-article-meta blog-meta"><span class="glyphicon glyphicon-user" style=""></span>&nbsp;作者：{{$article['author']}}</h4>

          <div class="am-g blog-content">
            <div class="col-lg-7">
              <p>{{$article['description']}}</p>
            </div>
            <div class="col-lg-5" style="position: relative; bottom:50px;">
              <p><img src="http://www.blog.com/{{$article['smallImage']}}"></p>
            </div>

              <h4 class="am-article-meta blog-meta" style="margin-left:17px; color:grey;">发布日期：{{$article['createdAt']}}</h4>
              <a href="#" style="float:right;  position: relative; bottom:40px; right:30px;">点击阅读</a>
          </div>
            <hr class="am-article-divider blog-hr">
        </article>

    @endforeach

    <ul class="am-pagination blog-pagination">
{{--      <li class="am-pagination-prev"><a href="">&laquo; 上一页</a></li>--}}
{{--      <li class="am-pagination-next"><a href="">下一页 &raquo;</a></li>--}}
    </ul>
  </div>

  @include("/blog/Base/right")

</div>

@include("/blog/Base/footer")
</body>
</html>
