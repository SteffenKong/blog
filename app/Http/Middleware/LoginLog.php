<?php

namespace App\Http\Middleware;

use App\Tools\Loader;
use App\Model\LoginLog as LoginLogModel;
use Closure;

class LoginLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       /* @var LoginLogModel $loginLogModel */
        $loginLogModel = Loader::singleton(LoginLogModel::class);
        $loginLogModel->addLog($request->getClientIp(),$request->all(),$request->get('account'));
        return $next($request);
    }
}
