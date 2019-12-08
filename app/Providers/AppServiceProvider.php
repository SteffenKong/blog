<?php

namespace App\Providers;

use App\Model\SystemSetting;
use App\Tools\Loader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //整个项目启动的时候都会走这里
        /* @var SystemSetting $systemSetting*/
        $systemSetting = Loader::singleton(SystemSetting::class);
        $setting = $systemSetting->getSetting();
        View::share('setting',$setting);
    }
}
