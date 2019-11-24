<!doctype html>
<html class="no-js">
<head>
    {{--  meta部分  --}}
    @include("/admin/base/meta")
</head>
<body>

{{--  头部分  --}}
@include("/admin/base/header")

<div class="am-cf admin-main">

{{--  左侧菜单  --}}
@include("/admin/base/menu")

    {{--  内容部分  --}}
    @yield("content")

</div>

@include('/admin/base/footer'))

</body>
</html>
@yield('js')
