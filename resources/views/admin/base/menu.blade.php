<!-- sidebar start -->
<div class="admin-sidebar">
    <ul class="am-list admin-sidebar-list">
        <li><a href="{{route('index')}}"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 管理员模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
                <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 个人资料<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                <li><a href="{{route('/admin/index')}}"><span class="am-icon-puzzle-piece"></span> 管理员列表</a></li>
            </ul>
        </li>
        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav2'}"><span class="am-icon-file"></span> 文章模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav2">
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>标签列表</a></li>
                <li><a href="{{route('/category/index')}}"><span class="am-icon-puzzle-piece"></span>分类列表</a></li>
                <li><a href="{{route('/article/index')}}"><span class="am-icon-puzzle-piece"></span>文章列表</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav3'}"><span class="am-icon-file"></span> 日志管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav3">
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>登录日志</a></li>
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>操作日志</a></li>
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>IP地址列表</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav4'}"><span class="am-icon-file"></span> 网站管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav4">
                <li><a href="{{route('/link/index')}}"><span class="am-icon-puzzle-piece"></span>友情链接</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav5'}"><span class="am-icon-file"></span> 后台设置 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav5">
                <li><a href="{{route('/link/index')}}"><span class="am-icon-puzzle-piece"></span>友情链接</a></li>
            </ul>
        </li>


        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav6'}"><span class="am-icon-file"></span> 信息管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav6">
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>邮箱列表</a></li>
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>短信列表</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav7'}"><span class="am-icon-file"></span> 评论管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav7">
                <li><a href="{{route('/tags/index')}}"><span class="am-icon-puzzle-piece"></span>评论列表</a></li>
            </ul>
        </li>

        <li><a href="{{route('logout')}}"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>
</div>
<!-- sidebar end -->
