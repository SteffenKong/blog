<?php

namespace App\Listeners;

use App\Events\SendLoginMessage;
use App\Tools\SendMailer;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLoginMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendLoginMessage  $event
     * @return void
     */
    public function handle(SendLoginMessage $event) {
        $ip = $event->ip;
        $account = $event->account;
        $email = $event->email;
        $place = getPlaceByIp($ip);
        $now = Carbon::now()->toDateTimeString();
        $msgTemplate = <<<EOF
        你好，你的博客后台帐号<span>{$account}</span>于<span style="color:red;">{$now}</span>登录，登录的IP地址为{$ip},所在地方{$place},请注意是否被盗号!!
EOF;
        $mailer = new SendMailer();
        $res = $mailer->send($email,'帐号登录通知',$msgTemplate);

        //记录邮件列表日志
        if(!$res) {
            //发送失败的日志记录
        }
           //发送成功的日志记录
    }
}
