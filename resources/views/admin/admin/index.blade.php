@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理员模块</strong> / <small>列表</small></div>
        </div>

        <div class="am-g">
            <div class="col-md-6 am-cf">
                <div class="am-fl am-cf">
                    <div class="am-btn-toolbar am-fl">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default" onclick="window.location.href = '/admin/admin/add'"><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
                            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-3 am-cf" style="margin-bottom:60px; width:900px;">
                <div class="am-fr" style="width:100%;">
                    <form class="am-form  am-form-inline" method="GET" action="{{route('/admin/index')}}">
                        <div class="am-form-group">
                            <input type="text" name="account" class="am-form-field" placeholder="搜索用户名">
                        </div>

                        <div class="am-form-group">
                            <input type="text" name="email" class="am-form-field" placeholder="搜索邮箱">
                        </div>

                        <div class="am-form-group">
                            <input type="text" name="phone" class="am-form-field" placeholder="搜索手机号码">
                        </div>

                        <div class="am-form-group am-margin-left am-fl" style="width:80px; margin-right:10px;">
                                <select name="status">
                                    <option value="-1">所有</option>
                                    <option value="1">启用</option>
                                    <option value="0">禁用</option>
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
                                <input type="checkbox"  id="parentCheck" />
                            </th><th class="table-id">ID</th>
                            <th class="table-title">账号</th>
                            <th class="table-type">邮箱</th>
                            <th class="table-type">状态</th>
                            <th class="table-type">手机号码</th>
                            <th class="table-type">上次登录时间</th>
                            <th class="table-type">上次登录IP</th>
                            <th class="table-date">添加日期</th>
                            <th class="table-date">修改日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $admin)
                        <tr>
                            <td>@if($admin['id'] != 1) <input type="checkbox" class="subCheck" /> @endif</td>
                            <td>{{$admin['id']}}</td>
                            <td>{{$admin['account']}}</td>
                            <td>{{$admin['email']}}</td>
                            <td>
                                @if($admin['status'] == 1)
                                    <a class="am-btn  am-btn-secondary status"  data-id="{{$admin['id']}}" style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">启用</a>
                                @else
                                    <a class="am-btn am-btn-danger status" data-id="{{$admin['id']}}"  style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">禁用</a>
                                @endif
                            </td>
                            <td>{{$admin['phone']}}</td>
                            <td>
                                @if(!$admin['lastLoginIp'])
                                    <a class="am-btn  am-btn-secondary" style="height:30px; width:80px; line-height: 10px; text-align: center; font-size:13px;">暂无登录</a>
                                @else
                                    {{$admin['lastLoginIp']}}
                                @endif
                            </td>
                            <td>
                                @if(!$admin['lastLoginTime'])
                                    <a class="am-btn am-btn-success" style="height:30px; width:80px; line-height: 10px; text-align: center; font-size:13px;">暂无登录</a>
                                @else
                                    {{$admin['lastLoginTime']}}
                                @endif
                            </td>
                            <td>{{$admin['created_at']}}</td>
                            <td>{{$admin['updated_at']}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" style="background-color:white;" href="/admin/admin/edit/{{$admin["id"]}}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger del"   data-id="{{$admin['id']}}"><span class="am-icon-trash-o"></span>删除</button>
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
                url:'/admin/admin/changeStatus/'+id,
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
                url:'/admin/admin/delete/'+id,
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


        //全选
        $("#parentCheck").click(function() {
            if($(this).is(':checked')) {
                $(".subCheck").prop('checked',true);
            }else {
                $(".subCheck").prop('checked',false);
            }
        });



        // $(".subCheck").click('click',function() {
        //      var flag;
        //     for(var i = 0;i<$(".subCheck").length;i++) {
        //         if($(".subCheck")[i].is(":checked")) {
        //             flag = true;
        //         }else {
        //             flag = false;
        //         }
        //     }
        //
        //     if(flag == true) {
        //         $("#parentCheck").prop('checked',true);
        //     }else {
        //         $("#parentCheck").prop('checked',false);
        //     }
        // });


    </script>
@endsection
