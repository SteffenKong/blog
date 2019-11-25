@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">友情链接模块</strong> / <small>添加友情链接</small></div>
        </div>

        <form class="am-form am-form-horizontal" style="width:900px;" onsubmit="return false;">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">链接名称: </label>
                <div class="col-sm-10">
                    <input type="text" id="title" required name="title" placeholder="输入你的链接名称">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">链接url: </label>
                <div class="col-sm-10">
                    <input type="text" id="url" required name="url" placeholder="输入你的链接url">
                </div>
            </div>


            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">状态: </label>
                <label class="am-checkbox-inline">
                    <input type="checkbox" name="status" value="1" style="height:20px; width:20px; margin-right:5px;"> 启用
                </label>
            </div>
        </form>

        <div class="am-margin" style="position:relative; left:300px;">
            <button type="button"  id="addBtn" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <button type="button"  class="am-btn am-btn-primary am-btn-xs" onclick="window.history.back(-1);">返回</button>
        </div>
    </div>
    <!-- content end -->
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

            $("#addBtn").click(function() {
                //校验表单
                var title = $("#title").val();
                var url = $("#url").val();
                var status = $("input[name='status']:checked").val() == 1 ? 1 : 0;

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
                });


                $.ajax({
                   url:'/admin/link/doAdd',
                   dataType:'Json',
                   type:'POST',
                   data:{title:title,url:url,status:status},
                   success:function(resp) {
                        if(resp.status === '000') {
                            layer.msg(resp.message,{icon:1});
                            window.location.href = '/admin/link/index';
                            window.localStorage.clear();
                        }else if(resp.status === '001') {
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
