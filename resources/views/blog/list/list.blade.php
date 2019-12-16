<!doctype html>
<html lang="zh-CN">
<head>
    @include('blog.Base.meta')
</head>

<body class="user-select">
    @include('blog.Base.header')
<section class="container">
  <div class="content-wrap">
    <div class="content">
      <div class="title">
        <h3>博文列表</h3>
      </div>
        @foreach($data as $article)
      <article class="excerpt excerpt-1"><a class="focus" href="article.html" title=""><img class="thumb" data-original="{{$article['smallImage']}}" src="{{$article['smallImage']}}" alt=""></a>
        <header><a class="cat" href="program">暂定<i></i></a>
          <h2><a href="article.html" title="">{{$article['title']}}</a></h2>
        </header>
        <p class="meta">
          <time class="time"><i class="glyphicon glyphicon-time"></i> {{$article['createdAt']}}</time>
          <span class="views"><i class="glyphicon glyphicon-eye-open"></i>{{$article['viewNumber']}}</span> </p>
        <p class="note">{{$article['description']}} </p>
      </article>
        @endforeach
      <nav class="pagination" style="display: block; float: left;">
            {{$paginate->render()}}
      </nav>
    </div>
  </div>
  <aside class="sidebar">
    <div class="fixed">
        @include('blog.Base.aside')
    </div>
  </aside>
</section>
<footer class="footer">
  <div class="container">
    <p>&copy; 2016 <a href="">ylsat.com</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">豫ICP备20151109-1</a> &nbsp; <a href="sitemap.xml" target="_blank" class="sitemap">网站地图</a></p>
  </div>
  <div id="gotop"><a class="gotop"></a></div>
</footer>


@include('blog.Base.footer')
<script type="text/javascript" src="{{asset('/static/blog')}}/index.js"></script>
</body>
</html>
