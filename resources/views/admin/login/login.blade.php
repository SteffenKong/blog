<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="x-csrf-token" content="{{ csrf_token() }}">
    <link rel="alternate icon" type="image/png" href="{{asset('/static/admin')}}/assets/i/favicon.png">
    <link rel="stylesheet" href="{{asset('/static/admin')}}/assets/css/amazeui.min.css"/>
    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>SteffenKong - 个人博客系统</h1>
    </div>
    <hr />
</div>
<div class="am-g">
    <div class="col-lg-6 col-md-8 col-sm-centered">
        <h2>登录</h2>
        <hr>


        <form onsubmit="return false;" class="am-form">
            <label for="email">账号:</label>
            <input type="text" name="account" id="account" value="">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="password" id="password" value="">

            @if($setting['isCaptcha'] == 1)
                <br>
                <label for="captcha" style="float:left;">验证码:</label>
                <input type="text" name="captcha" id="captcha" value="" style="width:200px; float:left; margin-left:20px;">
                <img src="{{captcha_src('math')}}" id="captcha_img" style="float:left; margin-left:20px;" />
            @endif
            <br>
            <div style="height:50px;">

            </div>
            <label for="remember-me">
                <input id="remember-me" type="checkbox">
                记住密码
            </label>
            <br />
            <div class="am-cf">
                <input type="button" name="" id="loginbtn" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                <input type="button" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
            </div>
        </form>
        <hr>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
<script type="text/javascript" src="{{asset('/static/admin')}}/assets/js/login.js"></script>
<script type="text/javascript" src="{{asset('/static/admin')}}/assets/js/jsencrypt/bin/jsencrypt.js"></script>
