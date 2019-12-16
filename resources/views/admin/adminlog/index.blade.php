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
                           <th class="table-id">ID</th>
                            <th class="table-title">横幅名称</th>
                            <th class="table-type">缩略图</th>
                            <th class="table-type">状态</th>
                            <th class="table-date">添加日期</th>
                            <th class="table-date">修改日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $banner)
                        <tr>
                            <td>{{$banner['id']}}</td>
                            <td>{{$banner['title']}}</td>
                            <td>
                                <a href="#"><img src="{{$banner['image']}}"  class="thumbImg" style="height:40px; width:100px;" />
                                    <img class="bigPic" src="{{$banner['image']}}" style="display: none; height:400px; width:700px;" />
                                </a>
                            </td>
                            <td>
                                @if($banner['status'] == 1)
                                    <a class="am-btn  am-btn-secondary status"  data-id="{{$banner['id']}}" style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">启用</a>
                                @else
                                    <a class="am-btn am-btn-danger status" data-id="{{$banner['id']}}"  style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">禁用</a>
                                @endif
                            </td>
                            <td>{{$banner['createdAt']}}</td>
                            <td>{{$banner['updatedAt']}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" style="background-color:white;" href="/admin/banner/edit/{{$banner["id"]}}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger del"   data-id="{{$banner['id']}}"><span class="am-icon-trash-o"></span>删除</button>
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
                url:'/admin/banner/changeStatus/'+id,
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
                url:'/admin/banner/delete/'+id,
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
         * 缩略图
         */
        $(".thumbImg").click(function() {
            //页面层-图片
            layer.open({
                type: 1,
                title: false,
                closeBtn: 1,
                area: ['700px','400px'],
                skin: 'layui-layer-nobg', //没有背景色
                shadeClose: true,
                content: $(this).next($('.bigPic'))     //查找下一个兄弟节点
            });
        });
    </script>
@endsection
