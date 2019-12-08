@extends('/admin/base/base')

@section("meta")
    <link rel="stylesheet" type="text/css" href="{{asset('/static/admin/assets/css/webuploader/webuploader.css')}}" />
@endsection


@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章管理模块</strong> / <small>添加友情链接</small></div>
        </div>

        <form class="am-form am-form-horizontal" style="width:970px;" onsubmit="return false;">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">标题: </label>
                <div class="col-sm-10">
                    <input type="text" id="title" value="{{$article['title']}}" required name="title" placeholder="输入你的文章标题">
                </div>
            </div>


            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">文章描述: </label>
                <div class="col-sm-10">
                    <textarea class="" name="description"  rows="5" id="description">{{$article['description']}}</textarea>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">文章内容: </label>
                    <div class="col-sm-10">
                        <textarea id="container" name="content">{{$content}}</textarea>
                    </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">文章分类: </label>
                <label class="am-checkbox-inline">
                    <select name="categoryId" style="width:200px; position: relative; left:-20px; bottom:6px;">
                        <option value="0">请选择分类</option>
                        @foreach($allCate as $cate)
                            @if($cateId == $cate['id'])
                                <option value="{{$cate['id']}}" selected="selected">{{$cate['title']}}</option>
                            @else
                                <option value="{{$cate['id']}}">{{$cate['title']}}</option>
                            @endif
                        @endforeach
                    </select>
                </label>
            </div>


            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">文章图片: </label>
                <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                    <input type="hidden" value="{{$article['bigImage']}}" id="image" />
                </div>

                <div class="am-form-group">
                    <label for="doc-ipt-3" class="col-sm-2 am-form-label">标签: </label>
                    @foreach($allTags as $tag)
                        <label class="am-checkbox-inline">
                            @if(in_array($tag['id'],$tagsId))
                                <input type="checkbox" checked="checked " name="tagId[]" value="{{$tag['id']}}" style="height:20px; width:20px; margin-right:5px;"> {{$tag['title']}}
                            @else
                                <input type="checkbox" name="tagId[]" value="{{$tag['id']}}" style="height:20px; width:20px; margin-right:5px;"> {{$tag['title']}}
                            @endif
                        </label>
                    @endforeach
                </div>

                <div class="am-form-group">
                    <label for="doc-ipt-3" class="col-sm-2 am-form-label">状态: </label>
                    <label class="am-checkbox-inline">
                        <input type="checkbox" name="status" @if($article['status'] == 1) checked="checked" @endif value="1" style="height:20px; width:20px; margin-right:5px;"> 启用
                    </label>
                </div>

                <div class="am-form-group">
                    <label for="doc-ipt-3" class="col-sm-2 am-form-label">热推: </label>
                    <label class="am-checkbox-inline">
                        <input type="checkbox" name="isHot" @if($article['isHot'] == 1) checked="checked" @endif value="1" style="height:20px; width:20px; margin-right:5px;"> 是
                    </label>
                </div>

                <div class="am-form-group">
                    <label for="doc-ipt-3" class="col-sm-2 am-form-label">推荐: </label>
                    <label class="am-checkbox-inline">
                        <input type="checkbox" name="isRec" @if($article['isRec'] == 1) checked="checked" @endif value="1" style="height:20px; width:20px; margin-right:5px;"> 是
                        <input type="hidden" name="id" id="id" value="{{$article['id']}}" />
                    </label>
                </div>

        </form>

        <div class="am-margin" style="position:relative; left:300px;">
            <button type="button"  id="editBtn" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <button type="button"  class="am-btn am-btn-primary am-btn-xs" onclick="window.history.back(-1);">返回</button>
        </div>
    </div>
    <!-- content end -->
@endsection

@section('js')
    <!--wang编辑器文件-->
{{--    <script type="text/javascript" src="{{asset('/static/admin/assets/js/wangEditor/release/wangEditor.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('/static/admin/assets/js/editor.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/static/admin/assets/js/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/admin/assets/js/ueditor/ueditor.all.js')}}"></script>

    <!--文件上传插件文件-->
    <script type="text/javascript" src="{{asset('/static/admin/assets/css/webuploader/webuploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/admin/assets/js/upload.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            var ue = UE.getEditor('container');
            $("#editBtn").click(function() {
                //校验表单
                var id = $("#id").val();
                var title = $("#title").val();
                var description = $("#description").val();
                var content = ue.getContent();
                var categoryId = $("select[name='categoryId']>option:selected").val();
                var image = $("#image").val();
                var status = $("input[name='status']:checked").val() == 1 ? 1 : 0;
                var isHot = $("input[name='isHot']:checked").val() == 1 ? 1 : 0;
                var isRec = $("input[name='isRec']:checked").val() == 1 ? 1 : 0;
                //处理标签选择多个的情况
                var tagIds=new Array();
                $('input[name="tagId[]"]:checked').each(function(){
                    tagIds.push($(this).val());//向数组中添加元素
                });
                var tagIdstr=tagIds.join(',');//将数组元素连接起来以构建一个字符串

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
                });

                $.ajax({
                    url:'/admin/article/doEdit',
                    dataType:'Json',
                    type:'PUT',
                    data:{id:id,title:title,description:description,content:content,categoryId:categoryId,image:image,tagIds:tagIdstr,isHot:isHot,isRec:isRec,status:status},
                    success:function(resp) {
                        if(resp.status === '000') {
                            layer.msg(resp.message,{icon:1});
                            window.location.href = '/admin/article/index';
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
