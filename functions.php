<?php

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
