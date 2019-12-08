<!DOCTYPE html>
<html>
<head lang="en">
    @include("/blog/Base/meta")
    <style>
        @media only screen and (min-width: 641px) {
            .am-offcanvas {
                display: block;
                position: static;
                background: none;
            }

            .am-offcanvas-bar {
                position: static;
                width: auto;
                background: none;
                -webkit-transform: translate3d(0, 0, 0);
                -ms-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            .am-offcanvas-bar:after {
                content: none;
            }

        }

        @media only screen and (max-width: 640px) {
            .am-offcanvas-bar .am-nav>li>a {
                color:#ccc;
                border-radius: 0;
                border-top: 1px solid rgba(0,0,0,.3);
                box-shadow: inset 0 1px 0 rgba(255,255,255,.05)
            }

            .am-offcanvas-bar .am-nav>li>a:hover {
                background: #404040;
                color: #fff
            }

            .am-offcanvas-bar .am-nav>li.am-nav-header {
                color: #777;
                background: #404040;
                box-shadow: inset 0 1px 0 rgba(255,255,255,.05);
                text-shadow: 0 1px 0 rgba(0,0,0,.5);
                border-top: 1px solid rgba(0,0,0,.3);
                font-weight: 400;
                font-size: 75%
            }

            .am-offcanvas-bar .am-nav>li.am-active>a {
                background: #1a1a1a;
                color: #fff;
                box-shadow: inset 0 1px 3px rgba(0,0,0,.3)
            }

            .am-offcanvas-bar .am-nav>li+li {
                margin-top: 0;
            }
        }

        .my-head {
            margin-top: 40px;
            text-align: center;
        }

        .my-button {
            position: fixed;
            top: 0;
            right: 0;
            border-radius: 0;
        }
        .my-sidebar {
            padding-right: 0;
            border-right: 1px solid #eeeeee;
        }

        .my-footer {
            border-top: 1px solid #eeeeee;
            padding: 10px 0;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

{{--header部分--}}
@include("/blog/Base/header")
<div data-id="{{$articleId}}" id="articleId">

</div>
<header class="am-g my-head">
    <div class="col-sm-12 am-article">
        <h1 class="am-article-title"></h1>
        <p class="am-article-meta" id="author"></p>
    </div>
</header>
<hr class="am-article-divider"/>
<div class="am-g am-g-fixed">
    <div class="col-md-9 col-md-push-3">
        <div class="am-g">
            <div class="col-sm-11 col-sm-centered">
                <div class="am-cf am-article">
                    <div>
                        <img id="image" src="" alt="" width="700" height="70">
                    </div>
                    <h2>文章简介</h2>
                    <p id="description"></p>
                    <hr class="am-article-divider">
                    <h2>文章内容</h2>
                    <div id="article">
                        <p>

                        </p>
                    </div>
                </div>
                <hr/>
                <ul class="am-comments-list">
                    <li class="am-comment">
                        <a href="#link-to-user-home">
                            <img src="http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/96/h/96" alt="" class="am-comment-avatar" width="48" height="48">
                        </a>
                        <div class="am-comment-main">
                            <header class="am-comment-hd">
                                <div class="am-comment-meta">
                                    <a href="#link-to-user" class="am-comment-author">某人</a> 评论于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-12 15:30</time>
                                </div>
                            </header>
                            <div class="am-comment-bd">
                                <p>《永远的蝴蝶》一文，还吸收散文特长，多采用第一人称，淡化情节，体现一种思想寄托和艺术追求。</p>
                            </div>
                        </div>
                    </li>
                    <li class="am-comment">
                        <a href="#link-to-user-home">
                            <img src="http://www.gravatar.com/avatar/1ecedeede84a44f371b9d8d656bb4265?d=mm&amp;s=96" alt="" class="am-comment-avatar" width="48" height="48">
                        </a>
                        <div class="am-comment-main">
                            <header class="am-comment-hd">
                                <div class="am-comment-meta">
                                    <a href="#link-to-user" class="am-comment-author">路人甲</a> 评论于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-13 0:03</time>
                                </div>
                            </header>
                            <div class="am-comment-bd">
                                <p>感觉仿佛是自身的遭遇一样，催人泪下</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-md-pull-9 my-sidebar">
        <div class="am-offcanvas" id="sidebar">
            <div class="am-offcanvas-bar">
                <ul class="am-nav">
                    <li><a href="#" id="title" ></a></li>
                    <li class="am-nav-header">目录</li>
                    <li><a href="#">文章简介</a></li>
                    <li><a href="#">原文</a></li>
                </ul>
            </div>
        </div>
    </div>
{{--    <a href="#sidebar" class="am-btn am-btn-sm am-btn-success am-icon-bars am-show-sm-only my-button" data-am-offcanvas><span class="am-sr-only">侧栏导航</span></a>--}}
</div>

<footer class="blog-footer">
    <small>© Copyright SteffenKong</small>
</footer>

<script type="text/javascript" src="{{asset('/static/blog/assets/js/article.js')}}"></script>
