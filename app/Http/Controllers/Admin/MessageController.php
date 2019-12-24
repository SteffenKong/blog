<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageAddRequest;
use App\Http\Requests\MessageEditRequest;
use App\Model\Message;
use App\Tools\Loader;
use Illuminate\Http\Request;

/**
 * Class MessageController
 * @package App\Http\Controllers\Admin
 * 公告控制器
 */
class MessageController extends BaseController {

    /* @var Message $messageModel */
    protected $messageModel;

    public function __construct() {
        parent::__construct();
        $this->messageModel = Loader::singleton(Message::class);
    }

    public function getList(Request $request) {

    }

    public function add(MessageAddRequest $request) {

    }

    public function edit(MessageEditRequest $request) {

    }

    public function delete(Request $request) {

    }

    public function changeStatus(Request $request) {

    }
}
