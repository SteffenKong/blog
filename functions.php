<?php

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

/**
 * json格式化输出
 */
if(!function_exists('jsonPrint')) {
    function jsonPrint($status,$message,$data = [],$extra = [],$httpCode = 200) {
        $result = [
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
            'extra'=>$extra,
            'httpCode'=>$httpCode
        ];

        return response()->json($result,$httpCode);
    }
}


/**
 * 无限极树状排序
 */
if(!function_exists('getTree')) {
    function getTree($data,$pid = 0,$level = 0) {
        $arr = [];
        foreach ($data ?? [] as $k=>$v) {
            if($v['pid'] == $pid) {
                $v['level'] = $level;
                $arr[] = $v;
                $level ++;
                $arr = array_merge(getTree($data,$v['id'],$level),$arr);

            }
        }
        return $arr;
    }
}


/**
 * 隐藏电话号码中间6位数
 */
if(!function_exists('hiddenPhone')) {
    function hiddenPhone($phone) {
        if (empty($phone) || strlen($phone) != 11) {
            return false;
        }
        //构造正则
        $sensitiveNum = '/'.substr($phone,2,6).'/';
        $newStr = preg_replace($sensitiveNum,'******',$phone);
        if(!$newStr) {
            return str_replace($phone,'*',$phone);
        }
        return $newStr;
    }
}


/**
 * 获取客户端IP
 */
if(!function_exists('getIp')) {
    function getIp() {
        return  \request()->getClientIp();
    }
}


/**
 * 通过ip获取所在地方
 */
if(!function_exists('getPlaceByIp')) {
    function getPlaceByIp($ip) {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=116.18.22.38";
        $ch = \curl_init($url);
        \curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $content = \curl_exec($ch);
        if(curl_errno($ch) > 0) {
            return false;
        }
        $content =  json_decode($content,true);
        $data = $content['data'];
        $place = $data['country']."\t".$data['region']."\t".$data['city'];
        return $place;
    }
}
