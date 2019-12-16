<!doctype html>
<html lang="zh-CN">
<head>
    @include('blog.Base.meta')
</head>

<body class="user-select single">
<header class="header">
    @include('blog.Base.header')
</header>
<section class="container">
  <div class="content-wrap">
    <div class="content">
      <header class="article-header">
        <h1 class="article-title"><a href="article.html">{{$return['title']}}</a></h1>
        <div class="article-meta"> <span class="item article-meta-time">
          <time class="time" data-toggle="tooltip" data-placement="bottom" title="时间：{{$return['createdAt']}}"><i class="glyphicon glyphicon-time"></i> {{$return['createdAt']}}</time>
          </span> <span class="item article-meta-source" data-toggle="tooltip" data-placement="bottom" title="作者：{{$return['author']}}"><i class="glyphicon glyphicon-globe"></i> {{$return['author']}}</span> <span class="item article-meta-category" data-toggle="tooltip" data-placement="bottom" title="栏目：暂定"><i class="glyphicon glyphicon-list"></i> <a href="program" title="">暂定</a></span> <span class="item article-meta-views" data-toggle="tooltip" data-placement="bottom" title="查看：120"><i class="glyphicon glyphicon-eye-open"></i> {{$return['viewNumber']}}</span> <span class="item article-meta-comment" data-toggle="tooltip" data-placement="bottom" title="评论：0"></span> </div>
      </header>
      <article class="article-content">
        <p><img data-original="{{$return['smallImage']}}" src="{{$return['smallImage']}}" alt="" /></p>
          {!!$return['content']  !!}
        <p class="article-copyright hidden-xs">未经允许不得转载：<a href="">Steffen 孔博客</a> » <a href="article.html">{{$return['title']}}</a></p>
      </article>
      <div class="article-tags">标签：<a href="" rel="tag">PHP</a></div>
      <div class="relates">
        <div class="title">
          <h3>相关推荐</h3>
        </div>
        <ul>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
          <li><a href="article.html">php如何判断一个日期的格式是否正确</a></li>
        </ul>
      </div>
      <div class="title" id="comment">
        <h3>评论 <small>抢沙发</small></h3>
      </div>
      <!--<div id="respond">
        <div class="comment-signarea">
          <h3 class="text-muted">评论前必须登录！</h3>
          <p> <a href="javascript:;" class="btn btn-primary login" rel="nofollow">立即登录</a> &nbsp; <a href="javascript:;" class="btn btn-default register" rel="nofollow">注册</a> </p>
          <h3 class="text-muted">当前文章禁止评论</h3>
        </div>
      </div>-->
      <div id="respond">
        <form action="" method="post" id="comment-form">
          <div class="comment">
            <div class="comment-title"><img class="avatar" src="images/icon/icon.png" alt="" /></div>
            <div class="comment-box">
              <textarea placeholder="您的评论可以一针见血" name="comment" id="comment-textarea" cols="100%" rows="3" tabindex="1" ></textarea>
              <div class="comment-ctrl"> <span class="emotion"><img src="images/face/5.png" width="20" height="20" alt="" />表情</span>
                <div class="comment-prompt"> <i class="fa fa-spin fa-circle-o-notch"></i> <span class="comment-prompt-text"></span> </div>
                <input type="hidden" value="1" class="articleid" />
                <button type="submit" name="comment-submit" id="comment-submit" tabindex="5" articleid="1">评论</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div id="postcomments">
        <ol class="commentlist">
          <li class="comment-content"><span class="comment-f">#1</span>
            <div class="comment-avatar"><img class="avatar" src="images/icon/icon.png" alt="" /></div>
            <div class="comment-main">
              <p>来自<span class="address">河南郑州</span>的用户<span class="time">(2016-01-06)</span><br />
                这是匿名评论的内容这是匿名评论的内容，这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容。</p>
            </div>
          </li>
        </ol>

        <div class="quotes"><span class="disabled">首页</span><span class="disabled">上一页</span><a class="current">1</a><a href="">2</a><span class="disabled">下一页</span><span class="disabled">尾页</span></div>
      </div>
    </div>
  </div>
  <aside class="sidebar">
    <div class="fixed">
        @include("blog.Base.aside")
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
<script src="{{asset('/static/blog')}}/js/jquery.qqFace.js"></script>
<script src="{{asset('/static/blog')}}/index.js"></script>
<script type="text/javascript">
$(function(){
	$('.emotion').qqFace({
		id : 'facebox',
		assign:'comment-textarea',
		path:'images/arclist/'	//表情存放的路径
	});
 });
</script>
</body>
</html>
