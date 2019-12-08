<!-- sidebar start -->
<div class="admin-sidebar">
    <ul class="am-list admin-sidebar-list">
        <li><a href="{{route('index')}}"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="glyphicon glyphicon-user"></span> 管理员模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
{{--                <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 个人资料<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>--}}
                <li><a href="{{route('/admin/index')}}"><span class="glyphicon glyphicon-user"></span> 管理员列表</a></li>
            </ul>
        </li>
        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav2'}"><span class="glyphicon glyphicon-book"></span> 文章模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav2">
                <li><a href="{{route('/tags/index')}}"><span class="glyphicon glyphicon-tags"></span>&nbsp;标签列表</a></li>
                <li><a href="{{route('/category/index')}}"><span class="glyphicon glyphicon-th-list"></span>&nbsp;分类列表</a></li>
                <li><a href="{{route('/article/index')}}"><span class="glyphicon glyphicon-bookmark"></span>&nbsp;文章列表</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav3'}"><span class="am-icon-file"></span> 日志管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav3">
                <li><a href="{{route('/tags/index')}}"><span class="glyphicon glyphicon-log-out"></span>&nbsp;登录日志</a></li>
                <li><a href="{{route('/tags/index')}}"><span class="glyphicon glyphicon-log-in"></span>&nbsp;操作日志</a></li>
                <li><a href="{{route('/tags/index')}}"><span class="glyphicon glyphicon-header"></span>&nbsp;IP地址列表</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav4'}"><span class="glyphicon glyphicon-cog"></span> 网站管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav4">
                <li><a href="{{route('/link/index')}}"><span class="am-icon-puzzle-piece"></span>&nbsp;友情链接</a></li>
                <li><a href="{{route('/banner/index')}}"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;横幅管理</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav5'}"><span class="glyphicon glyphicon-wrench"></span> 系统设置 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav5">
                <li><a href="{{route('/SystemSetting/settingView')}}"><span class="glyphicon glyphicon-tasks"></span>&nbsp;后台配置</a></li>
                <li><a href="{{route('/link/index')}}"><span class="glyphicon glyphicon-hdd"></span>&nbsp;队列管理</a></li>
                <li><a href="{{route('/link/index')}}"><span class="glyphicon glyphicon-wrench"></span>&nbsp;开发者工具</a></li>
            </ul>
        </li>


        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav6'}"><span class="glyphicon glyphicon-list"></span> 信息管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav6">
                <li><a href="{{route('/tags/index')}}"><span class="glyphicon glyphicon-envelope"></span>&nbsp;邮箱列表</a></li>
                <li><a href="{{route('/tags/index')}}"><span class="glyphicon glyphicon-earphone"></span>&nbsp;短信列表</a></li>
            </ul>
        </li>

        <li class="tags-parent">
            <a class="am-cf" data-am-collapse="{target: '#collapse-nav7'}"><span class="am-icon-file"></span> 评论管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
            <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav7">
                <li><a href="{{route('/comment/index')}}"><span class="am-icon-puzzle-piece"></span>评论列表</a></li>
            </ul>
        </li>

        <li><a href="{{route('logout')}}"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>
</div>
<!-- sidebar end -->
