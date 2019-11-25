@extends('/admin/base/base')

@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理员模块</strong> / <small>添加管理员</small></div>
        </div>

        <form class="am-form am-form-horizontal" style="width:900px;" onsubmit="return false;">
            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">账号: </label>
                <div class="col-sm-10">
                    <input type="text" id="account" required name="account" placeholder="输入你的账号">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">密码: </label>
                <div class="col-sm-10">
                    <input type="password" id="password" required name="password" placeholder="输入你的密码">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">邮箱: </label>
                <div class="col-sm-10">
                    <input type="email" id="email" required name="email" placeholder="输入你的邮箱">
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="col-sm-2 am-form-label">电话号码: </label>
                <div class="col-sm-10">
                    <input type="tel" id="phone" required name="phone" placeholder="输入你的电话号码">
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
            <button type="button"  id="addBtn" class="am-btn am-btn-primary am-btn-xs" onclick="window.history.back(-1);">返回</button>
        </div>
    </div>
    <!-- content end -->
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            //获取公钥
            $.ajax({
                url:'/admin/getPublicKey',
                type:'GET',
                dataType:'Json',
                data:null,
                success:function(resp) {
                    var publicKey = resp.data.publicKey;
                    localStorage.setItem('publicKey',publicKey);
                }
            });

            $("#addBtn").click(function() {

                //校验表单
                var account = $("#account").val();
                var password = $("#password").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var status = $("input[name='status']:checked").val() == 1 ? 1 : 0;

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
                });

                //密码加密解密
                var encrypt = new JSEncrypt();
                encrypt.setPublicKey(localStorage.getItem('publicKey'));
                password = encrypt.encrypt(password);
                $("#password").val(password);

                $.ajax({
                   url:'/admin/admin/doAdd',
                   dataType:'Json',
                   type:'POST',
                   data:{account:account,password:password,email:email,phone:phone,status:status},
                   success:function(resp) {
                        if(resp.status === '000') {
                            layer.msg(resp.message,{icon:1});
                            window.location.href = '/admin/admin/index';
                            window.localStorage.clear();
                        }else if(resp.status === '001') {
                            layer.msg(resp.message,{icon:2});
                            $("#password").val('');
                        }else {
                            $.each(resp.errors,function(k,v) {
                                layer.msg(v[0],{icon:2});
                                $("#password").val('');
                                refreshCaptcha();
                                return false;
                            });
                        }
                   }
                });
            });
        });
    </script>
@endsection
