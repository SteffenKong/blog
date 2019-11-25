@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">分类模块</strong> / <small>添加分类</small></div>
        </div>

        <form class="am-form am-form-horizontal" style="width:900px;" onsubmit="return false;">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">分类名称: </label>
                <div class="col-sm-10">
                    <input type="text" id="title" required name="title" placeholder="输入你的分类名称">
                </div>
            </div>


            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">所属分类: </label>
                <div class="col-sm-10">
                    <select name="pid">
                        <option value="0">----请选择分类----</option>
                        <option value="0">父级分类</option>
                        @foreach($parentData ?? [] as $key=>$value)
                            <option value="{{$value['id']}}">{{$value['title']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">标签描述: </label>
                <div class="col-sm-10">
                    <textarea class="" name="description"  rows="5" id="description"></textarea>
                </div>
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
                var title = $("#title").val();
                var description = $("#description").val();
                var pid = $("select>option:selected").val();

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
                });


                $.ajax({
                   url:'/admin/category/doAdd',
                   dataType:'Json',
                   type:'POST',
                   data:{title:title,description:description,pid:pid},
                   success:function(resp) {
                        if(resp.status === '000') {
                            layer.msg(resp.message,{icon:1});
                            window.location.href = '/admin/category/index';
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
