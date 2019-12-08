<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemSetting
 * @package App\Model
 */
class SystemSetting extends Model {

    protected $table = 'system_setting';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'site_name',
        'is_captcha',
        'created_at',
        'updated_at'
    ];



    /**
     * @param $id
     * @param $siteName
     * @param $isCaptcha
     * @return mixed
     */
    public function edit($id,$siteName,$isCaptcha) {
        return SystemSetting::where('id',$id)->update([
            'site_name' => $siteName,
            'is_captcha' => $isCaptcha
        ]);
    }


    /**
     * @return array
     * 获取配置
     */
    public function getSetting() {
         $setting = SystemSetting::first();
         $return = [];
         if(!empty($setting)) {
             $return = [
                 'siteName' => $setting->site_name,
                 'isCaptcha' => $setting->is_captcha
             ];
         }
         return $return;
    }
}
