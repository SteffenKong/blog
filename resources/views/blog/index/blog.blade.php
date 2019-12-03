<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>Blog | SteffenKong 个人博客 专注分享IT技术</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="alternate icon" type="image/png" href="{{asset('/static/blog')}}/assets/i/favicon.png">
  <link rel="stylesheet" href="{{asset('/static/blog')}}/assets/css/amazeui.css"/>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
  <style>
    @media only screen and (min-width: 1200px) {
      .blog-g-fixed {
        max-width: 1200px;
      }
    }

    @media only screen and (min-width: 641px) {
      .blog-sidebar {
        font-size: 1.4rem;
      }
    }

    .blog-main {
      padding: 20px 0;
    }

    .blog-title {
      margin: 10px 0 20px 0;
    }

    .blog-meta {
      font-size: 14px;
      margin: 10px 0 20px 0;
      color: #222;
    }

    .blog-meta a {
      color: #27ae60;
    }

    .blog-pagination a {
      font-size: 1.4rem;
    }

    .blog-team li {
      padding: 4px;
    }

    .blog-team img {
      margin-bottom: 0;
    }

    .blog-footer {
      padding: 10px 0;
      text-align: center;
    }

    /* 标签云样式 */
      .tagCloud{
          display: inline-block;
          height:25px;
          border-radius:10px;
          text-align: center;
          margin:10px 0 0 5px;
          line-height: 25px;
          padding:0 5px 0 5px;
          color:white;
      }

    .tagCloud:hover {
        color:white;
        text-decoration: none;
    }
  </style>
</head>
<body>
<header class="am-topbar">
  <h1 class="am-topbar-brand" style="float:right;">
    <a href="#">Steffen个人博客</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
          data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
      class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav" style="margin-left:350px;">
      <li class="am-active"><a href="#">首页</a></li>
        @foreach($cates ?? [] as $cate)
            <li><a href="#">{{$cate['title']}}</a></li>
        @endforeach

        <li><a href="#">人生杂谈</a></li>
        <li><a href="#">关于作者</a></li>
{{--      <li class="am-dropdown" data-am-dropdown>--}}
{{--        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">--}}
{{--          菜单 <span class="am-icon-caret-down"></span>--}}
{{--        </a>--}}
{{--        <ul class="am-dropdown-content">--}}

{{--           <li><a href="#">关于我们</a></li>--}}
{{--        </ul>--}}
{{--      </li>--}}
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline am-topbar-right" role="search" style="float:left;">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="搜索博客">
      </div>
      <button type="submit" class="am-btn am-btn-default am-btn-sm glyphicon glyphicon-search"></button>
    </form>

  </div>
</header>

<div class="am-g am-g-fixed blog-g-fixed">
  <div class="col-md-8">
    @foreach($articles as $article)
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
          </div>s
        </article>
        <hr class="am-article-divider blog-hr">
    @endforeach
    <hr class="am-article-divider blog-hr">
    <ul class="am-pagination blog-pagination">
      <li class="am-pagination-prev"><a href="">&laquo; 上一页</a></li>
      <li class="am-pagination-next"><a href="">下一页 &raquo;</a></li>
    </ul>
  </div>

  <div class="col-md-4 blog-sidebar">
    <div class="am-panel-group">
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">标签云</div>
        <div class="am-panel-bd" id="tag">
{{--            <a href="#">Linux</a>--}}
        </div>
      </section>
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">推荐博客</div>
        <ul class="am-list blog-list" id="rec">
{{--          <li><a href="#">Google fonts 的字體（sans-serif 篇）</a></li>--}}
        </ul>
      </section>


        <section class="am-panel am-panel-default">
            <div class="am-panel-hd">博客分类</div>
            <ul class="am-list blog-list" id="cates">
{{--                      <li><a href="#">Google fonts 的字體（sans-serif 篇）</a></li>--}}
            </ul>
        </section>

     <section class="am-panel am-panel-default">
            <div class="am-panel-hd">友情链接</div>
            <ul class="am-list blog-list" id="linkList">

            </ul>
     </section>
    </div>
  </div>

</div>

<footer class="blog-footer">
    <small>© Copyright SteffenKong</small>
</footer>

<script src="{{asset('/static/blog')}}/assets/js/zepto.min.js"></script>
<script src="{{asset('/static/blog')}}/assets/js/amazeui.min.js"></script>
<script src="{{asset('/static/blog')}}/assets/index.js"></script>
</body>
</html>
