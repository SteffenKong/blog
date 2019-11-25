@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">标签模块</strong> / <small>添加标签</small></div>
        </div>

        <form class="am-form am-form-horizontal" style="width:900px;" onsubmit="return false;">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">标签名称: </label>
                <div class="col-sm-10">
                    <input type="text" id="title" value="{{$tag['title']}}" required name="title" placeholder="输入你的标签名称">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">标签描述: </label>
                <div class="col-sm-10">
                    <textarea class="" name="description"  rows="5" id="description">{{$tag['description']}}</textarea>
                </div>
            </div>


            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">状态: </label>
                <label class="am-checkbox-inline">
                    <input type="checkbox" @if($tag['status'] == 1) checked="checked" @endif name="status" value="1" style="height:20px; width:20px; margin-right:5px;"> 启用
                    <input type="hidden" value="{{$tag['id']}}" name="id" id="id" />
                </label>
            </div>
        </form>

        <div class="am-margin" style="position:relative; left:300px;">
            <button type="button"  id="addBtn" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <button type="button"  id="addBtn" class="am-btn am-btn-primary am-btn-xs" onclick="window.history.back(-1);">返回</button>
        </div>
    </div>
    <!-- content end -->
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

            $("#addBtn").click(function() {
                //校验表单
                var id = $("#id").val();
                var title = $("#title").val();
                var description = $("#description").val();
                var status = $("input[name='status']:checked").val() == 1 ? 1 : 0;

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
                });


                $.ajax({
                    url:'/admin/tags/doEdit',
                    dataType:'Json',
                    type:'PUT',
                    data:{id:id,title:title,description:description,status:status},
                    success:function(resp) {
                        if(resp.status === '000') {
                            layer.msg(resp.message,{icon:1});
                            window.location.href = '/admin/tags/index';
                            window.localStorage.clear();
                        }else if(resp.status === '001') {
                            layer.msg(resp.message,{icon:2});
                        }else if(resp.status === '002') {
                            layer.msg(resp.message,{icon:2});
                        }else {
                            $.each(resp.errors,function(k,v) {
                                layer.msg(v[0],{icon:2});
                                return false;
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
