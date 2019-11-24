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
        <li><a href="admin-table.html"><span class="am-icon-table"></span> 表格</a></li>
        <li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 表单</a></li>
        <li><a href="{{route('logout')}}"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>

    <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
            <p><span class="am-icon-bookmark"></span> 公告</p>
            <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
        </div>
    </div>

    <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
            <p><span class="am-icon-tag"></span> wiki</p>
            <p>Welcome to the Amaze UI wiki!</p>
        </div>
    </div>
</div>
<!-- sidebar end -->
