<header class="am-topbar">
    <h1 class="am-topbar-brand" style="position:absolute; left:400px;">
        <a href="/blog/index">Steffen个人博客</a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
            class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav" style="margin-left:570px;">
            <li><a href="/blog/index">首页</a></li>
            @foreach($cates ?? [] as $cate)
                <li><a href="/blog/getListByCateId/{{$cate['id']}}">{{$cate['title']}}</a></li>
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
