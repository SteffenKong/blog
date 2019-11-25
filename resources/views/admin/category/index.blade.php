@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">分类模块</strong> / <small>列表</small></div>
        </div>

        <div class="am-g">
            <div class="col-md-6 am-cf">
                <div class="am-fl am-cf">
                    <div class="am-btn-toolbar am-fl">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default" onclick="window.location.href = '/admin/category/add'"><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 am-cf" style="margin-top:30px;">

            </div>
        </div>

        <div class="am-g">
            <div class="col-sm-12">
                <form class="am-form" method="return false;">
                    <table class="am-table am-table-striped am-table-hover table-main" style="margin-top:30px;">
                        <thead>
                        <tr>
                            <th class="table-id">ID</th>
                            <th class="table-title">分类名称</th>
                            <th class="table-title">分类内容</th>
                            <th class="table-type">上级id</th>
                            <th class="table-date">添加日期</th>
                            <th class="table-date">修改日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $category)
                        <tr>
                            <td>{{$category['id']}}</td>
                            <td>{{$category['title']}}</td>
                            <td><a href="#">查看描述</a></td>
                            <td>{{$category['pid']}}</td>
                            <td>{{$category['createdAt']}}</td>
                            <td>{{$category['updatedAt']}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" style="background-color:white;" href="/admin/category/edit/{{$category["id"]}}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger del"   style="background-color:white;" data-id="{{$category['id']}}"><span class="am-icon-trash-o"></span>删除</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="am-cf">
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
         * 删除操作
         */
        $(".del").click(function() {
            console.log('123');
            var id = $(this).attr('data-id');
            var thisObj = $(this);
            $.ajax({
                url:'/admin/category/delete/'+id,
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
    </script>
@endsection
