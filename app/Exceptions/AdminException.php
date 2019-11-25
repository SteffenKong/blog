<?php

namespace App\Exceptions;

use Exception;

/**
 * Class AdminException
 * @package App\Exceptions
 * 管理员模块异常
 */
class AdminException extends Exception {

    public function Handle($request,Exception $exception) {
        return jsonPrint('001',$exception->getMessage());
    }
}
