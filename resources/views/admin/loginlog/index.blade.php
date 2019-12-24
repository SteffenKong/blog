@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">横幅模块</strong> / <small>列表</small></div>
        </div>

        <div class="am-g">
            <div class="col-md-6 am-cf">
                <div class="am-fl am-cf">
                    <div class="am-btn-toolbar am-fl">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default" onclick="window.location.href = '/admin/banner/add'"><span class="am-icon-plus"></span> 新增</button>
                        </div>

                        <div class="am-form-group am-margin-left am-fl">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 am-cf" style="margin-bottom:60px; width:530px;">
                <div class="am-fr" style="width:100%; float:right;">
                    <form class="am-form  am-form-inline" method="GET" action="{{route('/banner/index')}}">

                        <div class="am-form-group">
                            <input type="text" name="title" value="{{request()->get('title')}}" class="am-form-field" placeholder="搜索文章标题">
                        </div>
                        <div class="am-form-group am-margin-left am-fl" style="width:80px; margin-right: 10px;">
                            <select name="status">
                                <option value="-1" selected="selected">所有</option>
                                <option value="1" @if(request()->get('status') == 1) selected="selected" @endif>启用</option>
                                <option value="0" @if(request()->get('status') === '0') selected="selected" @endif>禁用</option>
                            </select>
                        </div>


                        <button type="submit" class="am-btn am-btn-default">搜索</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="am-g">
            <div class="col-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-title">账号</th>
                            <th class="table-type">IP地址</th>
                            <th class="table-type">请求方法</th>
                            <th class="table-date">添加日期</th>
                            <th class="table-date">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $log)
                        <tr>
                            <td>{{$log['account']}}</td>
                            <td>{{$log['ip']}}</td>
                            <td><a href="#" data-log="{{$log['params']}}">查看参数</a></td>
                            <td>{{$log['createdAt']}}</td>
                            <td><a href="#">删除</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="am-cf">
                        共 {{$count}} 条记录
                        <div class="am-fr">
                            @if($count > $pageSize)
                            {!! $page !!}
                            @endif
                        </div>
                    </div>
                    <hr />
                </form>
            </div>

        </div>
    </div>
    <!-- content end -->
@endsection

@section('js')
    <script type="text/javascript">


    </script>
@endsection
