<!DOCTYPE html>
<html>
<head lang="en">
    @include("/blog/Base/meta")
</head>
<body>
@include("/blog/Base/header")

<div class="am-g am-g-fixed blog-g-fixed">
  <div class="col-md-8">
    @foreach($data as $article)
        <article class="blog-main" style="height: 280px;">
          <h3 class="am-article-title blog-title">
            <a href="#">{{$article['title']}}</a>
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
        </article>
        <hr class="am-article-divider blog-hr">
    @endforeach
    <hr class="am-article-divider blog-hr">
    <ul class="am-pagination blog-pagination" style="float:right;">
        @if(!empty($data))
        {{$paginate->render()}}
        @endif
    </ul>
  </div>

    @include("/blog/Base/right")
</div>

@include("/blog/Base/footer")
</body>
</html>
