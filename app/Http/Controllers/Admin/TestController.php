<?php

namespace App\Http\Controllers\Admin;
use App\Tools\SendMailer;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    public function test() {
//        $send = new SendMailer();
//        $send->send('3266023724@qq.com','title','helloworl');
        $ip = getIp();
        $content = getPlaceByIp($ip);
    }
}
