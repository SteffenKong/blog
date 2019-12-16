<div class="widget widget_search">
    <form class="navbar-form" action="/blog/getList" method="get">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" value="{{request()->get('keyword')}}" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" type="submit">搜索</button>
            </span> </div>
    </form>
</div>
</div>
<div class="widget widget_sentence">
    <h3>每日一句</h3>
    <div class="widget-sentence-content">
        <h4>2016年01月05日星期二</h4>
        <p>Do not let what you cannot do interfere with what you can do.<br />
            别让你不能做的事妨碍到你能做的事。（John Wooden）</p>
    </div>
</div>
<div class="widget widget_hot">
    <h3>热门文章</h3>
    <ul class="rec">
{{--        <li>--}}
{{--            <a href="">--}}
{{--                <span class="thumbnail">--}}
{{--                    <img class="thumb" data-original="{{asset('/static/blog')}}/images/excerpt.jpg" src="{{asset("/static/blog")}}/images/excerpt.jpg" alt="">--}}
{{--                </span><span class="text">php如何判断一个日期的格式是否正确</span>--}}
{{--                <span class="muted">--}}
{{--                    <i class="glyphicon glyphicon-time"></i>--}}
{{--                    2016-1-4 </span><span class="muted">--}}
{{--                    <i class="glyphicon glyphicon-eye-open"></i> 120</span></a></li>--}}
    </ul>
</div>
