@extends('/admin/base/base')

@section("meta")
    <link rel="stylesheet" type="text/css" href="{{asset('/static/admin/assets/css/webuploader/webuploader.css')}}" />
@endsection


@section('content')
    <!-- content start -->
    <div class="admin-content" style="height:900px;">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">横幅模块</strong> / <small>添加横幅</small></div>
        </div>

        <form class="am-form am-form-horizontal" style="width:970px;" onsubmit="return false;">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">横幅名称: </label>
                <div class="col-sm-10">
                    <input type="text" id="title" required name="title" placeholder="输入你的横幅名称">
                </div>
            </div>



            <div class="am-form-group" style="width:900px;">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">文章图片: </label>
                <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list" style="float:right;"></div>
                    <div id="filePicker" style="float:left;">选择图片</div>
                    <input type="hidden" value="" id="image" />
            </div>

            <div class="am-form-group" style="clear:both;">
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
    <!--文件上传插件文件-->
    <script type="text/javascript" src="{{asset('/static/admin/assets/css/webuploader/webuploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/admin/assets/js/upload.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $("#addBtn").click(function() {
                //校验表单
                var title = $("#title").val();
                var image = $("#image").val();
                var status = $("input[name='status']:checked").val() == 1 ? 1 : 0;

                if(image == '') {
                    layer.msg('请上传横幅图片',{icon:2});
                }

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
                });

                $.ajax({
                   url:'/admin/banner/doAdd',
                   dataType:'Json',
                   type:'POST',
                   data:{title:title,image:image,status:status},
                   success:function(resp) {
                        if(resp.status === '000') {
                            layer.msg(resp.message,{icon:1});
                            window.location.href = '/admin/banner/index';
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
