<?php

namespace App\Http\Middleware;

use Closure;
use App\Tools\Loader;
use App\Model\AdminLog as AdminLogModel;


/**
 * Class AdminLog
 * @package App\Http\Middleware
 *
 */
class AdminLog
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
        /* @var \App\Model\AdminLog $adminLog */
        $adminLog = Loader::singleton(AdminLogModel::class);
        $adminLog->addLog($request->get('account'),$request->getMethod(),$request->all(),$request->getRequestUri(),$request->getClientIp());
        return $next($request);
    }
}
