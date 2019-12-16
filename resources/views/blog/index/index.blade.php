<!doctype html>
<html lang="zh-CN">
<head>
    @include("blog.Base.meta")
</head>

<body class="user-select">
    @include("blog.Base.header")
<section class="container">
  <div class="content-wrap">
    <div class="content">
      <div class="jumbotron">
        <h1>欢迎访问异清轩博客</h1>
        <p>在这里可以看到前端技术，后端程序，网站内容管理系统等文章，还有我的程序人生！</p>
      </div>
      <div id="focusslide" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators" id="banner_btn">
{{--          <li data-target="#focusslide" data-slide-to="0" class="active"></li>--}}
{{--          <li data-target="#focusslide" data-slide-to="1"></li>--}}
{{--          <li data-target="#focusslide" data-slide-to="2"></li>--}}
        </ol>
        <div class="carousel-inner" role="listbox" id="bannerBox">
{{--          <div class="item active"> <a href="" target="_blank"><img src="{{asset("/static/blog")}}/images/banner/banner_01.jpg" alt="" class="img-responsive"></a>--}}
{{--            <!--<div class="carousel-caption"> </div>-->--}}
{{--          </div>--}}
{{--          <div class="item"> <a href="" target="_blank"><img src="{{asset("/static/blog")}}/images/banner/banner_02.jpg" alt="" class="img-responsive"></a>--}}
{{--            <!--<div class="carousel-caption"> </div>-->--}}
{{--          </div>--}}
{{--          <div class="item"> <a href="" target="_blank"><img src="{{asset("/static/blog")}}/images/banner/banner_03.jpg" alt="" class="img-responsive"></a>--}}
{{--            <!--<div class="carousel-caption"> </div>-->--}}
{{--          </div>--}}
        </div>
        <a class="left carousel-control" href="#focusslide" role="button" data-slide="prev" rel="nofollow"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">上一个</span> </a> <a class="right carousel-control" href="#focusslide" role="button" data-slide="next" rel="nofollow"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">下一个</span> </a> </div>
      <article class="excerpt-minic excerpt-minic-index">
        <h2><span class="red">【今日推荐】</span><a href="" title="">从下载看我们该如何做事</a></h2>
        <p class="note">一次我下载几部电影，发现如果同时下载多部要等上几个小时，然后我把最想看的做个先后排序，去设置同时只能下载一部，结果是不到一杯茶功夫我就能看到最想看的电影。 这就像我们一段时间内想干成很多事情，是同时干还是有选择有顺序的干，结果很不一样。同时...</p>
      </article>
      <div class="title">
        <h3>最新发布</h3>
{{--        <div class="more"><a href="">PHP</a><a href="">JavaScript</a><a href="">EmpireCMS</a><a href="">Apache</a><a href="">MySQL</a></div>--}}
        <div class="more"></div>
      </div>
        @foreach($articles as $article)
          <article class="excerpt excerpt-1"><a class="focus" href="/blog/show/{{$article['id']}}" title=""><img class="thumb" data-original="images/excerpt.jpg" src="{{$article['smallImage']}}" alt=""></a>
            <header><a class="cat" href="program">暂定<i></i></a>
              <h2><a href="/blog/show/{{$article['id']}}" title="">{{$article['title']}}</a></h2>
            </header>
            <p class="meta">
              <time class="time"><i class="glyphicon glyphicon-time"></i> {{$article['createdAt']}}</time>
              <span class="views"><i class="glyphicon glyphicon-eye-open"></i> {{$article['viewNumber']}}</span></p>
            <p class="note">{{$article['description']}}</p>
            </article>
        @endforeach


      <nav class="pagination" style="display: block; float: right;">
        {{$paginate->render()}}
      </nav>
    </div>
  </div>


  <aside class="sidebar">
    <div class="fixed">
      <div class="widget widget-tabs">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#notice" aria-controls="notice" role="tab" data-toggle="tab">网站公告</a></li>
{{--          <li role="presentation"><a href="#centre" aria-controls="centre" role="tab" data-toggle="tab">会员中心</a></li>--}}
          <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">联系站长</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane notice active" id="notice">
            <ul>
              <li>
                <time datetime="2016-01-04">01-04</time>
                <a href="" target="_blank">欢迎访问异清轩博客</a></li>
              <li>
                <time datetime="2016-01-sh04">01-04</time>
                <a target="_blank" href="">在这里可以看到前端技术，后端程序，网站内容管理系统等文章，还有我的程序人生！</a></li>
              <li>
                <time datetime="2016-01-04">01-04</time>
                <a target="_blank" href="">在这个小工具中最多可以调用五条</a></li>
            </ul>
          </div>
{{--          <div role="tabpanel" class="tab-pane centre" id="centre">--}}
{{--            <h4>需要登录才能进入会员中心</h4>--}}
{{--            <p> <a data-toggle="modal" data-target="#loginModal" class="btn btn-primary">立即登录</a> <a href="javascript:;" class="btn btn-default">现在注册</a> </p>--}}
{{--          </div>--}}
          <div role="tabpanel" class="tab-pane contact" id="contact">
            <h2>Email:<br />
              <a href="mailto:admin@ylsat.com" data-toggle="tooltip" data-placement="bottom" title="admin@ylsat.com">admin@ylsat.com</a></h2>
          </div>
        </div>
      </div>
        @include('blog.Base.aside')
  </aside>
</section>
<footer class="footer">
  <div class="container">
    <p>&copy; 2016 <a href="">ylsat.com</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">豫ICP备20151109-1</a> &nbsp; <a href="sitemap.xml" target="_blank" class="sitemap">网站地图</a></p>
  </div>
  <div id="gotop"><a class="gotop"></a></div>
</footer>
@include("blog.Base.footer")
<script type="text/javascript" src="{{asset('/static/blog')}}/index.js"></script>
</body>
</html>
