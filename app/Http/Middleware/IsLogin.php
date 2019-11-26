<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        //已登录的用户禁止去登录页面
        if(Session::has('admin')) {
            return redirect('/admin/index');
        }
        return $next($request);
    }
}
