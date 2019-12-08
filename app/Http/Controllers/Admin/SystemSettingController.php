<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SystemSettingRequest;
use App\Model\SystemSetting;
use App\Tools\Loader;

/**
 * Class SystemSettingController
 * @package App\Http\Controllers\Admin
 * 系统设置
 */
class SystemSettingController extends BaseController {

    /* @var SystemSetting $systemSettingModel */
    protected $systemSettingModel;

    public function __construct() {
        parent::__construct();
        $this->systemSettingModel = Loader::singleton(SystemSetting::class);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingView() {
        $setting = $this->systemSettingModel->getSetting();
        return view('/admin/systemsetting/index',compact('setting'));
    }


    /**
     * @param SystemSettingRequest $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 后台配置
     */
    public function setting(SystemSettingRequest $request) {
        $data = $request->post();
        if(!$this->systemSettingModel->edit(1,$data['siteName'],$data['isCaptcha'])) {
            return jsonPrint('001','配置失败!');
        }
        return jsonPrint('000','配置成功');
    }
}
