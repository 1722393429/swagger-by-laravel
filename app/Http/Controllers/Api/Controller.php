<?php

namespace App\Http\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @Auth: kingofzihua
 * @package App\Http\Controllers\Api
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

    /**
     * 失败
     * @Auth: kingofzihua
     * @param $code
     * @param $message
     * @return mixed
     */
    public function error($code, $message)
    {
        $senddata = [
            'status' => 0,
            'errcode' => $code,
            'msg' => $message,
        ];

        return $this->response()->array($senddata);
    }

    /**
     * 成功
     * @Auth: kingofzihua
     * @param $message
     * @param array $data
     * @return mixed
     */
    public function success($message, $data = [])
    {
        $senddata = [
            'status' => 1,
            'errcode' => 200,
            'msg' => $message,
            'data' => $data
        ];

        return $this->response()->array($senddata);
    }

}
