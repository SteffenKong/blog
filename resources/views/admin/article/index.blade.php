@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章模块</strong> / <small>列表</small></div>
        </div>

        <div class="am-g">
            <div class="col-md-6 am-cf">
                <div class="am-fl am-cf">
                    <div class="am-btn-toolbar am-fl">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default" onclick="window.location.href = '/admin/article/add'"><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>

                        <div class="am-form-group am-margin-left am-fl">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 am-cf" style="margin-top:30px;">
                <div class="am-fr">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field">
                        <span class="am-input-group-btn">
                  <button class="am-btn am-btn-default" type="button">搜索</button>
                </span>
                    </div>
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
                            <th class="table-title">文章标题</th>
                            <th class="table-type">缩略图</th>
                            <th class="table-type">状态</th>
                            <th class="table-type">是否热推</th>
                            <th class="table-type">是否推荐</th>
                            <th class="table-type">点击量</th>
                            <th class="table-type">作者</th>
                            <th class="table-date">添加日期</th>
                            <th class="table-date">修改日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $article)
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td>{{$article['id']}}</td>
                            <td>{{$article['title']}}</td>
                            <td>{{$article['smallImage']}}</td>
                            <td>
                                @if($article['status'] == 1)
                                    <a class="am-btn  am-btn-secondary status"  data-id="{{$article['id']}}" style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">启用</a>
                                @else
                                    <a class="am-btn am-btn-danger status" data-id="{{$article['id']}}"  style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">禁用</a>
                                @endif
                            </td>

                            <td>
                                @if($article['isHot'] == 1)
                                    <a class="am-btn  am-btn-secondary status"   style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">热销</a>
                                @else
                                    <a class="am-btn am-btn-danger status"  style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">不热销</a>
                                @endif
                            </td>
                            <td>
                                @if($article['isRec'] == 1)
                                    <a class="am-btn  am-btn-secondary status"  style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">推荐</a>
                                @else
                                    <a class="am-btn am-btn-danger status"   style="height:30px; width:60px; line-height: 10px; text-align: center; font-size:13px;">不推荐</a>
                                @endif
                            </td>
                            <td>{{$article['viewNumber']}}</td>
                            <td>{{$article['author']}}</td>
                            <td>{{$article['createdAt']}}</td>
                            <td>{{$article['updatedAt']}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" style="background-color:white;" href="/admin/article/edit/{{$article["id"]}}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger del"   data-id="{{$article['id']}}"><span class="am-icon-trash-o"></span>删除</button>
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
                url:'/admin/article/changeStatus/'+id,
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
                url:'/admin/article/delete/'+id,
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
