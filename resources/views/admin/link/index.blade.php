@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">友情链接模块</strong> / <small>列表</small></div>
        </div>

        <div class="am-g">
            <div class="col-md-6 am-cf">
                <div class="am-fl am-cf">
                    <div class="am-btn-toolbar am-fl">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default" onclick="window.location.href = '/admin/link/add'"><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
                            <button type="button" class="am-btn am-btn-default" id="sortBtn"><span class="am-icon-save"></span> 一键排序</button>
                            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>

                        <div class="am-form-group am-margin-left am-fl">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 am-cf" style="margin-bottom:60px; width:900px;">
                <div class="am-fr" style="width:100%;">
                    <form class="am-form  am-form-inline" method="GET" action="{{route('/link/index')}}">
                        <div class="am-form-group">
                            <input type="text" name="title" value="{{request()->get('title')}}" class="am-form-field" placeholder="搜索友情链接名称">
                        </div>

                        <div class="am-form-group">
                            <input type="text" name="url" class="am-form-field" value="{{request()->get('url')}}" placeholder="搜索友情链接url">
                        </div>

                        <div class="am-form-group am-margin-left am-fl" style="width:80px; margin-right:10px;">
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
                            <th class="table-check">
                                <input type="checkbox" />
                            </th><th class="table-id">ID</th>
                            <th class="table-title">友情链接名称</th>
                            <th class="table-type">url地址</th>
                            <th class="table-type">状态</th>
                            <th class="table-type">排序值</th>
                            <th class="table-date">添加日期</th>
                            <th class="table-date">修改日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $link)
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td>{{$link['id']}}</td>
                            <td>{{$link['title']}}</td>
                            <td><a href="{{$link['url']}}" class="link">{{$link['url']}}</a></td>
                            <td>
                                @if($link['status'] == 1)
                                    <a class="am-btn  am-btn-secondary status"  data-id="{{$link['id']}}" style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">启用</a>
                                @else
                                    <a class="am-btn am-btn-danger status" data-id="{{$link['id']}}"  style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">禁用</a>
                                @endif
                            </td>
                            <td>
                                <input type="text" class="sortText" data-id="{{$link['id']}}" style="height:30px;width:50px; text-align: center;" value="{{$link['sort']}}" />
                            </td>
                            <td>{{$link['createdAt']}}</td>
                            <td>{{$link['updatedAt']}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" style="background-color:white;" href="/admin/link/edit/{{$link["id"]}}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger del"   data-id="{{$link['id']}}"><span class="am-icon-trash-o"></span>删除</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="am-cf">
                        共 {{$paginate->count()}} 条记录
                        <div class="am-fr">
                            {{$paginate->render()}}
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

        //全局csrf token
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
        });


        /**
         * 更改状态
         * */
        $(".status").click(function() {
            var id = $(this).attr("data-id");
            var thisObj = $(this);

            $.ajax({
                url:'/admin/link/changeStatus/'+id,
                data:null,
                dataType:'Json',
                type:'POST',
                success:function(resp) {
                    if(resp.status === '000') {
                        layer.msg(resp.message,{icon:1});
                        var classStyle = '';
                        var text = '';
                        if(thisObj.attr('class') == 'am-btn  am-btn-secondary status') {
                            classStyle = 'am-btn am-btn-danger status';
                            text = '禁用';
                        }else {
                            classStyle = 'am-btn  am-btn-secondary status';
                            text = '启用';
                        }
                        thisObj.attr('class','');
                        thisObj.attr('class',classStyle);
                        thisObj.text(text);
                    }else {
                        layer.msg(resp.message,{icon:2});
                    }
                }
            });
        });

        /**
         * 删除操作
         */
        $(".del").click(function() {
            var id = $(this).attr('data-id');
            var thisObj = $(this);
            $.ajax({
                url:'/admin/link/delete/'+id,
                data:null,
                dataType:'Json',
                type:'delete',
                success:function(resp) {
                    if(resp.status === '000') {
                        layer.msg(resp.message,{icon:1});
                        thisObj.parent().parent().parent().parent().remove();
                    }else {
                        layer.msg(resp.message,{icon:2});
                    }
                }
            });
        });


        /**
         * 一键排序
         */
        $("#sortBtn").click(function() {
            var sortsText = $(".sortText");
            var data = [];

            sortsText.each(function() {
                var id = $(this).attr('data-id');
                var sortVal = $(this).val();
                var tempObj = {
                    id:id,
                    sortVal
                };
                data.push(tempObj);
            });

            $.ajax({
                url:'/admin/link/changeSort',
                data:{sorts:data},
                type:'POST',
                dataType:'Json',
                success:function(resp) {
                    console.log(resp);
                    if(resp.status === '000') {
                        layer.msg(resp.message,{icon:1});
                        window.location.reload();
                    }else {
                        layer.msg(resp.message,{icon:2});
                    }
                }
            });
        });
    </script>
@endsection
