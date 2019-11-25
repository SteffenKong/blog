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


    $("#loginbtn").click(function() {
        var account = $("#account").val();
        var password = $("#password").val();
        var captcha = $("#captcha").val();

        if(account == '') {
            layer.msg('账号不能为空',{icon:2});
            return false;
        }

        if(password == '') {
            layer.msg('密码不能为空',{icon:2});
            return false;
        }

        if(captcha == '') {
            layer.msg('验证码不能为空',{icon:2});
            return false;
        }


    var encrypt = new JSEncrypt();
    encrypt.setPublicKey(localStorage.getItem('publicKey'));
    password = encrypt.encrypt(password);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : $("meta[name='x-csrf-token']").attr('content') }
    });

    $("#password").val(password);

    $.ajax({
       url:"/admin/sign",
       dataType:'Json',
       type:'POST',
       data:{account:account,password:password,captcha:captcha},
       success:function(resp) {
           if(resp.status === '000') {
                layer.msg(resp.message,{icon:1});
                window.setInterval(function() {
                    window.location.href = '/admin/index';
                    window.localStorage.clear();
                },500);
           }else if(resp.status === '001') {
               layer.msg(resp.message,{icon:2});
               $("#password").val('');
               refreshCaptcha();
           }else if(resp.status === '002') {
               layer.msg(resp.message,{icon:2});
               $("#password").val('');
               refreshCaptcha();
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

    /**
     * 点击刷新验证码
     */
    $("#captcha_img").click(function() {
        var url = 'http://www.blog.com/captcha/math?6vweXHbb';
        var newUrl = url+'/'+Math.random();
        $(this).attr('src',newUrl);
    });
});

/**
 * 刷新验证码
 */
function refreshCaptcha() {
    var url = 'http://www.blog.com/captcha/math?6vweXHbb';
    var newUrl = url+'/'+Math.random();
    $("#captcha_img").attr('src',newUrl);
}
