<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Model\Admin;
use App\Tools\Loader;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Login
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $adminData = $event->adminData;
        $lastLoginTime = $event->lastLoginTime;
        $lastLoginIp = $event->lastLoginIp;
        $email = $event->email;
        $phone = $event->phone;

        //记录日志
        /* @var Admin $adminModel */
        $adminModel = Loader::singleton(Admin::class);
        $adminModel->setLog($adminData['id'],$lastLoginIp,$lastLoginTime);

        Session::put('admin',$adminData);
    }
}
